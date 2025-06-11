<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Asmit\ResizedColumn\HasResizableColumn;

class ListRoles extends ListRecords
{
    use HasResizableColumn;
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
