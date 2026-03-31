<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    
                    @if(Auth::user()->role === 'admin')
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('aspirasi.index') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg text-center block">
                            Kelola Aspirasi
                        </a>
                        <a href="{{ route('kategori.index') }}" 
                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-4 px-6 rounded-lg text-center block">
                            Kelola Kategori
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>