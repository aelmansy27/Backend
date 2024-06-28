<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BreadingSystemResource\Pages;
use App\Filament\Resources\BreadingSystemResource\RelationManagers;
use App\Models\BreadingSystem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BreadingSystemResource extends Resource
{
    protected static ?string $model = BreadingSystem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Systems';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\Textarea::make('goal'),
                Forms\Components\Textarea::make('cause_of_creation'),
                Forms\Components\Textarea::make('description')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('goal'),
                Tables\Columns\TextColumn::make('cause_of_creation')
                    ->limit(50),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50),
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
            'index' => Pages\ListBreadingSystems::route('/'),
            'create' => Pages\CreateBreadingSystem::route('/create'),
            'edit' => Pages\EditBreadingSystem::route('/{record}/edit'),
        ];
    }
}
