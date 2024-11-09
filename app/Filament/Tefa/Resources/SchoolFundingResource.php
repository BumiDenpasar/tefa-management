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

    protected static ?string $navigationLabel = 'Fundings';

    // protected static ?string $modelLabel = 'Sekolah';

    protected static ?string $navigationGroup = 'School Management';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Select::make('school_id')
                    ->relationship('schools', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('funding_id')
                    ->relationship('fundings', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fundings.name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('fundings.amount')
                ->label('Amount')
                ->money(currency: 'IDR')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('fundings.source')
                    ->label('Source')
                    ->searchable()
                    ->sortable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
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

    public static function canCreate(): bool
    {
       return false;
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
