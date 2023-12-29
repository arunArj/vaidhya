<x-filament::page>
    <div class="container mx-auto p-6">
        <div class="flex justify-center space-x-4 items-center mb-6">
            <label for="fromDate" class="mr-2">From Date:</label>
            <input type="date" wire:model="from_date" value="{{$from_date}}" wire:change="getProfitandLoss" id="fromDate" class="border rounded-md px-4 py-2">
            <label for="toDate" class="ml-4 mr-2">To Date:</label>
            <input type="date" wire:model="to_date" value="{{$to_date}}" wire:change="getProfitandLoss" id="toDate" class="border rounded-md px-4 py-2">

          </div>
        <!-- Category List -->
        {{-- <div class="space-y-6">
            @foreach ($result as $item)
            <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md">
                <!-- Category Header -->
                <div class="flex justify-between items-center px-6 py-4 cursor-pointer" @click="open = !open">
                  <div class="flex items-center">
                    <svg x-show="!open" class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    <svg x-show="open" class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                    <h2 class="text-xl font-semibold">{{$item['title']}}</h2>
                  </div>
                  <p class="text-lg font-semibold">{{$item['mainCategorySum']}}</p>
                </div>
                <!-- Collapsible Content -->
                <div x-show="open" class="px-6 pb-4" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                  <!-- Subcategories -->
                  <ul class="space-y-2">
                  @foreach ($item['subCategory'] as $sub)
                  <li class="flex justify-between items-center">
                    <span>{{$sub['title']}}</span>
                    <span>{{$sub['subCategorySum']}}</span>
                  </li>
                  @endforeach

                  </ul>
                </div>
              </div>
            @endforeach

        </div> --}}
        <div class="space-y-6">
            @php $grant = 0; @endphp
            @foreach ($result as $item)
                    @php
                       $grant = $grant+ $item['mainCategorySum'];
                    @endphp
                <div x-data="{ open: false }" class="bg-white rounded-lg shadow-md">
                    <!-- Category Header -->
                    <div class="flex justify-between items-center px-6 py-4 cursor-pointer" @click="open = !open">
                        <div class="flex items-center">
                            <svg x-show="!open" class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            <svg x-show="open" class="h-5 w-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path></svg>
                            <h2 class="text-xl font-semibold">{{$item['title']}}</h2>
                        </div>
                        <p class="text-lg font-semibold">{{$item['mainCategorySum']}}</p>
                    </div>

                    <!-- Collapsible Content -->
                    <div x-show="open" class="px-6 pb-4" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
                        <!-- Subcategories -->
                        <ul class="space-y-2">
                            @include('filament.inc.subcategories', ['subcategories' => $item['subCategory']])
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
      </div>
      <script>
        document.addEventListener('alpine:init', () => {
          Alpine.data('toggle', () => ({
            open: false,
          }));
        });
      </script>
</x-filament::page>
