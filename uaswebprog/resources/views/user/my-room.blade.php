<x-app-layout>
    @php
        $user = Auth::user();
        $email = $user->email;
        $gender = $user->gender;
        if ($gender == 'L') {
            $room = DB::table('kamar_pria')->where('email', $email)->first();
        } elseif ($gender == 'P') {
            $room = DB::table('kamar_perempuan')->where('email', $email)->first();
        }
    @endphp

    @if ($room)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $room->nomor_kamar }}
                {{ $room->full_name }}
            </h2>
        </x-slot>

        <a
            href="{{ route('report') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            <x-button color="red">
                Report a Problem
            </x-button>

        </a>

        <a
            href="{{ route('guest-form') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            <x-button color="red">
                Guest Form
            </x-button>

        </a>
    @endif
</x-app-layout>
