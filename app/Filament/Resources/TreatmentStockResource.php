<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreatmentStockResource\Pages;
use App\Filament\Resources\TreatmentStockResource\RelationManagers;
use App\Models\TreatmentStock;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentStockResource extends Resource
{
    protected static ?string $model = TreatmentStock::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Stocks';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\Select::make('type')
                    ->options([
                        'tablet'=>'Tablet',
                        'liquid'=>'Liquid',
                        'others'=>'Others'

                    ]),
                Forms\Components\DateTimePicker::make('manufacturing_date'),
                Forms\Components\TextInput::make('manufacturing_code'),
                Forms\Components\DatePicker::make('validation_period'),
                Forms\Components\TextInput::make('efficiency')
                    ->numeric(),
                Forms\Components\TextInput::make('concentration')
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('efficiency'),
                Tables\Columns\TextColumn::make('concentration'),
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
            'index' => Pages\ListTreatmentStocks::route('/'),
            'create' => Pages\CreateTreatmentStock::route('/create'),
            'edit' => Pages\EditTreatmentStock::route('/{record}/edit'),
        ];
    }
}
