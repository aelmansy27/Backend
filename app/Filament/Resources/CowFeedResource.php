<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CowFeedResource\Pages;
use App\Filament\Resources\CowFeedResource\RelationManagers;
use App\Models\BreadingSystem;
use App\Models\Cow;
use App\Models\CowFeed;
use App\Models\FeedStock;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CowFeedResource extends Resource
{
    protected static ?string $model = CowFeed::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('cow_id')
                    ->label('Cow ID')
                    ->options(Cow::all()->pluck('cowId','id'))
                    ->searchable(),
                Forms\Components\Select::make('user_id')
                    ->label('Name of User')
                    ->options(User::all()->pluck('first_name','id' ))
                    ->searchable(),
                Forms\Components\Select::make('breadingsystem_id')
                    ->label('Breading System')
                    ->options(BreadingSystem::all()->pluck('name','id'))
                    ->searchable(),
                Forms\Components\Select::make('feedstock_id')
                    ->label('Feed Stock')
                    ->options(FeedStock::all()->pluck('name','id'))
                    ->searchable(),
                Forms\Components\TextInput::make('amount')
                    ->numeric(),
                Forms\Components\TextInput::make('actual_amount')
                    ->numeric(),
                Forms\Components\Repeater::make('eatingDates')
                    ->relationship()
                    ->schema([
                        Forms\Components\TimePicker::make('time')
                    ])
                    ->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('cow.cowId')
                    ->url(fn (CowFeed $record) => CowResource::getUrl('edit',['record'=>$record->cow]))
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.first_name')
                    ->url(fn (CowFeed $record) =>UserResource::getUrl('edit',['record'=>$record->user])),
                Tables\Columns\TextColumn::make('breadingSystem.name')
                    ->url(fn (CowFeed $record) => BreadingSystemResource::getUrl('edit',['record'=>$record->breadingSystem])),
                Tables\Columns\TextColumn::make('feedStock.name')
                    ->url(fn (CowFeed $record) => FeedStockResource::getUrl('edit',['record'=>$record->feedStock])),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('actual_amount')
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
            'index' => Pages\ListCowFeeds::route('/'),
            'create' => Pages\CreateCowFeed::route('/create'),
            'edit' => Pages\EditCowFeed::route('/{record}/edit'),
        ];
    }
}
