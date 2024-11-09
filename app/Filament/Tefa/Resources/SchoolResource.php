<?php

namespace App\Filament\Tefa\Resources;

use App\Filament\Tefa\Resources\SchoolResource\Pages;
use App\Filament\Tefa\Resources\SchoolResource\RelationManagers;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Infolists\Components\Actions\Action;
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

    protected static ?string $navigationLabel = 'School';

    // protected static ?string $modelLabel = 'Sekolah';

    protected static ?string $navigationGroup = 'School Management';

    //protected static bool $shouldRegisterNavigation = false;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('tefa_name')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('contact_number')
                    ->maxLength(255),
                Forms\Components\TextInput::make('npsn')
                    ->maxLength(255),
                FileUpload::make('logo')
                    ->label('Logo')
                    ->image(),
                Forms\Components\TextInput::make('social_media')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tefa_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contact_number')
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
                        Section::make('School Profile')
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
                                            TextEntry::make('name')
                                                ->hiddenLabel()
                                                ->weight(FontWeight::SemiBold)
                                                ->size(TextEntry\TextEntrySize::Large),
                                            TextEntry::make('tefa_name'),
                                            TextEntry::make('contact_number')->copyable()
                                                ->copyMessage('Copied!')
                                                ->copyMessageDuration(1500),
                                            TextEntry::make('npsn')->label('NPSN')->copyable()
                                                ->copyMessage('Copied!')
                                                ->copyMessageDuration(1500),
                                        ]),
                                    TextEntry::make('social_media')
                                        ->url(url: fn(School $record): string => $record->social_media ? $record->social_media : '')
                                        ->openUrlInNewTab(),
                                ])->from('md'),

                            ]),

                        // Detail Section
                        Section::make('Detail')
                            ->collapsible()  // Add collapsible functionality
                            ->schema([
                                TextEntry::make('description'),
                                TextEntry::make('users.name')
                                    ->label('Operator')
                                    ->icon('heroicon-s-user-circle')
                                    ->iconColor('primary')
                                    ->listWithLineBreaks()
                                    ->limitList(3)
                                    ->expandableLimitedList(),
                            ]),

                        Section::make('Fundings')
                            ->collapsible()
                            ->schema([
                                RepeatableEntry::make('fundings')
                                    ->label('')
                                    ->schema([
                                        TextEntry::make('name'),
                                        TextEntry::make('amount')->money(currency: 'IDR'),
                                        TextEntry::make('source')
                                    ])
                                    ->grid(2)
                                    ->placeholder('Sekolah belum menerima bantuan.')

                            ]),

                        Section::make('Products')
                            ->collapsible()
                            ->schema([
                                RepeatableEntry::make('products')
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
                                                    TextEntry::make('name')
                                                        ->hiddenLabel()
                                                        ->weight(FontWeight::Bold)
                                                        ->size(TextEntry\TextEntrySize::Large),
                                                    TextEntry::make('price')->money(currency: 'IDR')
                                                        ->hiddenLabel()
                                                        ->weight(FontWeight::SemiBold)
                                                        ->size(TextEntry\TextEntrySize::ExtraSmall),
                                                    TextEntry::make('description')
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
            'index' => Pages\ListSchools::route('/'),
            'create' => Pages\CreateSchool::route('/create'),
            'view' => Pages\ViewSchool::route('/{record}'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
}
