@php
$expense = $sum=0;
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

      <div class="bg-gray-100 py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto grid gap-6 md:grid-cols-2">
          <!-- Income Card -->
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg font-bold leading-6 text-gray-900">Income</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">Total income received</p>
            </div>
            <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
              <div class="text-3xl font-bold text-center text-green-500">
                @php

                foreach($this->records as $item){
                    if($item->type=='0')
                    $sum = $sum+$item->amount;
                    else
                    $expense = $expense+$item->amount;
                }
                echo $sum;
                @endphp

              </div>
            </div>
          </div>

          <!-- Expense Card -->
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
              <h3 class="text-lg font-bold leading-6 text-gray-900">Expense</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">Total expenses incurred</p>
            </div>
            <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
              <div class="text-3xl font-bold text-center text-red-500">
                {{$expense}}
              </div>
            </div>
          </div>
        </div>
      </div>

    {{ \Filament\Facades\Filament::renderHook('resource.pages.list-records.table.end') }}

</x-filament::page>
