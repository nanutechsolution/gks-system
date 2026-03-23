<x-filament-panels::page>
    {{ $this->form }}
    <form wire:submit="save">
        <div class="mt-4 flex justify-end">
            <x-filament::button type="submit" size="lg" icon="heroicon-o-check-circle">
                Simpan Pengaturan
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>