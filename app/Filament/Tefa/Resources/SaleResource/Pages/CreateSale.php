<?php

namespace App\Filament\Tefa\Resources\SaleResource\Pages;

use App\Filament\Tefa\Resources\SaleResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSale extends CreateRecord
{
    protected static string $resource = SaleResource::class;

    public function mutateFormDataBeforeCreate(array $data): array
    {
        $product = Product::find($data['id_produk']);

        $data['pemasukan'] = $data['jumlah'] * $product->harga_produk;
        return $data;
    }
}
