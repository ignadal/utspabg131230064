<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
          
                Forms\Components\TextInput::make('product_name')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('product_code')
                    ->label('Kode Produk')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),

                Forms\Components\DatePicker::make('tanggal_masuk')
                    ->label('Tanggal Masuk')
                    ->required(),

                Forms\Components\TextInput::make('quantity')
                    ->label('Jumlah')
                    ->required()
                    ->numeric(),

                SpatieMediaLibraryFileUpload::make('gambarproduk')
                    ->collection('gambarproduk')
                    ->label('Gambar Produk')
                    ->image()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
    return $table
        ->columns([
            SpatieMediaLibraryImageColumn::make('gambarproduk')
                ->collection('gambarproduk')
                ->label('Gambar')
                ->square()
                ->conversion('thumb') 
                ->height(70) 
                ->width(70)  
                ->extraImgAttributes(['class' => 'rounded-lg object-cover'])
                ->square(false),

            Tables\Columns\TextColumn::make('product_name')
                ->label('Product name')
                ->searchable(),

            Tables\Columns\TextColumn::make('product_code')
                ->label('Product code')
                ->searchable(),

            Tables\Columns\TextColumn::make('price')
                ->money('idr', true)
                ->sortable(),

            Tables\Columns\TextColumn::make('tanggal_masuk')
                ->date()
                ->sortable(),

            Tables\Columns\TextColumn::make('quantity')
                ->numeric()
                ->sortable(),
        ])
        ->actions([
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
