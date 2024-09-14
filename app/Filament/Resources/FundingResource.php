<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FundingResource\Pages;
use App\Filament\Resources\FundingResource\RelationManagers;
use App\Models\Funding;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FundingResource extends Resource
{
    protected static ?string $model = Funding::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Bantuan';

    protected static ?string $navigationGroup = 'Manajemen Bantuan';


    //protected static ?string $modelLabel = 'Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_bantuan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total_bantuan')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sumber_bantuan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_bantuan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_bantuan')
                    ->money(currency: 'IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('sumber_bantuan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
              
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
            'index' => Pages\ListFundings::route('/'),
            'create' => Pages\CreateFunding::route('/create'),
            'view' => Pages\ViewFunding::route('/{record}'),
            'edit' => Pages\EditFunding::route('/{record}/edit'),
        ];
    }
}
