<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedStockResource\Pages;
use App\Filament\Resources\FeedStockResource\RelationManagers;
use App\Models\FeedStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedStockResource extends Resource
{
    protected static ?string $model = FeedStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationGroup = 'Stocks';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\Select::make('type')
                    ->options([
                        'forage'=>'Forage',
                        'concentrates'=>'Concentrates',
                        'Supplements'=>'Supplements'

                    ]),
                Forms\Components\DateTimePicker::make('manufacturing_date'),
                Forms\Components\TextInput::make('manufacturing_code'),
                Forms\Components\DatePicker::make('validation_period'),
                Forms\Components\TextInput::make('producer'),
                Forms\Components\TextInput::make('amount')
                    ->numeric()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('manufacturing_date'),
                Tables\Columns\TextColumn::make('manufacturing_code')->searchable(),
                Tables\Columns\TextColumn::make('validation_period'),
                Tables\Columns\TextColumn::make('producer'),
                Tables\Columns\TextColumn::make('amount')
            ])
            ->filters([
                //
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedStocks::route('/'),
            'create' => Pages\CreateFeedStock::route('/create'),
            'edit' => Pages\EditFeedStock::route('/{record}/edit'),
        ];
    }
}
