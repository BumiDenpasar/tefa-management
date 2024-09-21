<?php

namespace App\Filament\Tefa\Resources;

use App\Filament\Tefa\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Produk';

    //protected static ?string $modelLabel = 'Produk';

    protected static ?string $navigationGroup = 'Manajemen TeFa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_produk')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('harga_produk')
                    ->required()
                    ->numeric(),
                FileUpload::make('img')
                    ->label('Foto Produk')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Product::with('sales'))
            ->columns([
                TextColumn::make('nama_produk')
                    ->searchable(),
                TextColumn::make('harga_produk')
                    ->numeric()
                    ->sortable()
                    ->money(currency: 'IDR'),
                    Tables\Columns\TextColumn::make('total_sales')
                    ->label('Total Penjualan')
                    ->sortable(),
                    Tables\Columns\TextColumn::make('sales.pemasukan')
                    ->placeholder('Belum Terjual')
                    ->label('Total Pendapatan')
                    ->sortable()
                    ->money('idr'),
                    TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
