<?php

namespace App\Filament\Tefa\Resources;

use App\Filament\Tefa\Resources\SaleResource\Pages;
use App\Filament\Tefa\Resources\SaleResource\RelationManagers;
use App\Models\Sale;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SaleResource extends Resource
{
    protected static ?string $model = Sale::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_produk')
                    ->relationship('produk', 'nama_produk')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('produk.nama_produk')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('produk.harga_produk')
                    ->label('Harga Produk')
                    ->searchable()
                    ->sortable()
                    ->money('idr'),

                Tables\Columns\TextColumn::make('pemasukan')
                ->label('Total Pendapatan')
                ->sortable()
                ->money('idr'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListSales::route('/'),
            'create' => Pages\CreateSale::route('/create'),
            'view' => Pages\ViewSale::route('/{record}'),
            'edit' => Pages\EditSale::route('/{record}/edit'),
        ];
    }

    
}
