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
<x-dynamic-component :component="Auth::check() ? 'app-layout' : 'welcome-layout'">

    <div>
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden w-full">
                <x-facilities />
            </div>
        </div>
    </div>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
            <!-- Filter & View Toggle -->
            <div class="flex justify-between items-center mb-6">
                <input id="searchBar" type="text" placeholder="Cari fasilitas..."
                    class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Fasilitas Dalam -->
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-8 text-center">
                Fasilitas Dalam
            </h2>
            <div id="fasilitasDalam" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($fasilitas as $fasilitasItem)
                    @if ($fasilitasItem['category'] === 'dalam')
                        <div class="fasilitas-item group relative overflow-hidden border border-gray-200 rounded-lg shadow-lg bg-white dark:bg-gray-900 p-6 transition-transform transform hover:scale-105 hover:shadow-2xl">
                            <div class="w-full h-40 relative mb-4">
                                <img src="{{ asset('images/Fasilitas/FasilitasDalam/' . $fasilitasItem['image']) }}"
                                    alt="{{ $fasilitasItem['name'] }}"
                                    class="rounded-lg object-cover w-full h-full transition-transform transform group-hover:scale-110">
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition"></div>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 text-center">
                                {{ $fasilitasItem['name'] }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-4">
                                {{ $fasilitasItem['description'] }}
                            </p>
                            <div class="w-full flex justify-center mt-4">
                                <ion-icon name="{{ $fasilitasItem['icon'] }}" class="text-4xl text-blue-500"></ion-icon>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <hr class="my-12 border-t-2 border-gray-300 dark:border-gray-600">

            <!-- Fasilitas Luar -->
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-8 text-center">
                Fasilitas Luar
            </h2>
            <div id="fasilitasLuar" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach ($fasilitas as $fasilitasItem)
                    @if ($fasilitasItem['category'] === 'luar')
                        <div class="fasilitas-item group relative overflow-hidden border border-gray-200 rounded-lg shadow-lg bg-white dark:bg-gray-900 p-6 transition-transform transform hover:scale-105 hover:shadow-2xl">
                            <div class="w-full h-40 relative mb-4">
                                <img src="{{ asset('images/Fasilitas/FasilitasLuar/' . $fasilitasItem['image']) }}"
                                    alt="{{ $fasilitasItem['name'] }}"
                                    class="rounded-lg object-cover w-full h-full transition-transform transform group-hover:scale-110">
                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition"></div>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 text-center">
                                {{ $fasilitasItem['name'] }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-4">
                                {{ $fasilitasItem['description'] }}
                            </p>
                            <div class="w-full flex justify-center mt-4">
                                <ion-icon name="{{ $fasilitasItem['icon'] }}" class="text-4xl text-green-500"></ion-icon>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>


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



    <!-- Footer -->
    <footer class="bg-slate-600 text-gray-200 py-1 mt-56">
        <div class="container mx-auto px-6 lg:px-5">
            <div class="lg:flex lg:justify-between">
                <!-- Logo dan Deskripsi -->
                <div class="mb-6 lg:mb-0">
                    <h3 class="text-2xl font-bold mb-1 mt-7">Aloha Guest House</h3>
                    <p class="text-sm">
                        Hunian nyaman dengan lokasi strategis di Gading Serpong. Menyediakan fasilitas terbaik untuk
                        mahasiswa dan profesional muda.
                    </p>
                </div>

                <!-- Link Navigasi -->
                <div class="grid grid-cols-2 gap-4 lg:gap-8 text-sm">
                    <div>
                        <h4 class="font-semibold mb-2 mt-5">Quick Links</h4>
                        <ul>
                            <li><a href="#" class="hover:text-white">Home</a></li>
                            <li><a href="#" class="hover:text-white">Facilities</a></li>
                            <li><a href="#" class="hover:text-white">Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2 mt-5">Contact</h4>
                        <ul>
                            <li>Phone: +62 812-3456-7890</li>
                            <li>Email: info@alohaguesthouse.com</li>
                            <li>Address: Gading Serpong, Indonesia</li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-gray-700">

            <!-- Hak Cipta -->
            <div class="text-center text-sm">
                © 2024 Aloha Guest House. All rights reserved.
            </div>
        </div>
    </footer>