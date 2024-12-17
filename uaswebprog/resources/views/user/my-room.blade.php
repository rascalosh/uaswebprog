<?php

use Carbon\Carbon;
use App\Models\Pelaporan;
use App\Models\Guest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

if($roomGender == "P"){
    $randomFile = $imagesPerempuan[array_rand($imagesPerempuan)];
    $randomAsset = 'images/KamarPerempuan/' . $randomFile->getFilename();
}
else{
    $randomFile = $imagesPria[array_rand($imagesPria)];
    $randomAsset = 'images/KamarPria/' . $randomFile->getFilename();
}

$user = Auth::user();
$gender = $user->gender;

Guest::where('end_date', '<', Carbon::now()->subDays(7))
    ->delete();

Pelaporan::onlyTrashed()
    ->where('deleted_at', '<', Carbon::now()->subDays(7))
    ->forceDelete();

?>

<x-app-layout>
    @if ($room)
    <x-slot name="header">
            <h2 class="font-semibold text-2xl text-gray-900 dark:text-gray-200 leading-tight">
                {{ $room->nomor_kamar }} ({{ $roomGender == 'P' ? "Perempuan" : "Laki-Laki" }}) - {{ $user->full_name }}
            </h2>
        </x-slot>

        <!-- Room Information Section -->
        <div class=" ms-5 mb-5 flex gap-8">
            <!-- Room Image -->
            <div class="mt-5 w-1/3">
                <img src="{{ asset($randomAsset) }}" alt="Room Image" class="w-full h-auto rounded-lg shadow-md">
            </div>

            <!-- Personal Information -->
            <div class="w-2/3 p-4 bg-gray-100 rounded-lg shadow-md">
                <h4 class="font-semibold text-lg">Personal Information</h4>
                <div class="mt-2 space-y-3">
                    <div class="flex justify-between">
                        <p class="text-m text-gray-700 w-1/3 font-medium"><strong>Name:</strong></p>
                        <p class="text-m text-gray-700 w-2/3">{{ $user->name }}</p>
                    </div>

                    <div class="flex justify-between">
                        <p class="text-m text-gray-700 w-1/3 font-medium"><strong>Gender:</strong></p>
                        <p class="text-m text-gray-700 w-2/3">{{ $user->gender == "P" ? "Perempuan" : "Laki-Laki" }}</p>
                    </div>

                    <div class="flex justify-between">
                        <p class="text-m text-gray-700 w-1/3 font-medium"><strong>Phone:</strong></p>
                        <p class="text-m text-gray-700 w-2/3">{{ $user->no_telp }}</p>
                    </div>

                    <div class="flex justify-between">
                        <p class="text-m text-gray-700 w-1/3 font-medium"><strong>Date of Entry:</strong></p>
                        <p class="text-m text-gray-700 w-2/3">{{ Carbon::parse($user->tanggal_masuk)->format('F j, Y') }}</p>
                    </div>
                </div>

                <!-- Payment Due -->
                <h4 class="text-gray-700 text-s mt-8 border-b-2 border-yellow-500 pb-2">Next Payment Due</h4>
                <p class="text-red-600 font-semibold text-xl bg-yellow-100 rounded-md p-2 shadow-lg">
                    {{ Carbon::parse($user->deadline_bayar)->format('F j, Y') }}
                </p>
            </div>
        </div>

        <!-- Action Buttons Section -->
        <div class="mt-5 flex justify-center flex-wrap gap-4 ms-5">
            <!-- Report a Problem Button -->
                <x-button onclick="openReportModal()" class="mt-5 ml-3 py-3 px-8 text-center text-yellow-600 font-semibold border-2 border-yellow-600 bg-transparent rounded-lg transition-all duration-300 ease-in-out transform hover:bg-yellow-600 hover:text-white hover:border-yellow-600 hover:scale-105">
                    Report a Problem
                </x-button>

            <!-- Notify Guest Button -->
                <x-button onclick="openGuestFormModal()" class="mt-5 ml-3 py-3 px-8 text-center text-yellow-600 font-semibold border-2 border-yellow-600 bg-transparent rounded-lg transition-all duration-300 ease-in-out transform hover:bg-yellow-600 hover:text-white hover:border-yellow-600 hover:scale-105">
                    Notify Guest
                </x-button>
        </div>
        

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
                                @endif

                                <div class="flex justify-between">
                                    @if($report->proof)
                                        <button onclick="openProofModal('{{ asset('storage/' . $report->proof) }}')" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Proof</button>
                                    @endif

                                    @if($report->deleted_at)
                                        <form id="deleteReportForm-{{ $report->id_pelaporan }}" action="{{ route('report.destroy', $report->id_pelaporan) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="openConfirmReportModal('{{ $report->id_pelaporan }}'); disableSubmitButton(this);" type="button" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
                                        </form>
                                    @endif
                                </div>  
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
                                <form id="deleteGuestForm-{{ $guest->id_guest }}" action="{{ route('guest.destroy', $guest->id_guest) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="openConfirmGuestModal('{{ $guest->id_guest }}'); disableSubmitButton(this);" type="button" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Selesai
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
                    <form method="POST" action="{{ route('create-report') }}" enctype="multipart/form-data" onsubmit="disableFormSubmitButton()">
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

                        <!-- Proof -->
                        <div class="mt-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Proof (Optional)</label>
                            <input name="proof" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG (MAX. 2048 KB).</p>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-6 flex justify-end">
                            <button type="button" onclick="closeReportModal()" class="text-gray-500 hover:text-gray-800 mr-3">Cancel</button>
                            <button type="submit" class="submit-button bg-yellow-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-yellow-700">Submit</button>
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
                    <form method="POST" action="{{ route('create-guest') }}" onsubmit="disableFormSubmitButton()">
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
                            <button type="submit" class="submit-button bg-yellow-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-yellow-700">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="proofModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-4 py-3">
                    <h2 class="text-lg font-semibold">Proof Image</h2>
                    <img id="proofImage" src="" alt="Proof Image" />
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="closeProofModal()" class="ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmReportModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-4 py-3">
                    <h2 class="text-lg font-semibold">Confirmation</h2>
                    <p>Are you sure you want to delete this resolved report?</p>
                        <div class="flex justify-end mt-4">
                            <button type="button" onclick="closeConfirmReportModal()" class="text-gray-500 hover:text-gray-800">Cancel</button>
                            <button type="button" onclick="confirmDeleteReport(); disableSubmitButton(this);" class="ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmGuestModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-4 py-3">
                    <h2 class="text-lg font-semibold">Confirmation</h2>
                    <p>Are you sure the guest has finished visiting?</p>
                        <div class="flex justify-end mt-4">
                            <button type="button" onclick="closeConfirmGuestModal()" class="text-gray-500 hover:text-gray-800">Cancel</button>
                            <button type="button" onclick="confirmDeleteGuest(); disableSubmitButton(this);" class="ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Yes</button>
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

    function openProofModal(imageSrc) {
        const modal = document.getElementById('proofModal');
        const image = document.getElementById('proofImage');
        image.src = imageSrc;
        modal.classList.remove('hidden');
    }

    function closeProofModal() {
        const modal = document.getElementById('proofModal');
        modal.classList.add('hidden');
    }

    let currentReportFormId = null;

    function openConfirmReportModal(reportId) {

        currentReportFormId = `deleteReportForm-${reportId}`;
        document.getElementById('confirmReportModal').classList.remove('hidden');
    }

    function closeConfirmReportModal() {
        document.getElementById('confirmReportModal').classList.add('hidden');
    }

    function confirmDeleteReport() {
        if (currentReportFormId) {
            document.getElementById(currentReportFormId).submit();
        }
    }

    let currentGuestFormId = null;

    function openConfirmGuestModal(guestId) {

        currentGuestFormId = `deleteGuestForm-${guestId}`;
        document.getElementById('confirmGuestModal').classList.remove('hidden');
    }

    function closeConfirmGuestModal() {
        document.getElementById('confirmGuestModal').classList.add('hidden');
    }

    function confirmDeleteGuest() {
        if (currentGuestFormId) {
            document.getElementById(currentGuestFormId).submit();
        }
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
