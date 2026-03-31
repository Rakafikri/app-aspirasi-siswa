<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Status Aspirasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Tombol Kembali -->
                    <div class="mb-4">
                        <a href="{{ route('aspirasi.show', ['id' => $aspirasi->id_aspirasi]) }}" 
                           class="text-blue-600 hover:text-blue-900">
                            ← Kembali ke Detail Aspirasi
                        </a>
                    </div>

                    <!-- Info Aspirasi -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-4">
                        <h4 class="font-semibold mb-2">Aspirasi #{{ $aspirasi->id_aspirasi }}</h4>
                        <p class="text-gray-600">{{ $aspirasi->kel }}</p>
                        <p class="text-sm text-gray-500 mt-1">
                            Pelapor: {{ $aspirasi->user->name ?? '-' }} | 
                            Tanggal: {{ $aspirasi->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>

                    <!-- Form Update -->
                    <form action="{{ route('aspirasi.update', ['id' => $aspirasi->id_aspirasi]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Status
                            </label>
                            <select name="status" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('status') border-red-500 @enderror">
                                <option value="Menunggu" {{ $aspirasi->status === 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Proses" {{ $aspirasi->status === 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Selesai" {{ $aspirasi->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                Feedback / Tanggapan
                            </label>
                            <textarea name="feedback" rows="4" 
                                      class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('feedback') border-red-500 @enderror"
                                      placeholder="Berikan tanggapan atau update untuk aspirasi ini...">{{ old('feedback', $aspirasi->feedback) }}</textarea>
                            @error('feedback')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Aspirasi
                            </button>
                            <a href="{{ route('aspirasi.show', ['id' => $aspirasi->id_aspirasi]) }}" 
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