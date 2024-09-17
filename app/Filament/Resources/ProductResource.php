<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Forms\Components\Textarea::make('deskripsi')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('img')
                    ->label('Foto Produk')
                    ->image()
                    ->required(),
                Forms\Components\TextInput::make('total_jual')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_produk')
                    ->searchable(),
                TextColumn::make('sekolah.nama_sekolah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('harga_produk')
                    ->numeric()
                    ->sortable()
                    ->money(currency: 'IDR')
                    ,
                TextColumn::make('sales_count')
                ->counts('sales', fn (Builder $query, Product $record) => $query->where('id_produk', '=', $record->id)),
                TextColumn::make('total_jual')
                    ->numeric()
                    ->sortable()
                    ->summarize(Sum::make()),
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
