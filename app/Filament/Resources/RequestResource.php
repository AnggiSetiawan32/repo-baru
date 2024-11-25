<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestResource\Pages;
use App\Models\Request;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RequestResource extends Resource
{
    protected static ?string $model = Request::class;

    // Mengganti ikon dengan yang lebih sesuai untuk tema "request"
    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationGroup = 'Beranda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Permintaan')
                    ->schema([
                        TextInput::make('kelas_id')
                            ->label('ID Kelas')
                            ->required()
                            ->unique(ignoreRecord: true),
                        
                        TextInput::make('mahasiswa_id')
                            ->label('ID Mahasiswa')
                            ->required(),
                        
                        TextInput::make('keterangan')
                            ->label('Keterangan')
                            ->required(),
                    ])
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kelas_id')
                    ->label('ID Kelas'),

                TextColumn::make('mahasiswa_id')
                    ->label('ID Mahasiswa'),

                TextColumn::make('keterangan')
                    ->label('Keterangan'),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
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
            // Tambahkan relations jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequests::route('/'),
            'create' => Pages\CreateRequest::route('/create'),
            'edit' => Pages\EditRequest::route('/{record}/edit'),
        ];
    }
}
