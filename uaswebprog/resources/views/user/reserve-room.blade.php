<?php

use Illuminate\Support\Facades\File;
$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

?>

<x-app-layout>

    <div>
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl w-full">
                <x-female-room />
            </div>
        </div>
    </div>


<!-- Room List -->
<div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Room Card -->
    @foreach (['READY', 'TANYA PEMILIK', 'TANYA PEMILIK'] as $status)
        <div class="border border-gray-200 rounded-lg shadow-lg flex flex-col p-4 bg-white">
            <!-- Room Image -->
            <div class="w-full bg-gray-300 rounded-lg h-32 mb-4 flex items-center justify-center">
                <span class="text-gray-500">Image Placeholder</span>
            </div>
            <!-- Room Details -->
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Standard Female Room</h3>
                <!-- Grid for Details -->
                <div class="grid grid-cols-2 gap-y-4 gap-x-2 text-sm text-gray-600 mb-4">
                    <!-- AC -->
                    <div class="flex items-center">
                        <ion-icon name="snow-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>
                        <span>AC</span>
                    </div>
                    <!-- WiFi -->
                    <div class="flex items-center">
                        <ion-icon name="wifi-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>
                        <span>WiFi</span>
                    </div>
                    <!-- Meja -->
                    <div class="flex items-center">
                        <ion-icon name="desktop-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>
                        <span>Meja</span>
                    </div>
                    <!-- Kasur -->
                    <div class="flex items-center">
                        <ion-icon name="bed-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>
                        <span>Kasur</span>
                    </div>
                    <!-- Lemari Baju -->
                    <div class="flex items-center">
                        <ion-icon name="cube-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>
                        <span>Lemari Baju</span>
                    </div>
                </div>
                <p class="text-sm text-gray-500">Lantai: 2nd Floor</p>
            </div>
            <!-- Room Status -->
            <div class="mt-4">
                <p class="text-lg font-bold text-gray-700 mb-2">RpX.XXX.XXX</p>
                <a href="/dashboard" class="text-sm px-3 py-1 rounded-full inline-block {{ $status === 'READY' ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                    {{ $status }}
                </a>
            </div>
        </div>
    @endforeach
</div>



        </div>
    </div>
</x-app-layout>


<!-- 
<x-app-layout>

    @php
        $user = Auth::user();
        $email = $user->email;

        $gender = $user->gender;

        if($gender == 'P') $table = 'kamar_perempuan';
        else $table = 'kamar_pria';

        $rooms = DB::table($table)->select('nomor_kamar', 'email')->get();
    @endphp

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reserve A Room!!!') }}
        </h2>
    </x-slot>

    
    
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('create-reservation') }}">
                @csrf
                <label for="room" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                <select name="room" id="room" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a room</option>
                    @foreach($rooms as $room)
                        @if($room->email)
                            <option value="{{ $room->nomor_kamar }}" disabled>
                                {{ $room->nomor_kamar }} (Occupied)
                            </option>
                        @else
                            <option value="{{ $room->nomor_kamar }}">
                                {{ $room->nomor_kamar }}
                            </option>
                        @endif
                    @endforeach
                </select>

                <x-input id="user_email" type="hidden" name="user_email" value="{{$email}}" />

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ms-4">
                        {{ __('Reserve Room') }}
                    </x-button>
                </div>
            </form>
            
        </div>
    </div>


</x-app-layout> -->
