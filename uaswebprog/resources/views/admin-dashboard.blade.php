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
                                        <button onclick="openProofModal('{{ asset('storage/' . $report->proof) }}')" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Proof</button>
                                @endif

                                <form id="deleteReportForm-{{ $report->id_pelaporan }}" action="{{ route('admin.report.destroy', $report->id_pelaporan) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="openConfirmReportModal('{{ $report->id_pelaporan }}')" type="button" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Resolve</button>
                                </form>
                            </div>
                        </div>

                        <div id="proofModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
                            <div class="flex items-center justify-center min-h-screen">
                                <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                                    <div class="px-4 py-3">
                                        <h2 class="text-lg font-semibold">Proof Image</h2>
                                        <img id="proofImage" src="" alt="Proof Image" />
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Guests</h3>
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

                            @if($guest->deleted_at)
                                <form id="deleteGuestForm-{{ $guest->id_guest }}" action="{{ route('admin.guests.destroy', $guest->id_guest) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="openConfirmGuestModal('{{ $guest->id_guest }}')" type="button" class="mt-4 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Delete</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div id="confirmReportModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-4 py-3">
                    <h2 class="text-lg font-semibold">Confirmation</h2>
                    <p>Are you sure you want to resolve this report?</p>
                        <div class="flex justify-end mt-4">
                            <button type="button" onclick="closeConfirmReportModal()" class="text-gray-500 hover:text-gray-800">Cancel</button>
                            <button type="button" onclick="confirmDeleteReport(); disableSubmitButton(this);" class="ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="confirmGuestModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-4 py-3">
                    <h2 class="text-lg font-semibold">Confirmation</h2>
                    <p>Are you sure you want to delete this guest entry?</p>
                        <div class="flex justify-end mt-4">
                            <button type="button" onclick="closeConfirmGuestModal()" class="text-gray-500 hover:text-gray-800">Cancel</button>
                            <button type="button" onclick="confirmDeleteGuest(); disableSubmitButton(this);" class="ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

<script>
    function openProofModal(imageSrc) {
        const modal = document.getElementById('proofModal');
        const image = document.getElementById('proofImage');
        image.src = imageSrc;
        modal.classList.remove('hidden');
    }

    function closeProofModal() {
        const modal = document.getElementById('proofModal');
        modal.classList.add('hidden');
    }

    let currentReportFormId = null;

    function openConfirmReportModal(reportId) {

        currentReportFormId = `deleteReportForm-${reportId}`;
        document.getElementById('confirmReportModal').classList.remove('hidden');
    }

    function closeConfirmReportModal() {
        document.getElementById('confirmReportModal').classList.add('hidden');
    }

    function confirmDeleteReport() {
        if (currentReportFormId) {
            document.getElementById(currentReportFormId).submit();
        }
    }

    let currentGuestFormId = null;

    function openConfirmGuestModal(guestId) {

        currentGuestFormId = `deleteGuestForm-${guestId}`;
        document.getElementById('confirmGuestModal').classList.remove('hidden');
    }

    function closeConfirmGuestModal() {
        document.getElementById('confirmGuestModal').classList.add('hidden');
    }

    function confirmDeleteGuest() {
        if (currentGuestFormId) {
            document.getElementById(currentGuestFormId).submit();
        }
    }

    function disableSubmitButton(button) {
        button.disabled = true;
        button.innerText = "Processing...";
        button.classList.add("opacity-50", "cursor-not-allowed");
    }

</script>
