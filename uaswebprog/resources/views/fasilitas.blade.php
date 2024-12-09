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
    ['name' => 'Water Heater', 'icon' => 'thermometer-outline', 'image' => 'Waterhaeter.jpg', 'description' => 'Pemanas air untuk mandi nyaman.', 'category' => 'dalam'],
    ['name' => 'Cuci Baju', 'icon' => 'shirt-outline', 'image' => 'Laundry.jpg', 'description' => 'Layanan cuci pakaian.', 'category' => 'dalam'],
    ['name' => 'Lapangan', 'icon' => 'basketball-outline', 'image' => 'lapangan.jpg', 'description' => 'Lapangan untuk olahraga.', 'category' => 'luar'],
    ['name' => 'Toilet Luar', 'icon' => 'cube-outline', 'image' => 'KamarMandi.jpg', 'description' => 'Toilet luar yang bersih.', 'category' => 'dalam'],
    ['name' => 'Kulkas', 'icon' => 'cube-outline', 'image' => 'kulkas.jpg', 'description' => 'Terdapat kulkas bersama di dapur.', 'category' => 'dalam'],
];

?>
<x-dynamic-component :component="Auth::check() ? 'app-layout' : 'welcome-layout'">

    <div>
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden w-full">
                <x-facilities />
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
    <div class="w-full mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <!-- Filter & View Toggle -->
            <div class="flex justify-between items-center mb-6">
                <input id="searchBar" type="text" placeholder="Cari fasilitas..."
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Fasilitas Dalam -->
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Fasilitas Dalam</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                    @foreach ($fasilitas as $fasilitasItem)
                        @if ($fasilitasItem['category'] === 'dalam')
                            <div class="relative group rounded-lg overflow-hidden shadow-lg fasilitas-item" data-name="{{ strtolower($fasilitasItem['name']) }}">
                                <img src="{{ asset('images/Fasilitas/FasilitasDalam/' . $fasilitasItem['image']) }}" 
                                     alt="{{ $fasilitasItem['name'] }}" 
                                     class="object-cover w-full h-64">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <h3 class="text-lg font-semibold">{{ $fasilitasItem['name'] }}</h3>
                                    <p class="text-sm">{{ $fasilitasItem['description'] }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <hr class="border-t-2 border-gray-300 dark:border-gray-600 mb-12">

            <!-- Fasilitas Luar -->
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Fasilitas Luar</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($fasilitas as $fasilitasItem)
                        @if ($fasilitasItem['category'] === 'luar')
                            <div class="relative group rounded-lg overflow-hidden shadow-lg fasilitas-item" data-name="{{ strtolower($fasilitasItem['name']) }}">
                                <img src="{{ asset('images/Fasilitas/FasilitasLuar/' . $fasilitasItem['image']) }}" 
                                     alt="{{ $fasilitasItem['name'] }}" 
                                     class="object-cover w-full h-64">
                                <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <h3 class="text-lg font-semibold">{{ $fasilitasItem['name'] }}</h3>
                                    <p class="text-sm">{{ $fasilitasItem['description'] }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
        </div>
    </div>
</div>

<x-footer />


</x-dynamic-component>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const searchBar = document.getElementById('searchBar');
        const fasilitasItems = document.querySelectorAll('.fasilitas-item');
        const toggleView = document.getElementById('toggleView');
        const fasilitasContainers = [document.getElementById('fasilitasDalam'), document.getElementById('fasilitasLuar')];

        // Filter fasilitas
        searchBar.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            fasilitasItems.forEach(item => {
                const name = item.getAttribute('data-name');
                item.style.display = name.includes(query) ? 'block' : 'none';
            });
        });

        // Animasi hover tambahan
        fasilitasItems.forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.classList.add('shadow-2xl');
                item.classList.add('transform', 'scale-105');
            });
            item.addEventListener('mouseleave', () => {
                item.classList.remove('shadow-2xl');
                item.classList.remove('transform', 'scale-105');
            });
        });
    });
</script>
