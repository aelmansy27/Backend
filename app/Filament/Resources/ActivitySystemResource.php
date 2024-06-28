<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivitySystemResource\Pages;
use App\Filament\Resources\ActivitySystemResource\RelationManagers;
use App\Models\ActivitySystem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivitySystemResource extends Resource
{
    protected static ?string $model = ActivitySystem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Systems';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\Select::make('breading_system_id')
                    ->label('Breading System')
                    ->options(ActivitySystem::all()->pluck('name','id'))
                    ->searchable(),
                Forms\Components\Textarea::make('goal'),
                Forms\Components\Textarea::make('description'),
                Forms\Components\Textarea::make('cause_of_creation'),
                Forms\Components\Textarea::make('activities'),
                Forms\Components\TimePicker::make('sleep_time'),
                Forms\Components\TimePicker::make('wakeup_time')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('breadingSystem.name')
                    ->url(fn (ActivitySystem $record) =>BreadingSystemResource::getUrl('edit',['record'=>$record->breadingSystem])),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('goal')
                    ->limit(50),
                Tables\Columns\TextColumn::make('cause_of_creation')
                    ->limit(50),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50),
                Tables\Columns\TextColumn::make('activities')
                    ->limit(50),
                Tables\Columns\TextColumn::make('sleep_time'),
                Tables\Columns\TextColumn::make('wakeup_time'),


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
            'index' => Pages\ListActivitySystems::route('/'),
            'create' => Pages\CreateActivitySystem::route('/create'),
            'edit' => Pages\EditActivitySystem::route('/{record}/edit'),
        ];
    }
}
