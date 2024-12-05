<?php

use Illuminate\Support\Facades\File;
$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

?>

<x-welcome-layout>
    <!-- Banner Section -->
    <div>
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden w-full">
                <x-welcome-banner />
            </div>
        </div>
    </div>

<!-- About Section -->
<div class="mt-20 lg:px-28 px-8" data-aos="fade-up">
    <div class="lg:flex lg:items-center lg:gap-12 text-center lg:text-left">
        <!-- Gambar Utama -->
        <div class="lg:w-1/3 mb-8 lg:mb-0 relative flex justify-center">
            <img src="{{ asset('images/aloha.jpeg') }}" alt="Aloha Guest House"
                class="w-80 h-80 lg:w-96 lg:h-96 rounded-xl shadow-xl object-cover transition transform duration-700 ease-in-out hover:scale-110 hover:rotate-3">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0  opacity-30 rounded-xl"></div>
        </div>

        <!-- Konten -->
        <div class="lg:w-2/3 mt-8 lg:mt-0">
            <h2 class="text-5xl font-extrabold text-gray-900 leading-tight mb-6 animate__animated animate__fadeIn animate__delay-0.5s">
                Welcome to <span class="text-yellow-500 text-6xl">Aloha</span><br>
                <span class="text-gray-800">Guest House</span>
            </h2>
            <p class="text-gray-700 leading-relaxed mb-8 text-lg lg:text-xl font-medium animate__animated animate__fadeIn animate__delay-1s">
                Terletak strategis di Cluster Alloggio, Gading Serpong, Aloha Guest House menawarkan kenyamanan dan
                kemudahan akses ke fasilitas utama, seperti UMN, SDC, dan berbagai tempat makan. Hunian ideal untuk
                mahasiswa dan profesional muda yang mengutamakan kenyamanan dan aksesibilitas. Nikmati pengalaman
                menginap yang tenang dengan fasilitas terbaik untuk memenuhi kebutuhan Anda.
            </p>

            <!-- Call to Action Section -->
            <div class="flex justify-center lg:justify-start mb-8 animate__animated animate__fadeIn animate__delay-1.5s">
                <a href="#contact" 
                   class="inline-block px-8 py-3 border-2 border-yellow-600 text-lg font-semibold text-yellow-600 bg-transparent rounded-lg transition-all duration-300 ease-in-out transform hover:bg-yellow-600 hover:text-white hover:border-yellow-600 hover:scale-105">
                    Contact Us
                </a>
            </div>
        </div>
    </div>

<!-- Fitur dengan Icon -->
<div class="grid lg:grid-cols-3 grid-cols-1 gap-8 mt-12 text-center">
    <!-- Dekat UMN -->
    <div class="flex flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/university.png" alt="University Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Dekat UMN dan Pradita</h3>
        <p class="text-gray-600">
            Hanya 5 menit dari Universitas Multimedia Nusantara (UMN) dan Universitas Pradita, menjadikan Aloha Guest House pilihan ideal bagi mahasiswa.
        </p>
    </div>

    <!-- Fasilitas Sekitar -->
    <div class="flex flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/shopping-basket.png" alt="Shopping Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Fasilitas Sekitar</h3>
        <p class="text-gray-600">
            Tersedia berbagai tempat makan dan minimarket di sekitar kost untuk memenuhi kebutuhan sehari-hari.
        </p>
    </div>

    <!-- Shuttle Bus -->
    <div class="flex flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/bus.png" alt="Shuttle Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Shuttle Bus</h3>
        <p class="text-gray-600">
            Nikmati kemudahan transportasi dengan shuttle bus yang menghubungkan Allogio ke SDC dan Summarecon Mall Serpong (SMS).
        </p>
    </div>

    <!-- Akses ke Lippo Karawaci & Alam Sutera -->
    <div class="flex justify-center flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/road.png" alt="Road Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Dekat Lippo Karawaci & Alam Sutera</h3>
        <p class="text-gray-600">
            Aloha Guest House hanya 20 menit dari Lippo Karawaci dan Alam Sutera, memudahkan akses ke berbagai fasilitas utama.
        </p>
    </div>

    <!-- Akses ke BSD City -->
    <div class="flex justify-center flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/city.png" alt="City Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Akses ke BSD City</h3>
        <p class="text-gray-600">
            Capai BSD City dalam 30-35 menit, pusat perbelanjaan dan area komersial yang berkembang pesat.
        </p>
    </div>

    <!-- Dekat SMS -->
    <div class="flex flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/building.png" alt="Building Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Dekat SMS</h3>
        <p class="text-gray-600">
            Hanya 5 menit dari Summarecon Mall Serpong (SMS), pusat perbelanjaan terkemuka di kawasan Gading Serpong.
        </p>
    </div>
</div>


    <<!-- Rooms Section -->
