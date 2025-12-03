<x-filament-panels::page>
    <form wire:submit.prevent="save">

        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            Simpan Review
        </x-filament::button>

    </form>
</x-filament-panels::page>
