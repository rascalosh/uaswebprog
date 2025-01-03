<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Payments') }}
        </h2>
    </x-slot>

    <x-validation-errors class="my-5 text-center" />

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Male Occupants</h3>
                <div class="grid grid-flow-col auto-cols-max gap-10 overflow-x-auto">
                    @foreach ($maleOccupants as $kamar)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $kamar->user->full_name }}
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">Nomor HP: {{ $kamar->user->no_telp }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $kamar->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Payment Due At: {{ Carbon\Carbon::parse($kamar->user->deadline_bayar)->format('F j, Y') }}</p>
                            <button onclick="openPaymentModal({{ $kamar->user->id_user }})" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Prolong Ownership</button>
                            <button onclick="openRevokeModal({{ $kamar->user->id_user }})" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Revoke Ownership</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Female Occupants</h3>
                <div class="grid grid-flow-col auto-cols-max gap-10 overflow-x-auto">
                    @foreach ($femaleOccupants as $kamar)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $kamar->user->full_name }}
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">Nomor HP: {{ $kamar->user->no_telp }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $kamar->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Payment Due At: {{ Carbon\Carbon::parse($kamar->user->deadline_bayar)->format('F j, Y') }}</p>
                            <button onclick="openPaymentModal({{ $kamar->user->id_user }})" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Prolong Ownership</button>
                            <button onclick="openRevokeModal({{ $kamar->user->id_user }})" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Revoke Ownership</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div id="paymentModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-6 py-4">
                    <h2 class="text-lg font-semibold">Prolong Kos Ownership</h2>
                    <form method="POST" action="{{ route('admin.update_payment') }}" onsubmit="disableFormSubmitButton()">
                        @csrf
                        <!-- Date -->
                        <div class="mt-4">
                            <label for="duration" class="block text-sm font-medium text-gray-700">Duration</label>
                            <select id="duration" name="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option selected value="1">1 bulan</option>
                                <option value="2">2 bulan</option>
                                <option value="3">3 bulan</option>
                                <option value="4">4 bulan</option>
                                <option value="5">5 bulan</option>
                                <option value="6">6 bulan</option>
                                <option value="7">7 bulan</option>
                                <option value="8">8 bulan</option>
                                <option value="9">9 bulan</option>
                                <option value="10">10 bulan</option>
                                <option value="11">11 bulan</option>
                                <option value="12">12 bulan</option>
                            </select>
                        </div>

                        <x-input type="hidden" name="id_user" value="" />

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end">
                            <button type="button" onclick="closePaymentModal()" class="text-gray-500 hover:text-gray-800 mr-3">Cancel</button>
                            <button type="submit" class="submit-button bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="revokeModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-4 py-3">
                    <h2 class="text-lg font-semibold">Confirm Cancellation</h2>
                    <p>Are you sure you want to revoke this person's kos ownership?</p>
                    <form method="post" action="{{ route('admin.revoke_ownership') }}" onsubmit="disableFormSubmitButton()">
                        @csrf

                        <x-input type="hidden" name="id_user" value="" />

                        <div class="flex justify-end mt-4">
                            <button type="button" onclick="closeRevokeModal()" class="text-gray-500 hover:text-gray-800">Cancel</button>
                            <button type="submit" name="cancel" class="submit-button ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

<script>

    function openPaymentModal(userId) {
        const modal = document.getElementById('paymentModal');
        const userInput = modal.querySelector('input[name="id_user"]');
        userInput.value = userId;
        modal.classList.remove('hidden');
    }

    function closePaymentModal() {
        const modal = document.getElementById('paymentModal');
        modal.classList.add('hidden');
    }

    function openRevokeModal(userId) {
        const modal = document.getElementById('revokeModal');
        const userInput = modal.querySelector('input[name="id_user"]');
        userInput.value = userId;
        modal.classList.remove('hidden');
    }

    function closeRevokeModal() {
        const modal = document.getElementById('revokeModal');
        modal.classList.add('hidden');
    }

    function disableSubmitButton(button) {
        button.disabled = true;
        button.innerText = "Processing...";
        button.classList.add("opacity-50", "cursor-not-allowed");
    }

    function disableFormSubmitButton() {
        const buttons = document.querySelectorAll('.submit-button'); // Select all buttons with the class
        buttons.forEach(button => {
            button.disabled = true;
            button.innerText = "Processing...";
            button.classList.add("opacity-50", "cursor-not-allowed");
        });
    }

</script>