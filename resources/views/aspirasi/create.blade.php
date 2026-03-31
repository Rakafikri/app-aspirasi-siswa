<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Aspirasi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('aspirasi.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Kategori
                            </label>
                            <select name="id_kategori" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('id_kategori') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                <option value="{{ $kat->id_kategori }}">{{ $kat->ket_kategori }}</option>
                                @endforeach
                            </select>
                            @error('id_kategori')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Lokasi
                            </label>
                            <input type="text" name="lokasi" value="{{ old('lokasi') }}" 
                                   class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('lokasi') border-red-500 @enderror"
                                   placeholder="Contoh: Ruang Kelas XII IPA 1">
                            @error('lokasi')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Keluhan / Aspirasi
                            </label>
                            <textarea name="kel" rows="4" 
                                      class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('kel') border-red-500 @enderror"
                                      placeholder="Jelaskan masalah sarana/prasarana yang ingin dilaporkan...">{{ old('kel') }}</textarea>
                            @error('kel')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Kirim Aspirasi
                            </button>
                            <a href="{{ route('aspirasi.index') }}" 
                               class="text-gray-500 hover:text-gray-700">
                                Batal
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>