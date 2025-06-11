<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Asmit\ResizedColumn\HasResizableColumn;

class ListFeedback extends ListRecords
{
    use HasResizableColumn;
    protected static string $resource = FeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
