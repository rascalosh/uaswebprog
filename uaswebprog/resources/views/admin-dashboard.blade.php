<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Tamu berkunjung</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($guests as $guest)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $guest->guest_name }}
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $guest->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Jenis Kos: {{ $guest->gender }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Email: {{ $guest->email_user }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Relation: {{ $guest->relation }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Check In: {{ $guest->visit_date }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Jumlah Pengunjung: {{ $guest->guest_amount }}
                            </p>
                            <form action="{{ route('admin.guests.destroy', $guest->id_guest) }}" method="POST"
                                onsubmit="return confirm('Apakah anda yakin ingin menghapus tamu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Selesai
                                    Berkunjung</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Reports</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($reports as $report)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $report->full_name }}</h4>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $report->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Jenis Kos: {{ $report->gender_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Reported At: {{ $report->tanggal }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Decription: {{ $report->desc_pelaporan }}</p>
                            <form action="{{ route('admin.report.destroy', $report->id_pelaporan) }}" method="POST"
                                onsubmit="return confirm('Apakah anda yakin ingin resolve report ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded">Resolved</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
