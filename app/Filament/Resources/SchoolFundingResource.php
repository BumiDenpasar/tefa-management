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

    protected static ?string $navigationLabel = 'Riwayat Bantuan';

    protected static ?string $navigationGroup = 'Manajemen Bantuan';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Forms\Components\Select::make('id_sekolah')
                    ->relationship('sekolah', 'nama_sekolah')
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\Select::make('id_bantuan')
                    ->relationship('bantuan', 'nama_bantuan')
                    ->searchable()
                    ->preload()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sekolah.nama_sekolah')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bantuan.nama_bantuan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bantuan.total_bantuan')
                    ->label('Total Bantuan')
                    ->money(currency: 'IDR')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
            ])->defaultSort('bantuan.total_bantuan')


            ->filters([
                SelectFilter::make('sekolah')
                    ->relationship('sekolah', 'nama_sekolah')
                    ->label('Filter sekolah')
                    ->indicator('Sekolah'),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                        ->label('Dibuat dari tanggal'),
                        DatePicker::make('created_until')
                        ->label('Sampai tanggal'),
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
