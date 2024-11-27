<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Room Images') }}
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('admin.add_room_images') }}" enctype="multipart/form-data">
                @csrf
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload file</label>
                <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG or JPEG (MAX. 800x400px).</p>

                <div class="flex items-center mb-4 mt-4">
                    <input id="default-radio-1" type="radio" value="KamarPria" name="jenis_kos" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Laki-Laki</label>
                </div>
                <div class="flex items-center">
                    <input id="default-radio-2" type="radio" value="KamarPerempuan" name="jenis_kos" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Perempuan</label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ms-4">
                        {{ __('Add Image') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>

</x-admin-layout>
