<x-guest-layout>

    <h1>Report Resolved</h1>
    <p>Details of the resolved report:</p>

    <ul>
        <li>Title: {{ $reportDetails->full_name }}</li>
        <li>Nomor Kamar: {{ $reportDetails->nomor_kamar }}</li>
        <li>Jenis Kos: {{ $reportDetails->gender_kamar }}</li>
        <li>Reported At: {{ $reportDetails->tanggal }}</li>
        <li>Description: {{ $reportDetails->desc_pelaporan }}</li>
        <li>Status: Resolved</li>
    </ul>
</x-guest-layout>