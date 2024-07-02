<?php

namespace App\Filament\Resources;

use App\Enums\ActivityType;
use App\Filament\Resources\ActivityPlaceResource\Pages;
use App\Filament\Resources\ActivityPlaceResource\RelationManagers;
use App\Models\ActivityPlace;
use App\Models\ActivitySystem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityPlaceResource extends Resource
{
    protected static ?string $model = ActivityPlace::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?int $navigationSort = 4;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\Select::make('type')
                    ->label('Activity Type')
                    ->options(ActivityType::class)
                    ->searchable(),
                Forms\Components\Select::make('activity_system_id')
                    ->label('Activity System')
                    ->options(ActivitySystem::all()->pluck('name','id'))
                    ->searchable(),
                Forms\Components\FileUpload::make('image'),
                Forms\Components\TextInput::make('goal'),
                Forms\Components\Textarea::make('description'),
                Forms\Components\TextInput::make('capacity')
                    ->numeric(),
                Forms\Components\TextInput::make('latitude'),
                Forms\Components\TextInput::make('longitude')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('activitySystem.name')
                    ->url(fn (ActivityPlace $record) => ActivitySystemResource::getUrl('edit',['record'=>$record->activitySystem])),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('goal')
                    ->limit(50),
                Tables\Columns\TextColumn::make('description')
                    ->limit(50),
                Tables\Columns\TextColumn::make('capacity'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('latitude'),
                Tables\Columns\TextColumn::make('longitude')
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
            'index' => Pages\ListActivityPlaces::route('/'),
            'create' => Pages\CreateActivityPlace::route('/create'),
            'edit' => Pages\EditActivityPlace::route('/{record}/edit'),
        ];
    }
}
