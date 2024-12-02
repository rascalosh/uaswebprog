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
                            <a href="{{ route('view_rooms') }}" :active="request()->routeIs('view_rooms')" class="text-sm px-3 py-1 rounded-full inline-block {{ $status === 'READY' ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' }}">
                                {{ $status }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

