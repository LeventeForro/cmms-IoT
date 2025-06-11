<?php

namespace App\Filament\Resources\DocumentResource\Pages;

use App\Filament\Resources\DocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Asmit\ResizedColumn\HasResizableColumn;

class ListDocuments extends ListRecords
{
    use HasResizableColumn;
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
