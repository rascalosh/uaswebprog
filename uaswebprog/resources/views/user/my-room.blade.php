<?php

use Carbon\Carbon;
use App\Models\Pelaporan;

?>

<x-app-layout>
    @php
        $user = Auth::user();
        $gender = $user->gender;

        DB::table('guests')
            ->where('end_date', '<', Carbon::now()->subDays(7))
            ->delete();

        Pelaporan::onlyTrashed()
            ->where('deleted_at', '<', Carbon::now()->subDays(7))
            ->forceDelete();
    @endphp

    @if ($room)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $room->nomor_kamar }} - {{ $user->full_name }}
            </h2>
        </x-slot>

        <!-- Room Information Section -->
        <div class="mt-5 ms-5 mb-5 flex gap-8">
            <!-- Room Image -->
            <div class="w-1/3">
                <img src="https://via.placeholder.com/600x400/gray/FFFFFF/?text=Room+Image" alt="Room Image" class="w-full h-auto rounded-lg shadow-md">
            </div>

            <!-- Personal Information -->
            <div class="w-2/3 mt-5 p-4 bg-gray-100 rounded-lg shadow-md">
                <h4 class="font-semibold text-lg">Personal Information</h4>
                <p>Name: {{ $user->name }}</p>
                <p>Gender: {{ $user->gender == "P" ? "Perempuan" : "Laki-Laki" }}</p>
                <p>Phone: {{ $user->no_telp }}</p>
                <p>Date of Entry: {{ Carbon::parse($user->tanggal_masuk)->format('F j, Y') }}</p>


                <!-- Payment Due -->
                <h4 class="font-semibold text-lg mt-2">Payment Due</h4>
                <p class="text-red-600 font-medium">{{ Carbon::parse($user->deadline_bayar)->format('F j, Y') }}</p>
            </div>
        </div>

 <!-- Action Buttons Section -->
        <div class="mt-5 flex justify-center flex-wrap gap-4 ms-5">
            <!-- Report a Problem Button -->
                <x-button onclick="openReportModal()" class="block py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                    Report a Problem
                </x-button>

            <!-- Notify Guest Button -->
                <x-button onclick="openGuestFormModal()" class="block py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                    Notify Guest
                </x-button>
        </div>

        <!-- Review Form Section -->
        <form method="POST" action="{{ route('submit-review') }}" class="mt-5 ms-5 mb-5 flex justify-center">
            @csrf
            <x-label for="review" value="{{ __('Rate the Room') }}" class="mx-3 mt-4"/>
            <div class="star-rating">
                <input type="radio" id="star1" name="review" value="1" /><label for="star1" title="1 star"><i class="fas fa-star"></i></label>
                <input type="radio" id="star2" name="review" value="2" /><label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star3" name="review" value="3" /><label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star4" name="review" value="4" /><label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star5" name="review" value="5" /><label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
            </div>
            <x-button class="mt-3 ml-3 py-1 px-4 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                {{ __('Submit Rating') }}
            </x-button>
        </form>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Reports</h3>
                    <div class="grid grid-flow-col auto-cols-max gap-10 overflow-x-auto">
                        @foreach ($reports as $report)
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $report->full_name }}</h4>
                                <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $report->nomor_kamar }}</p>
                                <p class="text-gray-600 dark:text-gray-400">Jenis Kos: {{ $report->gender_kamar }}</p>
                                <p class="text-gray-600 dark:text-gray-400">Reported At: {{ Carbon::parse($report->tanggal)->format('F j, Y') }}</p>
                                <p class="text-gray-600 dark:text-gray-400">Decription: {{ $report->desc_pelaporan }}</p>

                                @if($report->deleted_at)
                                    <p class="text-red-600 font-medium">Report has been resolved</p>
                                    <form action="{{ route('report.destroy', $report->id_pelaporan) }}" method="POST"
                                        onsubmit="return confirm('Apakah anda yakin ingin menghapus report ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Delete</button>
                                    </form>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Tamu berkunjung</h3>
                    <div class="grid grid-flow-col auto-cols-max gap-10 overflow-x-auto">
                        @foreach ($guests as $guest)
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                                <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $guest->guest_name }}
                                </h4>
                                <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $guest->nomor_kamar }}</p>
                                <p class="text-gray-600 dark:text-gray-400">Jenis Kos: {{ $guest->gender }}</p>
                                <p class="text-gray-600 dark:text-gray-400">Relation: {{ $guest->relation }}</p>
                                <p class="text-gray-600 dark:text-gray-400">Check In: {{ Carbon::parse($guest->visit_date)->format('F j, Y') }}</p>
                                <p class="text-gray-600 dark:text-gray-400">Check Out: {{ Carbon::parse($guest->end_date)->format('F j, Y') }}</p>
                                <p class="text-gray-600 dark:text-gray-400">Jumlah Pengunjung: {{ $guest->guest_amount }}</p>
                                <form action="{{ route('admin.guests.destroy', $guest->id_guest) }}" method="POST"
                                    onsubmit="return confirm('Apakah anda yakin ingin menghapus tamu ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Selesai
                                        Berkunjung</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="flex flex-col min-h-screen">
            <!-- Main Content -->
            <div class="flex-grow">
                <p class="mt-5 ms-5 text-gray-600">No room found. Please contact support.</p>
            </div>
        </div>
    @endif

    <x-footer />

    <!-- Modal for Report -->
    <div id="reportModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-6 py-4">
                    <h2 class="text-lg font-semibold">Report a Problem</h2>
                    <form method="POST" action="{{ route('create-report') }}">
                        @csrf
                        <!-- Jenis Kos -->
                        <div class="mt-4">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kos</label>
                            <select id="gender" name="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="L" {{ $gender == 'L' ? 'selected' : '' }}>Pria</option>
                                <option value="P" {{ $gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Choose a Room -->
                        <div class="mt-4">
                            <label for="room" class="block text-sm font-medium text-gray-700">Choose a Room</label>
                            <select id="room" name="room" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @if ($room)
                                    <option value="{{ $room->nomor_kamar }}" selected>{{ $room->nomor_kamar }}</option>
                                @else
                                    <option disabled selected>No room available</option>
                                @endif
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="mt-4">
                            <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                            <input id="date" name="date" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ now()->toDateString() }}">
                        </div>

                        <!-- Description -->
                        <div class="mt-4">
                            <label for="desc_pelaporan" class="block text-sm font-medium text-gray-700">Issue(s)</label>
                            <textarea id="desc_pelaporan" name="desc_pelaporan" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end">
                            <button type="button" onclick="closeReportModal()" class="text-gray-500 hover:text-gray-800 mr-3">Cancel</button>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Guest Form -->
    <div id="guestFormModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-6 py-4">
                    <h2 class="text-lg font-semibold">Add Guest</h2>
                    <form method="POST" action="{{ route('create-guest') }}">
                        @csrf

                        <!-- Guest Name -->
                        <div class="mt-4">
                            <label for="guest_name" class="block text-sm font-medium text-gray-700">Guest Name</label>
                            <input id="guest_name" name="guest_name" type="text" required autofocus autocomplete="guest_name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Room Selection -->
                        <div class="mt-4">
                            <label for="room" class="block text-sm font-medium text-gray-700">Room</label>
                            <select id="room" name="room" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @if ($room)
                                    <option value="{{ $room->nomor_kamar }}" selected>{{ $room->nomor_kamar }}</option>
                                @else
                                    <option disabled selected>No room available</option>
                                @endif
                            </select>
                        </div>

                        <!-- Gender -->
                        <div class="mt-4">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kos</label>
                            <select id="gender" name="gender" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="L" {{ $gender == 'L' ? 'selected' : '' }}>Male</option>
                                <option value="P" {{ $gender == 'P' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>

                        <!-- Date and Amount -->
                        <div class="flex justify-between">
                            <div class="mt-4">
                                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                                <input id="date" name="date" type="date" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>

                            <div class="mt-4">
                                <label for="duration" class="block text-sm font-medium text-gray-700">Duration (days)</label>
                                <input id="duration" name="duration" type="number" min="1" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>

                        <div class="mt-4">
                            <label for="amount" class="block text-sm font-medium text-gray-700"># of People</label>
                            <input id="amount" name="amount" type="number" min="0" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Relation -->
                        <div class="mt-4">
                            <label for="relation" class="block text-sm font-medium text-gray-700">Relation</label>
                            <input id="relation" name="relation" type="text" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end">
                            <button type="button" onclick="closeGuestFormModal()" class="text-gray-500 hover:text-gray-800 mr-3">Cancel</button>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



<script>
    function closeModal() {
        const modal = document.getElementById('cancelModal');
        modal.classList.add('hidden');
    }

    function confirmDelete() {
        const modal = document.getElementById('cancelModal');
        modal.classList.remove('hidden');
    }

    function openReportModal() {
        const modal = document.getElementById('reportModal');
        modal.classList.remove('hidden');
    }

    function closeReportModal() {
        const modal = document.getElementById('reportModal');
        modal.classList.add('hidden');
    }

    function openGuestFormModal() {
        document.getElementById('guestFormModal').classList.remove('hidden');
    }

    function closeGuestFormModal() {
        document.getElementById('guestFormModal').classList.add('hidden');
    }

</script>

<style>
    .star-rating {
        display: inline-block;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 2em;
        color: #ddd;
        cursor: pointer;
    }

    .star-rating input[type="radio"]:checked ~ label i {
        color: #f5b301;
    }

    .star-rating label:hover i,
    .star-rating label:hover ~ label i {
        color: #f5b301;
    }

    .fixed {
        position: fixed;
    }

</style>
