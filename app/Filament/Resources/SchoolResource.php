<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Filament\Resources\SchoolResource\RelationManagers;
use App\Models\Sale;
use App\Models\School;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolResource extends Resource
{
    protected static ?string $model = School::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Sekolah';

    // protected static ?string $modelLabel = 'Sekolah';

    protected static ?string $navigationGroup = 'Manajemen TeFa';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_sekolah')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nama_tefa')
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('no_kontak')
                    ->maxLength(255),
                Forms\Components\TextInput::make('npsn')
                    ->maxLength(255),
                FileUpload::make('logo')
                    ->label('Logo Sekolah')
                    ->image(),
                Forms\Components\TextInput::make('sosial_media')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_sekolah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_tefa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_pemasukan')
                    ->label('Total Pemasukan')
                    ->money('idr')
                    ->getStateUsing(function (School $record) {
                        return Sale::whereHas('produk', function ($query) use ($record) {
                            $query->where('id_sekolah', $record->id);
                        })->sum('pemasukan');
                    }),
                Tables\Columns\TextColumn::make('no_kontak')
                    ->searchable(),
                Tables\Columns\TextColumn::make('npsn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Grid::make()
                    ->schema([
                        Section::make('Profile Sekolah')
                            ->collapsible()  // Add collapsible functionality
                            ->schema([

                                Split::make([
                                    ImageEntry::make('logo')
                                        ->hiddenLabel()
                                        ->defaultImageUrl(url('/images/school-placeholder.jpg'))
                                        ->height(285)
                                        ->extraImgAttributes([
                                            'alt' => 'Logo',
                                            'loading' => 'lazy',
                                        ])
                                        ->circular(),
                                    Grid::make(1)  // Use Grid for better organization
                                        ->schema([
                                            TextEntry::make('nama_sekolah')
                                                ->hiddenLabel()
                                                ->weight(FontWeight::SemiBold)
                                                ->size(TextEntry\TextEntrySize::Large),
                                            TextEntry::make('nama_tefa'),
                                            TextEntry::make('no_kontak')->label('No. Kontak')->copyable()
                                                ->copyMessage('Copied!')
                                                ->copyMessageDuration(1500),
                                            TextEntry::make('npsn')->label('NPSN')->copyable()
                                                ->copyMessage('Copied!')
                                                ->copyMessageDuration(1500),
                                        ]),
                                    TextEntry::make('sosial_media')
                                        ->url(url: fn(School $record): string => $record->sosial_media ? $record->sosial_media : '')
                                        ->openUrlInNewTab()
                                        ->label('Sosial Media'),
                                ])->from('md'),

                            ]),

                        // Detail Section
                        Section::make('Detail')
                            ->collapsible()  // Add collapsible functionality
                            ->schema([
                                TextEntry::make('deskripsi')
                                    ->label('Deskripsi'),
                                TextEntry::make('users.name')
                                    ->label('Operator')
                                    ->icon('heroicon-s-user-circle')
                                    ->iconColor('primary')
                                    ->listWithLineBreaks()
                                    ->limitList(3)
                                    ->expandableLimitedList(),
                            ]),

                        Section::make('Bantuan')
                            ->collapsible()
                            ->schema([
                                RepeatableEntry::make('bantuan')
                                    ->label('')
                                    ->schema([
                                        TextEntry::make('nama_bantuan'),
                                        TextEntry::make('total_bantuan')->money(currency: 'IDR'),
                                        TextEntry::make('sumber_bantuan')
                                    ])
                                    ->grid(2)
                                    ->placeholder('Sekolah belum menerima bantuan.')

                            ]),

                        Section::make('Produk')
                            ->collapsible()
                            ->schema([
                                RepeatableEntry::make('produk')
                                    ->hiddenLabel()
                                    ->grid(2)
                                    ->schema([
                                        Split::make([
                                            ImageEntry::make('img')->hiddenLabel()
                                                ->height(250)
                                                ->extraImgAttributes([
                                                    'alt' => 'Logo',
                                                    'loading' => 'lazy',
                                                ]),
                                            Fieldset::make('')
                                                ->schema([
                                                    TextEntry::make('nama_produk')
                                                        ->hiddenLabel()
                                                        ->weight(FontWeight::Bold)
                                                        ->size(TextEntry\TextEntrySize::Large),
                                                    TextEntry::make('harga_produk')->money(currency: 'IDR')
                                                        ->hiddenLabel()
                                                        ->weight(FontWeight::SemiBold)
                                                        ->size(TextEntry\TextEntrySize::ExtraSmall),
                                                    TextEntry::make('deskripsi')
                                                        ->hiddenLabel()
                                                        ->size(TextEntry\TextEntrySize::Small),
                                                ])->columns(1),
                                        ])->from('2xl'),
                                    ])
                                    ->placeholder('Sekolah belum menambahkan produk.')

                            ])
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'view' => Pages\ViewSchool::route('/{record}'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
}
