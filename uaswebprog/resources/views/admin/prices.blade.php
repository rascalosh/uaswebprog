<?php
    use App\Models\TipeKamar;
?>
<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Room Prices') }}
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    
        <x-validation-errors class="mb-4" />

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form id="updatePriceForm" method="POST" action="{{ route('admin.update_prices') }}">
                @csrf

                @php
                    $price_dalam = TipeKamar::find(1)->harga;
                    $price_luar = TipeKamar::find(0)->harga;
                @endphp

                <div>
                    <x-label for="price" value="{{ __('Price') }}" />
                    <x-input id="price" class="block mt-1 w-full" type="number" step="100000" name="price" value="{{ $price_dalam }}"
                        required autofocus autocomplete="price" />
                </div>

                <div class="flex items-center mb-4 mt-4">
                    <input onclick="updatePrice({{ $price_dalam }})" checked id="default-radio-1" type="radio" value="dalam" name="tipe_kamar" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kamar Mandi Dalam</label>
                </div>
                <div class="flex items-center">
                    <input onclick="updatePrice({{ $price_luar }})" id="default-radio-2" type="radio" value="luar" name="tipe_kamar" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Kamar Mandi Luar</label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="button" onclick="openConfirmModal()" class="ms-4 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                        {{ __('Update Price') }}
                    </button>
                </div>
            </form>

            <div id="confirmModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                    <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                        <div class="px-4 py-3">
                            <h2 class="text-lg font-semibold">Confirmation</h2>
                            <p>Are you sure you want update this room's price?</p>
                                <div class="flex justify-end mt-4">
                                    <button type="button" onclick="closeConfirmModal()" class="text-gray-500 hover:text-gray-800">Cancel</button>
                                    <button type="button" onclick="confirmUpdate(); disableSubmitButton(this);" class="ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

<script>
    function updatePrice(price) {
        document.getElementById('price').value = price;
    }

    function openConfirmModal() {
        // Show the confirmation modal
        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function closeConfirmModal() {
        // Hide the confirmation modal
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function confirmUpdate() {
        // Submit the form programmatically
        document.getElementById('updatePriceForm').submit();
    }

    function disableSubmitButton(button) {
        button.disabled = true;
        button.innerText = "Processing...";
        button.classList.add("opacity-50", "cursor-not-allowed");
    }

</script>