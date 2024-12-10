<?php

use Carbon\Carbon;
use App\Models\Pelaporan;
use App\Models\Guest;

?>

@php
    Guest::where('end_date', '<', Carbon::now()->subDays(7))
        ->delete();

    Pelaporan::onlyTrashed()
        ->where('deleted_at', '<', Carbon::now()->subDays(7))
        ->forceDelete();
@endphp

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
                <div class="grid grid-flow-col auto-cols-max gap-10 overflow-x-auto">
                    @foreach ($guests as $guest)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $guest->guest_name }}
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $guest->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Jenis Kos: {{ $guest->gender }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Email: {{ $guest->email_user }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Relation: {{ $guest->relation }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Check In: {{ Carbon::parse($guest->visit_date)->format('F j, Y') }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Check Out: {{ Carbon::parse($guest->end_date)->format('F j, Y') }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Jumlah Pengunjung: {{ $guest->guest_amount }}
                            </p>
                            <form action="{{ route('admin.guests.destroy', $guest->id_guest) }}" method="POST"
                                onsubmit="return confirm('Apakah anda yakin ingin menghapus tamu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Selesai
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
                <div class="grid grid-flow-col auto-cols-max gap-10 overflow-x-auto">
                    @foreach ($reports as $report)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $report->full_name }}</h4>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $report->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Jenis Kos: {{ $report->gender_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Reported At: {{ Carbon::parse($report->tanggal)->format('F j, Y') }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Decription: {{ $report->desc_pelaporan }}</p>

                            <div class="flex justify-between">
                                @if($report->proof)
                                    <button onclick="openProofModal()" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Proof</button>
                                @endif

                                <form action="{{ route('admin.report.destroy', $report->id_pelaporan) }}" method="POST"
                                    onsubmit="return confirm('Apakah anda yakin ingin resolve report ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Resolve</button>
                                </form>
                            </div>
                        </div>

                        <div id="proofModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen">
                                <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                                    <div class="px-4 py-3">
                                        <h2 class="text-lg font-semibold">Proof Image</h2>
                                        <img src="{{ asset('images/ReportProofs/' . $report->proof) }}" /> 
                                        <div class="flex justify-end mt-4">
                                            <button type="button" onclick="closeProofModal()" class="ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

<script>
    function openProofModal(userId) {
        const modal = document.getElementById('proofModal');
        modal.classList.remove('hidden');
    }

    function closeProofModal() {
        const modal = document.getElementById('proofModal');
        modal.classList.add('hidden');
    }
</script>
