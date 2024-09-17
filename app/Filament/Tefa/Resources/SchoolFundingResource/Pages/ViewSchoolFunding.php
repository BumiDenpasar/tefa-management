<?php

namespace App\Filament\Tefa\Resources\SchoolFundingResource\Pages;

use App\Filament\Tefa\Resources\SchoolFundingResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSchoolFunding extends ViewRecord
{
    protected static string $resource = SchoolFundingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
