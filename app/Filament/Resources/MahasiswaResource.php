<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Kelas;
use Filament\Forms\Form;
use App\Models\Mahasiswa;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\Action;
use App\Tables\Actions\RequestAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers\KelasIdRelationManager;


class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Menu';

    public static function form(Form $form): Form
    {
        $mahasiswa = Mahasiswa::find(1);
        $kelas = $mahasiswa->kelas;
        return $form
            ->schema([
                Section::make('Detail Mahasiswa')
                    ->schema([
                        TextInput::make('user_id')
                            ->label('User ID')
                            ->required()
                            ->unique(ignorable: fn($record) => $record),

                        Select::make('kelas_id')
                            ->label('Kelas')
                            ->relationship('kelas','id' ) // Pastikan relasi kelas diatur dengan kolom yang sesuai

                            ->required(),

                        TextInput::make('nim')
                            ->label('NIM')
                            ->required(),

                        TextInput::make('name')
                            ->label('Nama')
                            ->required(),

                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->required(),

                        TextInput::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required(),
                        
                    ])
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id')->label('User ID'),
                TextColumn::make('kelas_id')->label('Kelas'),
                TextColumn::make('nim')->label('NIM'),
                TextColumn::make('name')->label('Nama'),
                TextColumn::make('tempat_lahir')->label('Tempat Lahir'),
                TextColumn::make('tanggal_lahir')->label('Tanggal Lahir'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /**
     * Filter data berdasarkan user yang login.
     */
    public static function query()
    {
        $query = parent::query(); // Ambil query dasar

        // Jika role mahasiswa, filter data hanya untuk user yang login
        if (Auth::user()->role === 'mahasiswa') {
            $query->where('user_id', Auth::id()); // Filter berdasarkan ID user yang login
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [
            // KelasIdRelationManager::class
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
