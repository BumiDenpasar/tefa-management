<?php

namespace App\Filament\Tefa\Resources\ProductResource\Pages;

use App\Filament\Tefa\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id_sekolah'] = Auth::user()->id_sekolah;
        return $data;
    }
}
