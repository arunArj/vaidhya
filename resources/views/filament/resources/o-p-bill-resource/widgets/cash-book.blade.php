<style>
    .custom-card-width {
        /* Adjust the width as needed */
        width: calc((100% / 12) * 6);
        /* This sets the max width to avoid stretching on larger screens */
        max-width: calc((100% / 12) * 6);
        /* Add display flex to make the cards inline */
        display: flex;
        /* Adjust spacing between cards if needed */
        gap: 16px; /* Change as per your design */
    }
</style>

<x-filament::widget class="custom-card-width">
    <x-filament::card>
        {{-- Widget content --}}
        <x-slot name="header">
            <h2 class="text-xl font-semibold">Expense This month</h2>
        </x-slot>

        <x-slot name="footer">
            <!-- Footer content -->

        </x-slot>
    </x-filament::card>
    <x-filament::card>
        {{-- Widget content --}}
        <x-slot name="header">
            <h2 class="text-xl font-semibold">Income This month</h2>
        </x-slot>

        <x-slot name="footer">
            <!-- Footer content -->
            sds
        </x-slot>
    </x-filament::card>
</x-filament::widget>
