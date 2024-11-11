<!-- <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button> -->

@props([
    'color' => 'gray' // Default color is gray
])

@php
    $bgColor = match($color) {
        'blue' => 'bg-blue-600 hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700',
        'red' => 'bg-red-600 hover:bg-red-500 focus:bg-red-500 active:bg-red-700',
        'green' => 'bg-green-600 hover:bg-green-500 focus:bg-green-500 active:bg-green-700',
        default => 'bg-gray-800 hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900',
    };
@endphp

<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => "inline-flex items-center px-4 py-2 $bgColor border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150"
]) }}>
    {{ $slot }}
</button>