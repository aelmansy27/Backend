<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MilkAmountResource\Pages;
use App\Filament\Resources\MilkAmountResource\RelationManagers;
use App\Models\MilkAmount;
use Faker\Provider\ar_EG\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MilkAmountResource extends Resource
{
    protected static ?string $model = MilkAmount::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cow.cowId'),
                Tables\Columns\TextColumn::make('morning_amount'),
                Tables\Columns\TextColumn::make('afternoon_amount')
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
            'index' => Pages\ListMilkAmounts::route('/'),
            'create' => Pages\CreateMilkAmount::route('/create'),
            'edit' => Pages\EditMilkAmount::route('/{record}/edit'),
        ];
    }
}
