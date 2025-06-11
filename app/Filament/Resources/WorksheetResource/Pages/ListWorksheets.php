<?php

namespace App\Filament\Resources\WorksheetResource\Pages;

use App\Filament\Resources\WorksheetResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Asmit\ResizedColumn\HasResizableColumn;

class ListWorksheets extends ListRecords
{
    use HasResizableColumn;
    protected static string $resource = WorksheetResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
