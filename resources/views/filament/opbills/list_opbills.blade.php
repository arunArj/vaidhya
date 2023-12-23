@php
$sum=0;
@endphp

<x-filament::page
    :class="
        \Illuminate\Support\Arr::toCssClasses([
            'filament-resources-list-records-page',
            'filament-resources-' . str_replace('/', '-', $this->getResource()::getSlug()),
        ])
    "
>

    {{ \Filament\Facades\Filament::renderHook('resource.pages.list-records.table.start') }}

    {{ $this->table }}

    <div class="bg-gray-200 py-6 px-4 sm:px-6 lg:px-8 w-full">
        <div class="max-w-7xl mx-auto">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg font-bold leading-6 text-gray-900">Grand Total</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">The total amount in Rupees.</p>
            </div>
            <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
              <!-- Content goes here -->
              <div class="text-3xl font-bold text-center text-gray-900">
                @php
                foreach($this->records as $item){
                    $sum = $sum+$item->total;

                }
                echo $sum;
                @endphp
              </div>
            </div>
          </div>
        </div>
      </div>

    {{ \Filament\Facades\Filament::renderHook('resource.pages.list-records.table.end') }}

</x-filament::page>
