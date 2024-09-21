<?php

namespace App\Filament\Tefa\Resources;

use App\Filament\Tefa\Resources\SchoolFundingResource\Pages;
use App\Filament\Tefa\Resources\SchoolFundingResource\RelationManagers;
use App\Models\SchoolFunding;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolFundingResource extends Resource
{
    protected static ?string $model = SchoolFunding::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationLabel = 'Bantuan';

    // protected static ?string $modelLabel = 'Sekolah';

    protected static ?string $navigationGroup = 'Manajemen Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_sekolah')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('id_bantuan')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bantuan.nama_bantuan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bantuan.total_bantuan')
                    ->label('Total Bantuan')
                    ->searchable()
                    ->sortable()
                    ->money('idr'),
                Tables\Columns\TextColumn::make('bantuan.sumber_bantuan')
                    ->label('Sumber bantuan')
                    ->searchable()
                    ->sortable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ListSchoolFundings::route('/'),
            'create' => Pages\CreateSchoolFunding::route('/create'),
            'view' => Pages\ViewSchoolFunding::route('/{record}'),
            'edit' => Pages\EditSchoolFunding::route('/{record}/edit'),
        ];
    }
}
