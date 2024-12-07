<div class="relative h-screen w-screen">
    <!-- Gambar latar belakang dengan overlay gelap -->
    <div class="absolute inset-0 bg-black bg-opacity-30"></div>
    <img src="{{ asset('images/Welcome_Banner.jpeg') }}" 
         alt="Welcome Banner" 
         class="w-full h-full object-cover">
    <div class="absolute bottom-0 w-full h-32 bg-gradient-to-t from-[#f8f4f4] to-transparent"></div>
    <!-- Teks di atas banner -->
    <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white p-6">
        <h1 id="banner-title" class="text-5xl font-extrabold mb-4 opacity-0 transition-all duration-1000 ease-in-out drop-shadow-lg">
            Fasilitas <span class="text-orange-500">Aloha Guest House</span>
        </h1>
        <!-- Tombol Explore Now -->
        <a 
           id="explore-btn" 
           class="px-8 py-4 border-2 border-white text-white rounded-full text-xl font-semibold shadow-lg transform scale-90 transition-all duration-300 ease-in-out hover:bg-white hover:text-black hover:scale-105 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 opacity-0 hover:cursor-pointer">
            Explore Now
        </a>
    </div>
</div>

<!-- Konten utama -->
<div id="main-content" class="py-1 bg-gray-100"></div>

<!-- Script untuk animasi -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            document.getElementById('banner-title').style.opacity = 1;
            document.getElementById('banner-title').style.transform = 'translateY(0)';
        }, 500);

        setTimeout(() => {
            document.getElementById('banner-subtitle').style.opacity = 1;
            document.getElementById('banner-subtitle').style.transform = 'translateY(0)';
        }, 1000);

        setTimeout(() => {
            const exploreBtn = document.getElementById('explore-btn');
            exploreBtn.style.opacity = 1;
            exploreBtn.style.transform = 'scale(1)';
        }, 1500);

        document.getElementById('explore-btn').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('main-content').scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>
