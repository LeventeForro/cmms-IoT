<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Yepsua\Filament\Forms\Components\Rating;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
        Select::make('worksheet_id')
            ->relationship(
                name: 'worksheet',
                titleAttribute: 'title', // <-- EZT ÁLLÍTSD 'title'-ra!
                modifyQueryUsing: fn ($query) => $query->where('status', 'closed')
            )
            ->label('Munkalap')
            ->required()
            ->unique(ignoreRecord: true),

        Select::make('user_id')
            ->relationship('user', 'name')
            ->label('Felhasználó')
            ->required(),

        Rating::make('rating')
            ->label('Értékelés')
            ->required(),

        Textarea::make('comment')
            ->label('Megjegyzés')
            ->nullable(),
    ]);
}

    public static function table(Table $table): Table
{
    return $table->columns([
        TextColumn::make('worksheet.id')->label('Munkalap ID'),
        TextColumn::make('user.name')->label('Felhasználó'),
        TextColumn::make('rating')->label('Értékelés'),
        TextColumn::make('comment')->label('Megjegyzés')->limit(50),
        TextColumn::make('created_at')->label('Beküldve')->dateTime('Y-m-d H:i'),
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
            'index' => Pages\ListFeedback::route('/'),
            'create' => Pages\CreateFeedback::route('/create'),
            'edit' => Pages\EditFeedback::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return Auth::user()?->hasAnyRole(['admin', 'gépkezelő', 'karbantartó']);
    }

    public static function canCreate(): bool
    {
        return Auth::user()?->hasRole('gépkezelő');
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
