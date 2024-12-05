<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Payments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Male Occupants</h3>
                <div class="grid grid-flow-col auto-cols-max gap-10 overflow-x-auto">
                    @foreach ($maleOccupants as $male)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $male->full_name }}
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $male->maleRoom->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Payment Due At: {{ Carbon\Carbon::parse($male->deadline_bayar)->format('F j, Y') }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $male->maleRoom->nomor_kamar }}</p>
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
                    @foreach ($femaleOccupants as $female)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $female->full_name }}
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $female->femaleRoom->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Payment Due At: {{ Carbon\Carbon::parse($female->deadline_bayar)->format('F j, Y') }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
