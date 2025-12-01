<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SopResource\Pages;
use App\Filament\Resources\SopResource\RelationManagers;
use App\Models\Sop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SopResource extends Resource
{
    protected static ?string $model = Sop::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('user_id')
                ->label('Pengguna')
                ->relationship('user', 'name')
                ->required(),

            Forms\Components\TextInput::make('nomor_sk')
                ->label('Nomor SK')
                ->required()
                ->unique(ignoreRecord: true),

            Forms\Components\Select::make('type')
                ->label('Tipe SOP')
                ->options([
                    'NonAP' => 'Non AP',
                    'AP' => 'AP',
                ])
                ->required(),

            Forms\Components\Select::make('id_unit')
                ->label('ID Unit')
                ->relationship('unit', 'id_unit')
                ->required(),

            Forms\Components\TextInput::make('sop_name')
                ->label('Nama SOP')
                ->required(),

            Forms\Components\Textarea::make('desc')
                ->label('Deskripsi')
                ->required(),

            Forms\Components\DatePicker::make('approval_date')
                ->label('Tanggal Disetujui')
                ->required(),

            Forms\Components\DatePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->required(),

            Forms\Components\DatePicker::make('exp')
                ->label('Tanggal Expired')
                ->required(),

            Forms\Components\TextInput::make('days_left')
                ->label('Sisa Hari')
                ->numeric()
                ->required(),

            Forms\Components\FileUpload::make('file_path')
                ->label('File SOP')
                ->directory('sop-files')
                ->required(),

            Forms\Components\Select::make('status')
                ->label('Status')
                ->options([
                    'Pending' => 'Pending',
                    'Approved' => 'Approved',
                    'Rejected' => 'Rejected',
                    'Expired' => 'Expired',
                ])
                ->required(),

            Forms\Components\TextInput::make('revision')
                ->label('Revisi')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id_sop')
                ->label('ID SOP')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('user.name')
                ->label('User')
                ->sortable(),

            Tables\Columns\TextColumn::make('nomor_sk')
                ->label('Nomor SK')
                ->searchable(),

            Tables\Columns\TextColumn::make('type')
                ->label('Tipe'),

            Tables\Columns\TextColumn::make('sop_name')
                ->label('Nama SOP')
                ->searchable(),

            Tables\Columns\TextColumn::make('approval_date')
                ->label('Disetujui')
                ->date(),

            Tables\Columns\TextColumn::make('exp')
                ->label('Expired')
                ->date(),

            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->badge()
                ->colors([
                    'warning' => 'Pending',
                    'success' => 'Approved',
                    'danger'  => 'Rejected',
                    'gray'    => 'Expired',
                ]),

            Tables\Columns\TextColumn::make('revision')
                ->label('Revisi'),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime('d M Y'),
        ])
        ->filters([])
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
            'index' => Pages\ListSops::route('/'),
            'create' => Pages\CreateSop::route('/create'),
            'edit' => Pages\EditSop::route('/{record}/edit'),
        ];
    }
}
