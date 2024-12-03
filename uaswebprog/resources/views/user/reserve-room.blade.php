<?php

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

// Image directories for each gender.
$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

$women = DB::table('kamar_perempuan')->get();
$men = DB::table('kamar_pria')->get();

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
                        <a href="{{ route('view_rooms', ['id' => $room->nomor_kamar, 'gender' => 'P']) }}" class="text-sm px-3 py-1 rounded-full inline-block 
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
                            $price = 'Rp. 1.500.000,00';
                            $name = "Standard Male Room";
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
                        <a href="{{ route('view_rooms', ['id' => $room->nomor_kamar, 'gender' => 'L']) }}" class="text-sm px-3 py-1 rounded-full inline-block 
                                {{ $room->email ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                            {{ $status }}
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
