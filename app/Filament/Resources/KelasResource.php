<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KelasResource\Pages;
use App\Filament\Resources\KelasResource\RelationManagers\MahasiswaRelationManager;
use App\Models\Kelas;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class KelasResource extends Resource
{
    protected static ?string $model = Kelas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Beranda';

    public static function form(Forms\Form $form): Forms\Form // Pastikan import ini benar
    {
        return $form
            ->schema([
                Section::make('Detail Kelas')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Kelas')
                            ->required(),
                        TextInput::make('jumlah')
                            ->label('Jumlah Kapasitas')
                            ->numeric()
                            ->required(),
                    ])
            ])
            ->columns(2); 
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama Kelas'),
                TextColumn::make('jumlah')->label('Jumlah Kapasitas'),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            MahasiswaRelationManager::class
          
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKelas::route('/'),
            'create' => Pages\CreateKelas::route('/create'),
            'edit' => Pages\EditKelas::route('/{record}/edit'),
        ];
    }
}
