<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kaprodi;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\KaprodiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KaprodiResource\RelationManagers;

class KaprodiResource extends Resource
{
    protected static ?string $model = Kaprodi::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationGroup = 'Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('user_id')->required()->unique(ignorable:fn($record)=>$record),
                        TextInput::make('kode_kaprodi')->required(),
                        TextInput::make('nip')->required(),
                        TextInput::make('name')->required(),
                    ])
            ])
            ->columns(2); 

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id'),
                TextColumn::make('kode_kaprodi'),
                TextColumn::make('nip'),
                TextColumn::make('name'),
                
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListKaprodis::route('/'),
            'create' => Pages\CreateKaprodi::route('/create'),
            'edit' => Pages\EditKaprodi::route('/{record}/edit'),
        ];
    }
}
