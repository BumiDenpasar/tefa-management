<?php

namespace App\Filament\Tefa\Resources\SchoolResource\Pages;

use App\Filament\Tefa\Resources\SchoolResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchools extends ListRecords
{
    protected static string $resource = SchoolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
