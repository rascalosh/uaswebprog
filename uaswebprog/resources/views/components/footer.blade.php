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
                            <li><a href="{{ Auth::check() ? route('dashboard') : route('welcome') }}" class="hover:text-white">Home</a></li>
                            <li><a href="{{ route('fasilitas') }}" class="hover:text-white">Facilities</a></li>
                            <li><a href="https://wa.link/71i4rz" class="hover:text-white">Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2 mt-5">Contact</h4>
                        <ul>
                            <li>Phone: +62 821-8064-9696</li>
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