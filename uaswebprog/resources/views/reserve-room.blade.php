<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

$user = Auth::user();

// Image directories for each gender.
$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

$women = DB::table('kamar_perempuan')->get();
$men = DB::table('kamar_pria')->get();
$is_reserving = FALSE;
$has_room = FALSE;
if($user){
    $is_reserving = $user->is_reserving;
    $has_room = $user->has_room;
}
?>

<x-dynamic-component :component="Auth::check() ? 'app-layout' : 'welcome-layout'">

    <!-- If User is Reserving -->
    @if($is_reserving)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Pending Reservation</h3>           
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $user->full_name }}
                        </h4>
                        <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $user->reservation->nomor_kamar }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Jenis Kos: {{ $user->reservation->gender == 'P' ? "Perempuan" : "Laki-Laki" }}</p>
                        <p class="text-gray-600 dark:text-gray-400">Start Date: {{ Carbon\Carbon::parse($user->reservation->start_date)->format('F j, Y') }}</p>

                        <div class="flex justify-start space-x-6">

                            <div class="block">
                                <button onclick="confirmDelete()" class="w-full py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-green-50 hover:text-green-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                                    Cancel
                                </button>
                            </div>

                            <a href="#" class="block py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                                Tanya Pemilik
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="cancelModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                    <div class="px-4 py-3">
                        <h2 class="text-lg font-semibold">Confirm Cancellation</h2>
                        <p>Are you sure you want to cancel your reservation?</p>
                        <form method="post" action="{{ route('cancel_reservation') }}">
                            @csrf
                            <div class="flex justify-end mt-4">
                                <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-800">Cancel</button>
                                <button type="submit" name="cancel" class="ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    <!-- If User Has Room -->
    @elseif($has_room)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">You Already Have a Room</h3>           
                    <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $user->full_name }}</h4>
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Check Out Your Room!</h4>

                        <div class="flex justify-start space-x-6">
                            <a href="{{ route('my_room') }}" class="block py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                                My Room
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    @else
    <div>
        <!-- Welcome Section -->
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl w-full">
                <x-welcome-banner />
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="flex justify-center items-center gap-5 my-8 mx-5">
            <!-- Button for Women's Room -->
            <button onclick="showContent('woman')" class="hover:opacity-80 focus:outline-none rounded-lg overflow-hidden" data-aos="flip-left" data-aos-offset="300">
                <div class="relative">
                    <x-female-room />
                </div>
            </button>

            <!-- Button for Men's Room -->
            <button onclick="showContent('man')" class="hover:opacity-80 focus:outline-none rounded-lg overflow-hidden" data-aos="flip-right" data-aos-offset="300">
                <div class="relative">
                    <x-male-room />
                </div>
            </button>
        </div>

        <!-- Dynamic Content Section -->
        <div id="content-woman" class="hidden">
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($women as $room)
                    @php
                        $randomFile = $imagesPerempuan[array_rand($imagesPerempuan)];
                        $randomAsset = 'images/KamarPerempuan/' . $randomFile->getFilename();
                        if($room->tipe_kamar == 1){
                            $features = ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju', 'Kamar Mandi Dalam'];
                            $price = 'Rp. 2.000.000,00';
                            $name = "Premium Female Room";
                        }
                        else{
                            $features = ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'];
                            $price = 'Rp. 1.500.000,00';
                            $name = "Standard Female Room";
                        }
                        if($room->id_user) $status = "TANYA PEMILIK";
                        else $status = "READY";
                    @endphp

                <div class="border border-gray-200 rounded-lg shadow-lg flex flex-col p-4 bg-white" data-aos="fade-up">
                    <!-- Room Image -->
                    <div class="w-full bg-gray-300 rounded-lg h-32 mb-4 flex items-center justify-center">
                        <img src="{{ asset($randomAsset) }}" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <!-- Room Details -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">({{ $room->nomor_kamar }}) {{$name}}</h3>
                        <!-- Grid for Features -->
                        <div class="grid grid-cols-2 gap-y-4 gap-x-2 text-sm text-gray-600 mb-4">
                            @foreach ($features as $feature)
                                <div class="flex items-center">
                                    <ion-icon name="checkmark-circle-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>
                                    <span>{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-sm text-gray-500">Lantai:</p>
                    </div>
                    <!-- Room Status -->
                    <div class="mt-4">
                        <p class="text-lg font-bold text-gray-700 mb-2">{{ $price }}</p>
                        <a href="{{ route('view_rooms', ['id' => $room->nomor_kamar, 'gender' => 'P']) }}" class="text-sm px-3 py-1 rounded-full inline-block 
                                {{ $room->id_user ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                            {{ $status }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div id="content-man" class="hidden">
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($men as $room)
                    @php
                        $randomFile = $imagesPria[array_rand($imagesPria)];
                        $randomAsset = 'images/KamarPria/' . $randomFile->getFilename();
                        if($room->tipe_kamar == 1){
                            $features = ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju', 'Kamar Mandi Dalam'];
                            $price = 'Rp. 2.000.000,00';
                            $name = "Premium Male Room";
                        }
                        else{
                            $features = ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'];
                            $price = 'Rp. 1.700.000,00';
                            $name = "Standard Male Room";
                        }
                        if($room->id_user) $status = "TANYA PEMILIK";
                        else $status = "READY";
                    @endphp

                    <div class="border border-gray-200 rounded-lg shadow-lg flex flex-col p-4 bg-white" data-aos="fade-up">
                        <!-- Room Image -->
                        <div class="w-full bg-gray-300 rounded-lg h-32 mb-4 flex items-center justify-center">
                            <img src="{{ asset($randomAsset) }}" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <!-- Room Details -->
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">({{ $room->nomor_kamar }}) {{$name}}</h3>
                            <!-- Grid for Features -->
                            <div class="grid grid-cols-2 gap-y-4 gap-x-2 text-sm text-gray-600 mb-4">
                                @foreach ($features as $feature)
                                    <div class="flex items-center">
                                        <ion-icon name="checkmark-circle-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-sm text-gray-500">Lantai:</p>
                        </div>
                        <!-- Room Status -->
                        <div class="mt-4">
                            <p class="text-lg font-bold text-gray-700 mb-2">{{ $price }}</p>
                            <a href="{{ route('view_rooms', ['id' => $room->nomor_kamar, 'gender' => 'L']) }}" class="text-sm px-3 py-1 rounded-full inline-block 
                                    {{ $room->id_user ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                {{ $status }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @endif
    <!-- JavaScript for Switching Content -->
    <script>

        function showContent(type) {
            const womanContent = document.getElementById('content-woman');
            const manContent = document.getElementById('content-man');

            // Show or hide content based on the button pressed
            if (type === 'woman') {
                womanContent.classList.remove('hidden');
                manContent.classList.add('hidden');
                setTimeout(() => {
                    AOS.refresh();
                }, 10);
            } else {
                womanContent.classList.add('hidden');
                manContent.classList.remove('hidden');
                setTimeout(() => {
                    AOS.refresh();
                }, 10);
            }
        }

        function closeModal() {
            const modal = document.getElementById('cancelModal');
            modal.classList.add('hidden');
        }

        function confirmDelete() {
            const modal = document.getElementById('cancelModal');
            modal.classList.remove('hidden');
        }
    </script>
</x-dynamic-component>
