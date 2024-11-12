<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Rooms Pria') }}
        </h2>
    </x-slot>

    <x-validation-errors class="my-5 text-center" />

    @foreach ($data as $row)

    <div class="grid justify-center mt-10">

        <div>{{ $row->nomor_kamar }}</div>

        <form action="{{ route('admin.update_email_pria', $row->nomor_kamar) }}" method="POST">
            @csrf
            <div>
                <input type="email" name="email" value="{{ $row->email }}">
                <!-- <button class="update-email-btn" type="submit">Update Email</button> -->
                <!-- <button type="submit" name="clear_email" value="1">Delete Email</button> -->

                <x-button>
                    {{ __('Update Email') }}
                </x-button>

                <x-button name="clear_email" value="1">
                    {{ __('Delete Email') }}
                </x-button>

            </div>
        </form>
        
    </div>
    @endforeach
</x-admin-layout>
