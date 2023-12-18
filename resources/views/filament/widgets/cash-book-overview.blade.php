<x-filament::widget>
    <x-filament::card>

    <form class="flex flex-col sm:flex-row items-start sm:items-center sm:justify-between mb-4">
        <div class="mb-4 sm:flex-1 sm:mr-4">
          <label for="fromDate" class="block text-sm font-medium text-gray-700">From Date</label>
          <input type="date" id="fromDate" name="fromDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div class="mb-4 sm:flex-1 sm:ml-4">
          <label for="toDate" class="block text-sm font-medium text-gray-700">To Date</label>
          <input type="date" id="toDate" name="toDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div class="mt-4 sm:mt-0">
          <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-black bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Submit</button>
        </div>
      </form>

      <div class="border-t mt-6 pt-6">

            <h2 class="text-lg font-semibold mb-4">Bills</h2>
            <ul class="divide-y divide-gray-200">
              <li class="py-3">
                <a href="/admin/advances" class="block text-blue-500 font-semibold hover:underline">
                  Advance
                </a>
                <div class="flex justify-between">
                  <span class="text-gray-500 text-sm">Amount:</span>
                  <span class="text-gray-800">55</span>
                </div>
                <div class="flex justify-between">
                  <span class="text-gray-500 text-sm">Refund:</span>
                  <span class="text-gray-800">55</span>
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

    </x-filament::card>
</x-filament::widget>
