<?php

use Illuminate\Support\Facades\File;

$fasilitas = [
    ['name' => 'AC', 'icon' => 'snow-outline', 'image' => 'ac.jpg', 'description' => 'Pendingin ruangan untuk kenyamanan Anda.', 'category' => 'dalam'],
    ['name' => 'Kasur', 'icon' => 'bed-outline', 'image' => 'kasur.jpg', 'description' => 'Kasur empuk untuk istirahat berkualitas.', 'category' => 'dalam'],
    ['name' => 'TV', 'icon' => 'tv-outline', 'image' => 'tv.jpg', 'description' => 'Hiburan dengan TV modern.', 'category' => 'dalam'],
    ['name' => 'WiFi', 'icon' => 'wifi-outline', 'image' => 'wifi.jpg', 'description' => 'Koneksi internet cepat dan stabil.', 'category' => 'dalam'],
    ['name' => 'Meja', 'icon' => 'desktop-outline', 'image' => 'meja.jpg', 'description' => 'Meja belajar yang nyaman.', 'category' => 'dalam'],
    ['name' => 'Lemari', 'icon' => 'cube-outline', 'image' => 'lemari.jpg', 'description' => 'Lemari pakaian yang luas.', 'category' => 'dalam'],
    ['name' => 'Dapur', 'icon' => 'restaurant-outline', 'image' => 'Dapur.jpg', 'description' => 'Dapur bersih untuk memasak.', 'category' => 'dalam'],
    ['name' => 'Keamanan', 'icon' => 'shield-checkmark-outline', 'image' => 'keamanan.jpg', 'description' => 'Sistem keamanan 24 jam.', 'category' => 'luar'],
    ['name' => 'Pembersih', 'icon' => 'broom-outline', 'image' => 'Kebersihan.jpg', 'description' => 'Layanan kebersihan teratur.', 'category' => 'dalam'],
    ['name' => 'Parkiran', 'icon' => 'car-outline', 'image' => 'Parkiran.jpg', 'description' => 'Parkir luas untuk kendaraan Anda.', 'category' => 'luar'],
    ['name' => 'Kolam Renang', 'icon' => 'water-outline', 'image' => 'kolam.jpg', 'description' => 'Kolam renang untuk relaksasi.', 'category' => 'luar'],
    ['name' => 'Water Heater', 'icon' => 'thermometer-outline', 'image' => 'WaterHeater.jpg', 'description' => 'Pemanas air untuk mandi nyaman.', 'category' => 'dalam'],
    ['name' => 'Cuci Baju', 'icon' => 'shirt-outline', 'image' => 'Laundry.jpg', 'description' => 'Layanan cuci pakaian.', 'category' => 'dalam'],
    ['name' => 'Lapangan', 'icon' => 'basketball-outline', 'image' => 'lapangan.jpg', 'description' => 'Lapangan untuk olahraga.', 'category' => 'luar'],
    ['name' => 'Toilet Luar', 'icon' => 'cube-outline', 'image' => 'KamarMandi.jpg', 'description' => 'Toilet luar yang bersih.', 'category' => 'dalam'],
];

?>
<x-app-layout>
    
    @if(request()->routeIs('fasilitas'))
        <div class="relative">
            <img src="{{ asset('images/Fasilitas/Fasilitas.png') }}" alt="Fasilitas Kami" class="w-full h-48 object-cover">
            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <h2 class="text-white text-3xl font-bold">Fasilitas Kami</h2>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white p-6">Fasilitas Kami</h1>

                <!-- Dalam -->
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white p-6">Fasilitas Dalam</h2>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($fasilitas as $fasilitasItem)
                        @if ($fasilitasItem['category'] === 'dalam')
                            <div class="border border-gray-200 rounded-lg shadow-lg flex flex-col p-4 bg-white dark:bg-gray-900" data-aos="fade-up">
                                <div class="w-full mb-4">
                                    <img src="{{ asset('images/Fasilitas/FasilitasDalam/' . $fasilitasItem['image']) }}" alt="{{ $fasilitasItem['name'] }}" class="rounded-lg object-cover w-full h-40">
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 text-center mb-2">{{ $fasilitasItem['name'] }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-2">
                                    {{ $fasilitasItem['description'] }}
                                </p>
                                <div class="w-full flex justify-center">
                                    <ion-icon name="{{ $fasilitasItem['icon'] }}" class="w-12 h-12 text-gray-700 dark:text-gray-300"></ion-icon>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <hr class="my-12 border-t-2 border-gray-300 dark:border-gray-600">

                <!-- Luar -->
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white p-6">Fasilitas Luar</h2>
                <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($fasilitas as $fasilitasItem)
                        @if ($fasilitasItem['category'] === 'luar')
                            <div class="border border-gray-200 rounded-lg shadow-lg flex flex-col p-4 bg-white dark:bg-gray-900" data-aos="fade-up">
                                <div class="w-full mb-4">
                                    <img src="{{ asset('images/Fasilitas/FasilitasLuar/' . $fasilitasItem['image']) }}" alt="{{ $fasilitasItem['name'] }}" class="rounded-lg object-cover w-full h-40">
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 text-center mb-2">{{ $fasilitasItem['name'] }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-2">
                                    {{ $fasilitasItem['description'] }}
                                </p>
                                <div class="w-full flex justify-center">
                                    <ion-icon name="{{ $fasilitasItem['icon'] }}" class="w-12 h-12 text-gray-700 dark:text-gray-300"></ion-icon>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
