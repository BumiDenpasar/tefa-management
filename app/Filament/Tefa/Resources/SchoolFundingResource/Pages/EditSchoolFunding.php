<?php

namespace App\Filament\Tefa\Resources\SchoolFundingResource\Pages;

use App\Filament\Tefa\Resources\SchoolFundingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchoolFunding extends EditRecord
{
    protected static string $resource = SchoolFundingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
