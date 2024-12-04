<?php

use Illuminate\Support\Facades\File;
$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

?>

<x-app-layout>

    <!-- Banner Section -->  
    <div>
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl w-full">
                <x-welcome-banner />
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="mt-16 lg:px-20 px-6" data-aos="fade-up">
        <div class="lg:flex lg:items-start lg:gap-8">
            <div class="lg:w-2/7 mb-6 lg:mb-0">
                <img src="{{ asset('images/aloha.jpeg') }}" alt="Aloha Guest House" class="w-full h-auto rounded shadow-md ml-10" style="width: 25rem; height: 25rem; object-fit: cover;">
            </div>
            <div class="lg:w-2/3 mt-20">
                <h2 class="text-3xl font-bold mb-4">ALOHA GUEST HOUSE</h2>
                <p class="text-gray-700 text-justify">
                    Aloha Guest House berlokasi strategis di Cluster Allogio, Gading Serpong, dengan akses mudah ke berbagai fasilitas utama. Hanya 5 menit dari Universitas Multimedia Nusantara (UMN) dan Summarecon Digital Center (SDC), serta 20 menit ke Lippo Karawaci dan Alam Sutera, hunian ini sangat ideal bagi mahasiswa dan profesional muda. BSD City dapat dicapai dalam 30-35 menit, dan berbagai tempat makan serta minimarket tersedia di sekitar kost untuk memenuhi kebutuhan sehari-hari. Shuttle bus dari Allogio ke SDC dan Summarecon Mall Serpong (SMS) memudahkan mobilitas, termasuk akses transportasi ke Jakarta. Aloha Guest House menawarkan kenyamanan dan kemudahan di lokasi yang strategis.
                </p>
            </div>
        </div>
    </div>
    
    <!-- Rooms Section -->
    <div class="mt-40 lg:px-20 px-6" data-aos="zoom-in">
        <h2 class="text-3xl font-bold mb-6 text-center">OUR FACILITIES</h2>
        <div x-data="{ currentIndex: 0 }" class="relative w-full overflow-hidden">
            <!-- Carousel Container -->
            <div class="flex transition-transform duration-500" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                @php
                    $imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
                    $chunks = array_chunk($imagesPerempuan, 3); // Bagi gambar ke grup 3 per baris
                @endphp

                @foreach ($chunks as $chunk)
                    <div class="grid grid-cols-3 gap-4 flex-shrink-0 w-full">
                        @foreach ($chunk as $image)
                            <div>
                                <img src="{{ asset('images/KamarPerempuan/' . $image->getFilename()) }}" alt="Room Image" class="w-full h-48 object-cover rounded shadow-md" style="width: 40rem; height: 20rem; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Left Button -->
            <button
                @click="currentIndex = (currentIndex === 0) ? {{ count($chunks) - 1 }} : currentIndex - 1"
                class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full shadow hover:bg-gray-400"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Right Button -->
            <button
                @click="currentIndex = (currentIndex === {{ count($chunks) - 1 }}) ? 0 : currentIndex + 1"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full shadow hover:bg-gray-400"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Rooms Section -->
    <div class="mt-16 lg:px-20 px-6" data-aos="zoom-in">
        <h2 class="text-3xl font-bold mb-6 text-center">OUR FACILITIES</h2>
        <div x-data="{ currentIndex: 0 }" class="relative w-full overflow-hidden">
            <!-- Carousel Container -->
            <div class="flex transition-transform duration-500" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                @php
                    $imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
                    $chunks = array_chunk($imagesPerempuan, 3); // Bagi gambar ke grup 3 per baris
                @endphp

                @foreach ($chunks as $chunk)
                    <div class="grid grid-cols-3 gap-4 flex-shrink-0 w-full">
                        @foreach ($chunk as $image)
                            <div>
                                <img src="{{ asset('images/KamarPerempuan/' . $image->getFilename()) }}" alt="Room Image" class="w-full h-48 object-cover rounded shadow-md" style="width: 40rem; height: 20rem; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Left Button -->
            <button
                @click="currentIndex = (currentIndex === 0) ? {{ count($chunks) - 1 }} : currentIndex - 1"
                class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full shadow hover:bg-gray-400"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Right Button -->
            <button
                @click="currentIndex = (currentIndex === {{ count($chunks) - 1 }}) ? 0 : currentIndex + 1"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full shadow hover:bg-gray-400"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Rooms Section -->
    <div class="mt-16 lg:px-20 px-6" data-aos="zoom-in">
        <h2 class="text-3xl font-bold mb-6 text-center">OUR FACILITIES</h2>
        <div x-data="{ currentIndex: 0 }" class="relative w-full overflow-hidden">
            <!-- Carousel Container -->
            <div class="flex transition-transform duration-500" :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                @php
                    $imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
                    $chunks = array_chunk($imagesPerempuan, 3); // Bagi gambar ke grup 3 per baris
                @endphp

                @foreach ($chunks as $chunk)
                    <div class="grid grid-cols-3 gap-4 flex-shrink-0 w-full">
                        @foreach ($chunk as $image)
                            <div>
                                <img src="{{ asset('images/KamarPerempuan/' . $image->getFilename()) }}" alt="Room Image" class="w-full h-48 object-cover rounded shadow-md" style="width: 40rem; height: 20rem; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Left Button -->
            <button
                @click="currentIndex = (currentIndex === 0) ? {{ count($chunks) - 1 }} : currentIndex - 1"
                class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full shadow hover:bg-gray-400"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Right Button -->
            <button
                @click="currentIndex = (currentIndex === {{ count($chunks) - 1 }}) ? 0 : currentIndex + 1"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full shadow hover:bg-gray-400"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-slate-600 text-gray-200 py-1 mt-56">
    <div class="container mx-auto px-6 lg:px-5">
        <div class="lg:flex lg:justify-between">
            <!-- Logo dan Deskripsi -->
            <div class="mb-6 lg:mb-0">
                <h3 class="text-2xl font-bold mb-1 mt-7">Aloha Guest House</h3>
                <p class="text-sm">
                    Hunian nyaman dengan lokasi strategis di Gading Serpong. Menyediakan fasilitas terbaik untuk mahasiswa dan profesional muda.
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

</x-app-layout>

