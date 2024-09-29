<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolFundingResource\Pages;
use App\Filament\Resources\SchoolFundingResource\RelationManagers;
use App\Models\SchoolFunding;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class SchoolFundingResource extends Resource
{
    protected static ?string $model = SchoolFunding::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    protected static ?string $navigationLabel = 'Fundings History';

    protected static ?string $navigationGroup = 'Fundings Management';

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
                Tables\Columns\TextColumn::make('schools.name')
                    ->label('School')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fundings.name')
                    ->label('Funding')
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
                    ->date()
                    ->sortable(),
            ])->defaultSort('fundings.amount')


            ->filters([
                SelectFilter::make('schools')
                    ->relationship('schools', 'name')
                    ->label('School Filter')
                    ->indicator('School'),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                        ->label('From'),
                        DatePicker::make('created_until')
                        ->label('To'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
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
