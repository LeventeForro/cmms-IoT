<?php

namespace App\Filament\Resources\DeviceTypeResource\Pages;

use App\Filament\Resources\DeviceTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Asmit\ResizedColumn\HasResizableColumn;

class ListDeviceTypes extends ListRecords
{
    use HasResizableColumn;
    protected static string $resource = DeviceTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
