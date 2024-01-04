<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="w-full mx-auto ">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="w-full p-6 text-gray-900">
                {{ __("You're logged in!") }}
            </div>
        </div>
    </div>
</x-app-layout>
