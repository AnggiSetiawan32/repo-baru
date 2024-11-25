<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\LeaveRequest;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use EightyNine\Approvals\Models\ApprovableModel;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\LeaveRequestResource\Pages;
use EightyNine\Approvals\Tables\Actions\ApprovalActions;
use EightyNine\Approvals\Tables\Columns\ApprovalStatusColumn;
use App\Filament\Resources\LeaveRequestResource\RelationManagers;
use Filament\Resources\Pages\ViewRecord;

class ViewLeaveRequest extends ViewRecord
{
    use \EightyNine\Approvals\Traits\HasApprovalHeaderActions;

    protected static string $resource = LeaveRequestResource::class;

    /**
     * Get the completion action.
     *
     * @return Filament\Actions\Action
     * @throws Exception
     */
    protected function getOnCompletionAction(): Action
    {
        return Action::make("Done")
            ->color("success")
            ->hidden(fn(ApprovableModel $record) => $record->shouldBeHidden());
    }
}

class LeaveRequestResource extends Resource
{
    protected static ?string $model = LeaveRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Beranda';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('kelas_id')->required(),
                TextInput::make('mahasiswa_id')->required(),
                TextInput::make('keterangan')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama Kelas'),
                TextColumn::make('kelas_id')->label('Kelas Id'),
                TextColumn::make('mahasiswa_id')->label('Mahasiswa Id'),
                TextColumn::make('keterangan')->label('Keterangan'),
                ApprovalStatusColumn::make("approvalStatus.status"),
            ])
            ->filters([
                // Define any custom filters here if needed
            ])
            ->actions([
                ...ApprovalActions::make(
                    Tables\Actions\Action::make("Done")
                        ->color("success"),
                    [
                        Tables\Actions\EditAction::make(),
                        
                        Tables\Actions\ViewAction::make(),
                    ]
                ),
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
            // Define relationships if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeaveRequests::route('/'),
            'create' => Pages\CreateLeaveRequest::route('/create'),
            'edit' => Pages\EditLeaveRequest::route('/{record}/edit'),
        ];
    }
}