<div class="mt-40 lg:px-20 px-6" data-aos="zoom-in">
        <h2 class="text-4xl font-extrabold text-gray-900 text-center leading-tight mb-5 animate__animated animate__fadeIn animate__delay-0.5s">
            <span class="text-yellow-600">Kamar Terbaik</span> untuk Anda
        </h2>
    
        <!-- Pemisah -->
        <div class="flex justify-center items-center mb-8">
            <span class="w-1/4 border-t-2 border-gray-300"></span>
            <span class="mx-4 text-gray-400 font-semibold">x</span>
            <span class="w-1/4 border-t-2 border-gray-300"></span>
        </div>

        @php
            $imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
            $chunks = array_chunk($imagesPerempuan, 3); // Bagi gambar ke grup 3 per baris
        @endphp

    <div x-data="{ currentIndex: 0, totalSlides: {{ count($chunks) }} }" class="relative w-full overflow-hidden">

        <!-- Carousel Container -->
        <div class="flex transition-transform duration-700 ease-in-out"
            :style="{ transform: `translateX(-${currentIndex * 100}%)` }">

            @foreach ($chunks as $chunk)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 flex-shrink-0 w-full">
                    @foreach ($chunk as $image)
                        <div class="relative group overflow-hidden rounded-lg shadow-lg">
                            <!-- Room Image -->
                            <img src="{{ asset('images/KamarPerempuan/' . $image->getFilename()) }}" alt="Room Image"
                                class="w-full h-72 object-cover transform group-hover:scale-110 transition duration-500 ease-in-out">
                            
                            <!-- Overlay with Room Description -->
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <div class="text-center text-white px-4 py-6">
                                    <h3 class="text-2xl font-semibold mb-2 text-shadow-md">Kamar untuk Anda</h3>
                                    <p class="text-lg mb-4">Nikmati kenyamanan dan privasi di kamar dengan fasilitas lengkap. Ideal untuk istirahat dan relaksasi.</p>
                                    <a href="{{ route('reserve-room') }}"
                                        class="inline-block px-8 py-3 border-2 border-white text-lg font-semibold text-white bg-transparent rounded-lg transition-all duration-300 ease-in-out transform hover:bg-yellow-600 hover:text-white hover:border-yellow-600 hover:scale-105">
                                        Lihat Lebih Banyak
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Left Button -->
        <button @click="currentIndex = (currentIndex === 0) ? totalSlides - 1 : currentIndex - 1"
            class="absolute left-0 top-1/2 transform -translate-y-1/2 border-2 border-white p-4 rounded-full shadow-lg text-white hover:scale-110 transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </button>

        <!-- Right Button -->
        <button @click="currentIndex = (currentIndex === totalSlides - 1) ? 0 : currentIndex + 1"
            class="absolute right-0 top-1/2 transform -translate-y-1/2 border-2 border-white p-4 rounded-full shadow-lg text-white hover:scale-110 transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </button>

        <!-- Indicator Dots -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3">
            <template x-for="(dot, index) in totalSlides" :key="index">
                <span :class="{'bg-gray-500': currentIndex === index, 'bg-gray-300': currentIndex !== index}"
                    class="w-3 h-3 rounded-full cursor-pointer transition duration-300"
                    @click="currentIndex = index"></span>
            </template>
        </div>
    </div>
</div>




