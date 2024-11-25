<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\DosenWali;
use App\Models\Request;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use App\Filament\Resources\DosenWaliResource\Pages\ListDosenwalis;
use App\Filament\Resources\DosenWaliResource\Pages\CreateDosenWali;
use App\Filament\Resources\DosenWaliResource\Pages\EditDosenWali;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class DosenWaliResource extends Resource
{
    protected static ?string $model = DosenWali::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('user_id')
                            ->required()
                            ->unique(ignorable: fn($record) => $record),
    
                        // Menghubungkan kelas_id langsung ke tabel kelas
                        Select::make('kelas_id')
                            ->label('Kelas')
                            ->relationship('kelas', 'name') // Relasi langsung dengan tabel kelas
                            ->required(),
    
                        TextInput::make('kode_dosen')
                            ->required(),
                        
                        TextInput::make('nip')
                            ->required(),
                        
                        TextInput::make('name')
                            ->required(),
                    ])
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user_id'),
                TextColumn::make('kelas_id'),
                TextColumn::make('kode_dosen'),
                TextColumn::make('nip'),
                TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('approve')
                    ->label('Approve')
                    ->action(function (Request $record) {
                        $mahasiswa = $record->mahasiswa;
                        $mahasiswa->update($record->data_baru); // Update data mahasiswa
                        $record->delete(); // Hapus request setelah approve
                    })
                    ->visible(fn () => auth()->user()->role === 'dosenwalis')
                    ->color('success')
                    ->requiresConfirmation(),
                Action::make('reject')
                    ->label('Reject')
                    ->action(function (Request $record) {
                        $record->delete(); // Hapus request setelah reject
                    })
                    ->visible(fn () => auth()->user()->role === 'dosenwalis')
                    ->color('danger')
                    ->requiresConfirmation(),
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
            'index' => ListDosenwalis::route('/listdosenwalis'),
            'create' => CreateDosenWali::route('/createdosenwali'),
            'edit' => EditDosenWali::route('/{record}/editdosenwali'),
        ];
    }
}
