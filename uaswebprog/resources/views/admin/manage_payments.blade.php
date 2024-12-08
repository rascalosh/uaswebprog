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
                    @foreach ($maleOccupants as $user)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $user->full_name }}
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $user->maleRoom->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Payment Due At: {{ Carbon\Carbon::parse($user->deadline_bayar)->format('F j, Y') }}</p>
                            <button onclick="openPaymentModal({{ $user->id_user }})" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Prolong Ownership</button>
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
                    @foreach ($femaleOccupants as $user)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $user->full_name }}
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $user->femaleRoom->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Payment Due At: {{ Carbon\Carbon::parse($user->deadline_bayar)->format('F j, Y') }}</p>
                            <button onclick="openPaymentModal({{ $user->id_user }})" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Prolong Ownership</button>
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
                    <form method="POST" action="{{ route('admin.update_payment') }}">
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
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700">Submit</button>
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

</script>