<!-- Our Awesome Services and Facilities Section -->
<div class="mt-20 lg:px-28 px-8 py-16 bg-gradient-to-b from-navy-800 to-white" data-aos="fade-up">
    <div class="text-center">
        <h2 class="text-4xl font-extrabold text-gray-900 leading-tight mb-5 animate__animated animate__fadeIn animate__delay-0.5s">
            Layanan & Fasilitas <span class="text-yellow-600">Unggulan</span> Kami
        </h2>
        <!-- Pemisah -->
        <div class="flex justify-center items-center mb-8">
            <span class="w-1/4 border-t-2 border-gray-300"></span>
            <span class="mx-4 text-gray-400 font-semibold">x</span>
            <span class="w-1/4 border-t-2 border-gray-300"></span>
        </div>

    </div>
    
    <!-- Grid Layout: 2 Baris 3 Kolom -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
        <!-- Keamanan -->
        <div class="flex flex-col items-center bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 ease-in-out hover:scale-105 transform group">
            <img src="{{ asset('images/Fasilitas/FasilitasLuar/Keamanan.jpg') }}" alt="Keamanan" class="w-16 h-16 mb-4 object-cover rounded-full group-hover:scale-110 transition-all duration-300 ease-in-out">
            <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-yellow-600 transition-all duration-300 ease-in-out">Keamanan 24 Jam</h3>
            <p class="text-gray-700 text-center opacity-90 group-hover:opacity-100 transition-all duration-300 ease-in-out">Keamanan yang terjamin dengan sistem pengawasan 24 jam dan petugas keamanan yang berjaga di depan kompleks.</p>
        </div>
        
        <!-- Parkir -->
        <div class="flex flex-col items-center bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 ease-in-out hover:scale-105 transform group">
            <img src="{{ asset('images/Fasilitas/FasilitasLuar/Parkiran.jpg') }}" alt="Parkir" class="w-16 h-16 mb-4 object-cover rounded-full group-hover:scale-110 transition-all duration-300 ease-in-out">
            <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-yellow-600 transition-all duration-300 ease-in-out">Parkir Luas</h3>
            <p class="text-gray-700 text-center opacity-90 group-hover:opacity-100 transition-all duration-300 ease-in-out">Tempat parkir yang luas dan memadai, memberikan kenyamanan untuk kendaraan para tamu kami.</p>
        </div>
        
        <!-- Kolam Renang -->
        <div class="flex flex-col items-center bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 ease-in-out hover:scale-105 transform group">
            <img src="{{ asset('images/Fasilitas/FasilitasLuar/Kolam.jpg') }}" alt="Kolam Renang" class="w-16 h-16 mb-4 object-cover rounded-full group-hover:scale-110 transition-all duration-300 ease-in-out">
            <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-yellow-600 transition-all duration-300 ease-in-out">Kolam Renang</h3>
            <p class="text-gray-700 text-center opacity-90 group-hover:opacity-100 transition-all duration-300 ease-in-out">Kolam renang yang indah, sempurna untuk bersantai dan menikmati waktu luang setelah beraktivitas.</p>
        </div>
        
        <!-- Lapangan Basket -->
        <div class="flex flex-col items-center bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 ease-in-out hover:scale-105 transform group">
            <img src="{{ asset('images/Fasilitas/FasilitasLuar/Lapangan.jpg') }}" alt="Lapangan Basket" class="w-16 h-16 mb-4 object-cover rounded-full group-hover:scale-110 transition-all duration-300 ease-in-out">
            <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-yellow-600 transition-all duration-300 ease-in-out">Lapangan Basket</h3>
            <p class="text-gray-700 text-center opacity-90 group-hover:opacity-100 transition-all duration-300 ease-in-out">Lapangan basket yang dapat digunakan untuk berolahraga dan bersenang-senang bersama teman-teman.</p>
        </div>
        
        <!-- Laundry -->
        <div class="flex flex-col items-center bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 ease-in-out hover:scale-105 transform group">
            <img src="{{ asset('images/Fasilitas/FasilitasDalam/Laundry.jpg') }}" alt="Layanan Laundry" class="w-16 h-16 mb-4 object-cover rounded-full group-hover:scale-110 transition-all duration-300 ease-in-out">
            <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-yellow-600 transition-all duration-300 ease-in-out">Layanan Laundry</h3>
            <p class="text-gray-700 text-center opacity-90 group-hover:opacity-100 transition-all duration-300 ease-in-out">Layanan laundry profesional untuk memastikan pakaian Anda tetap bersih dan segar selama menginap.</p>
        </div>
        
        <!-- Pembersihan Kamar -->
        <div class="flex flex-col items-center bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition duration-300 ease-in-out hover:scale-105 transform group">
            <img src="{{ asset('images/Fasilitas/FasilitasDalam/Kebersihan.jpg') }}" alt="Pembersihan Kamar" class="w-16 h-16 mb-4 object-cover rounded-full group-hover:scale-110 transition-all duration-300 ease-in-out">
            <h3 class="text-xl font-semibold text-gray-900 mb-2 group-hover:text-yellow-600 transition-all duration-300 ease-in-out">Pembersihan Kamar</h3>
            <p class="text-gray-700 text-center opacity-90 group-hover:opacity-100 transition-all duration-300 ease-in-out">Layanan pembersihan kamar harian untuk menjaga kenyamanan dan kebersihan ruang tinggal Anda.</p>
        </div>
    </div>

    <!-- Button "More" -->
    <div class="text-center mt-12">
        <a href="{{ route('fasilitas') }}" class="inline-block px-8 py-3 border-2 border-yellow-600 text-lg font-semibold text-yellow-600 bg-transparent rounded-lg transition-all duration-300 ease-in-out transform hover:bg-yellow-600 hover:text-white hover:border-yellow-600 hover:scale-105">
            More
        </a>
    </div>
</div>


</x-welcome-layout>

     <!-- Footer -->
    <footer class="bg-slate-600 text-gray-200 py-1 mt-50">
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
    
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const facilityCards = document.querySelectorAll('.facility-card');
        facilityCards.forEach(card => {
            card.addEventListener('mouseover', () => {
                card.classList.add('animate__animated', 'animate__pulse');
            });
            card.addEventListener('mouseout', () => {
                card.classList.remove('animate__animated', 'animate__pulse');
            });
        });

        const facilitiesContainer = document.getElementById('facilities-container');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 500) {
                facilitiesContainer.classList.add('animate__animated', 'animate__fadeInUp');
            }
        });
    });

    setInterval(function () {
        const slides = document.querySelector('[x-data]');
        const totalSlides = slides.__x.$data.totalSlides;
        let currentIndex = slides.__x.$data.currentIndex;
        
        currentIndex = (currentIndex === totalSlides - 1) ? 0 : currentIndex + 1;
        slides.__x.$data.currentIndex = currentIndex;
    }, 5000);  // Change slide every 5 seconds
</script>