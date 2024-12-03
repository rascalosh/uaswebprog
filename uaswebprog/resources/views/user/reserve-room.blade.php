<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

// Image directories for each gender.
$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

$women = DB::table('kamar_perempuan')->get();
$men = DB::table('kamar_pria')->get();

$roomsPerempuan = [
   [
        'id' => 111,
       'name' => '(1A) Premium Female Room',
       'price' => 'Rp2.000.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '1st Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju', 'Kamar Mandi Dalam'],
       'image' => asset('images/KamarPerempuan/bedroom.jpg'), // Example image.
   ],
   [
        'id' => 121, // ID unik untuk ruangan
       'name' => '(1B) Premium Female Room',
       'price' => 'Rp2.000.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '1st Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju', 'Kamar Mandi Dalam'],
       'image' => asset('images/KamarPerempuan/kamar2.jpg'), // Example image.
   ],
   [
        'id' => 211, 
       'name' => '(2A) Standard Female Room',
       'price' => 'Rp1.500.000',
       'status' => 'READY',
       'floor' => '2nd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kasur.jpg'), // Example image.
   ],
   [
        'id' => 221, 
       'name' => '(2B) Standard Female Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '2nd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kasur2.jpg'), // Example image.
   ],
   [
        'id' => 231, 
       'name' => '(2C) Standard Female Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '2nd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kasur3.jpg'), // Example image.
   ],
   [
        'id' => 241, 
       'name' => '(2D) Standard Female Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '2nd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kasur4.jpg'), // Example image.
   ],
   [
        'id' => 311, 
       'name' => '(3A) Standard Female Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '3rd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kamar2.jpg'), // Example image.
   ],
   [
        'id' => 321,
       'name' => '(3B) Standard Female Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '3rd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kamar3.jpg'), // Example image.
   ],
   [
        'id' => 331,
       'name' => '(3C) Standard Female Room',
       'price' => 'Rp1.500.000',
       'status' => 'READY',
       'floor' => '3rd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/bedroom.jpg'), // Example image.
   ],
   [
        'id' => 341,
       'name' => '(3D) Standard Female Room',
       'price' => 'Rp1.500.000',
       'status' => 'READY',
       'floor' => '3rd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/bedroom.jpg'), // Example image.
   ],
];

$roomsPria = [
   [
        'id' => 112,
       'name' => '(1A) Premium Male Room',
       'price' => 'Rp2.000.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '1st Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju', 'Kamar Mandi Dalam'],
       'image' => asset('images/KamarPerempuan/bedroom.jpg'), // Example image.
   ],
   [
        'id' => 122,
       'name' => '(1B) Premium Male Room',
       'price' => 'Rp2.000.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '1st Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju', 'Kamar Mandi Dalam'],
       'image' => asset('images/KamarPerempuan/kamar2.jpg'), // Example image.
   ],
   [
        'id' => 212,
       'name' => '(2A) Standard Male Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '2nd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kasur.jpg'), // Example image.
   ],
   [
        'id' => 222,
       'name' => '(2B) Standard Male Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '2nd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kasur2.jpg'), // Example image.
   ],
   [
        'id' => 232,
       'name' => '(2C) Standard Male Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '2nd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kasur3.jpg'), // Example image.
   ],
   [
        'id' => 242,
       'name' => '(2D) Standard Male Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '2nd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kasur4.jpg'), // Example image.
   ],
   [
        'id' => 312,
       'name' => '(3A) Standard Male Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '3rd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kamar2.jpg'), // Example image.
   ],
   [
        'id' => 322,
       'name' => '(3B) Standard Male Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '3rd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/kamar3.jpg'), // Example image.
   ],
   [
        'id' => 332,
       'name' => '(3C) Standard Male Room',
       'price' => 'Rp1.500.000',
       'status' => 'TANYA PEMILIK',
       'floor' => '3rd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/bedroom.jpg'), // Example image.
   ],
   [
        'id' => 342,
       'name' => '(3D) Standard Male Room',
       'price' => 'Rp1.500.000',
       'status' => 'READY',
       'floor' => '3rd Floor',
       'features' => ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'],
       'image' => asset('images/KamarPerempuan/bedroom.jpg'), // Example image.
   ],
];


?>

<x-app-layout>
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
            <button onclick="showContent('woman')" class="hover:opacity-80 focus:outline-none rounded-lg overflow-hidden">
                <div class="relative">
                    <x-female-room />
                </div>
            </button>

            <!-- Button for Men's Room -->
            <button onclick="showContent('man')" class="hover:opacity-80 focus:outline-none rounded-lg overflow-hidden">
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
                        if($room->email) $status = "TANYA PEMILIK";
                        else $status = "READY";
                    @endphp

                <div class="border border-gray-200 rounded-lg shadow-lg flex flex-col p-4 bg-white">
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
                        <a href="{{ route('view_rooms', ['id' => $room->nomor_kamar, 'gender' => 'F']) }}" class="text-sm px-3 py-1 rounded-full inline-block 
                                {{ $room->email ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                            {{ $status }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div id="content-man" class="hidden">
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($roomsPria as $room)
                <div class="border border-gray-200 rounded-lg shadow-lg flex flex-col p-4 bg-white">
                    <!-- Room Image -->
                    <div class="w-full bg-gray-300 rounded-lg h-32 mb-4 flex items-center justify-center">
                        <img src="{{ $room['image'] }}" alt="{{ $room['name'] }}" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <!-- Room Details -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $room['name'] }}</h3>
                        <!-- Grid for Features -->
                        <div class="grid grid-cols-2 gap-y-4 gap-x-2 text-sm text-gray-600 mb-4">
                            @foreach ($room['features'] as $feature)
                            <div class="flex items-center">
                                <ion-icon name="checkmark-circle-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>
                                <span>{{ $feature }}</span>
                            </div>
                            @endforeach
                        </div>
                        <p class="text-sm text-gray-500">Lantai: {{ $room['floor'] }}</p>
                    </div>
                    <!-- Room Status -->
                    <div class="mt-4">
                        <p class="text-lg font-bold text-gray-700 mb-2">{{ $room['price'] }}</p>
                        <a href="{{ route('view_rooms', ['id' => $room['id']]) }}" 
                           class="text-sm px-3 py-1 rounded-full inline-block 
                           {{ $room['status'] === 'READY' ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                            {{ $room['status'] }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- JavaScript for Switching Content -->
    <script>
        function showContent(type) {
            const womanContent = document.getElementById('content-woman');
            const manContent = document.getElementById('content-man');

            // Show or hide content based on the button pressed
            if (type === 'woman') {
                womanContent.classList.remove('hidden');
                manContent.classList.add('hidden');
            } else {
                womanContent.classList.add('hidden');
                manContent.classList.remove('hidden');
            }
        }

        function showContent(type) {
            const womanContent = document.getElementById('content-woman');
            const manContent = document.getElementById('content-man');

            if (type === 'woman') {
                womanContent.classList.remove('hidden');
                manContent.classList.add('hidden');
            } else {
                womanContent.classList.add('hidden');
                manContent.classList.remove('hidden');
            }
        }
    </script>
</x-app-layout>
