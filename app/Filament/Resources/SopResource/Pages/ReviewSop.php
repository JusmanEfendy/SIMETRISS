<?php

namespace App\Filament\Resources\SopResource\Pages;

use App\Filament\Resources\SopResource;
use App\Models\Sop;
use Filament\Resources\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms;

class ReviewSop extends Page
{
    protected static string $resource = SopResource::class;

    protected static string $view = 'filament.resources.sops.review-sop';

    public Sop $record;

    public function mount($record): void
    {
        $this->record = Sop::findOrFail($record);
    }

    public function form(Form $form): Form
    {
        return $form
            ->model($this->record)
            ->schema([
                Forms\Components\Select::make('status')
                    ->label('Status Review')
                    ->options([
                        'Approved' => 'Approved',
                        'Rejected' => 'Rejected',
                    ])
                    ->required(),

                Forms\Components\Textarea::make('revision')
                    ->label('Catatan Revisi / Komentar'),
            ]);
    }

    public function save()
    {
        $data = $this->form->getState();
        $this->record->update($data);

        $this->notify('success', 'Review berhasil disimpan.');

        return redirect(SopResource::getUrl('index'));
    }
}
