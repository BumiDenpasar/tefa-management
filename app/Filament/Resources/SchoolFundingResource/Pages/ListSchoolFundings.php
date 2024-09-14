<?php

namespace App\Filament\Resources\SchoolFundingResource\Pages;

use App\Filament\Resources\SchoolFundingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolFundings extends ListRecords
{
    protected static string $resource = SchoolFundingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
