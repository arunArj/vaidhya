<x-filament::page
    :widget-data="['record' => $record]"
    :class="
        \Illuminate\Support\Arr::toCssClasses([
            'filament-resources-view-record-page',
            'filament-resources-' . str_replace('/', '-', $this->getResource()::getSlug()),
            'filament-resources-record-' . $record->getKey(),
        ])
    "
>
    @php
        $relationManagers = $this->getRelationManagers();
            $advanceSum=0;
            $refundSum=0;
            foreach ($record->advances as $key => $value) {
                $advanceSum += $value->cashbook->amount;
                $refundSum += $value->cashbook->refund;
            }
    @endphp
<div class="grid grid-cols-12 gap-4">
    <div class="col-span-8">
        <!-- Header displaying patient name, MRD number, age, and gender -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
          <div class="flex items-center justify-between mb-4">
            <div>
              <h2 class="text-xl font-semibold">John Doe</h2>
              <p class="text-gray-600">MRD Number: 426614174000</p>
            </div>
            <div>
              <p class="text-gray-600">Age: 35</p>
              <p class="text-gray-600">Gender: Male</p>
            </div>
          </div>
          <hr class="my-4 border-t-2 border-gray-300">

          <!-- Rest of the patient details -->
          <div class="grid grid-cols-4 gap-y-2">

            <div>
                <p class="text-gray-600 font-semibold">Recidency</p>
                <p class="text-gray-800">Local</p>
            </div>


            <div>
              <p class="text-gray-600 font-semibold">Phone</p>
              <p class="text-gray-800">(123) 456-7890</p>
            </div>
            <div>
              <p class="text-gray-600 font-semibold">Date of Birth</p>
              <p class="text-gray-800">1988-05-23</p>
            </div>
            <div>
                <p class="text-gray-600 font-semibold">Address</p>
                <p class="text-gray-800">123 Main St, City, Country</p>
              </div>
          </div>
        </div>
        <div class="bg-white rounded-lg shadow-md p-6">

            @if (count($relationManagers))
            @if (! $this->hasCombinedRelationManagerTabsWithForm())

            @endif

            <x-filament::resources.relation-managers
                :active-manager="$activeRelationManager"
                :form-tab-label="$this->getFormTabLabel()"
                :managers="$relationManagers"
                :owner-record="$record"
                :page-class="static::class"
            >
                @if ($this->hasCombinedRelationManagerTabsWithForm())
                    <x-slot name="form">
                        {{ $this->form }}
                    </x-slot>
                @endif
            </x-filament::resources.relation-managers>
        @endif
        </div>
    </div>
    <div class="col-span-4">
        <!-- Card displaying bills -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-lg font-semibold mb-4">Bills</h2>
          <ul class="divide-y divide-gray-200">
            <li class="py-3">
              <a href="/admin/advances" class="block text-blue-500 font-semibold hover:underline">
                Advance
              </a>
              <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Amount:</span>
                <span class="text-gray-800">{{ $advanceSum}}</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Refund:</span>
                <span class="text-gray-800">{{$refundSum}}</span>
              </div>
            </li>
            <li class="py-3">
              <a href="/performa-bill" class="block text-blue-500 font-semibold hover:underline">
                Performa Bill
              </a>
              <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Yet to be received:</span>
                <span class="text-gray-800">$100</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Already received:</span>
                <span class="text-gray-800">$100</span>
              </div>
            </li>
            <li class="py-3">
              <a href="/lab-bill" class="block text-blue-500 font-semibold hover:underline">
                Lab Bill
              </a>
              <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Yet to be received:</span>
                <span class="text-gray-800">$75</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Already received:</span>
                <span class="text-gray-800">$75</span>
              </div>
            </li>
            <li class="py-3">
              <a href="/ip-bill" class="block text-blue-500 font-semibold hover:underline">
                IP Bill
              </a>
              <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Yet to be received:</span>
                <span class="text-gray-800">$250</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-500 text-sm">Already received:</span>
                <span class="text-gray-800">$250</span>
              </div>
            </li>
            <!-- Add more bills as needed -->
          </ul>
        </div>
    </div>
</div>



    {{-- @if ((! $this->hasCombinedRelationManagerTabsWithForm()) || (! count($relationManagers)))
        {{ $this->form }}
    @endif --}}




    {{-- @if (count($relationManagers))
        @if (! $this->hasCombinedRelationManagerTabsWithForm())
            <x-filament::hr />
        @endif

        <x-filament::resources.relation-managers
            :active-manager="$activeRelationManager"
            :form-tab-label="$this->getFormTabLabel()"
            :managers="$relationManagers"
            :owner-record="$record"
            :page-class="static::class"
        >
            @if ($this->hasCombinedRelationManagerTabsWithForm())
                <x-slot name="form">
                    {{ $this->form }}
                </x-slot>
            @endif
        </x-filament::resources.relation-managers>
    @endif --}}
</x-filament::page>
