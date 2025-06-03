<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorksheetResource\Pages;
use App\Models\Worksheet;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use App\Enums\WorksheetPriority;
use Filament\Forms\Components\TextInput;

class WorksheetResource extends Resource
{
    protected static ?string $model = Worksheet::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([


            TextInput::make('title')
                ->label('Munkalap címe')
                ->required()
                ->maxLength(100),


            Select::make('device_id')
                ->relationship('device', 'name')
                ->label('Berendezés')
                ->required(),

            Select::make('creator_id')
                ->relationship('creator', 'name')
                ->label('Létrehozó')
                ->required(),

            Select::make('repairer_id')
                ->relationship('repairer', 'name')
                ->label('Karbantartó')
                ->required(),

            Select::make('status')
                ->options([
                    'open' => 'Nyitott',
                    'in_progress' => 'Folyamatban',
                    'closed' => 'Lezárt',
                ])
                ->label('Státusz')
                ->required(),

            Select::make('priority')
                ->options(
                    collect(WorksheetPriority::cases())
                        ->mapWithKeys(fn($case) => [$case->value => $case->getLabel()])
                        ->toArray()
                )
                ->label('Prioritás')
                ->required(),

            DatePicker::make('due_date')->label('Határidő')->nullable(),
            DatePicker::make('finish_date')->label('Befejezve')->nullable(),

            FileUpload::make('attachments')
                ->label('Mellékletek')
                ->multiple()
                ->directory('attachments')
                ->nullable(),

            Textarea::make('description')->label('Leírás')->nullable(),
        ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('device.name')->label('Berendezés'),
                TextColumn::make('user.name')->label('Felelős'),
                BadgeColumn::make('status')->label('Státusz')->colors([
                    'primary' => 'open',
                    'warning' => 'in_progress',
                    'success' => 'closed',
                ]),
                TextColumn::make('created_at')->label('Létrehozva')->dateTime('Y-m-d H:i'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorksheets::route('/'),
            'create' => Pages\CreateWorksheet::route('/create'),
            'edit' => Pages\EditWorksheet::route('/{record}/edit'),
        ];
    }
}
