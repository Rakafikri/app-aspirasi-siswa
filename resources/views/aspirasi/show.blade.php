<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Aspirasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Tombol Kembali -->
                    <div class="mb-4">
                        <a href="{{ route('aspirasi.index') }}" 
                           class="text-blue-600 hover:text-blue-900">
                            ← Kembali ke Daftar Aspirasi
                        </a>
                    </div>

                    <!-- Informasi Aspirasi -->
                    <div class="border rounded-lg p-4 mb-4">
                        <h3 class="text-lg font-semibold mb-3">Informasi Aspirasi</h3>
                        <table class="min-w-full">
                            <tr>
                                <td class="py-2 font-medium w-32">ID Aspirasi</td>
                                <td class="py-2">: #{{ $aspirasi->id_pelaporan }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium">Pelapor</td>
                                <td class="py-2">: {{ $aspirasi->siswa->nis ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium">Kategori</td>
                                <td class="py-2">: {{ $aspirasi->kategori->ket_kategori ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium">Lokasi</td>
                                <td class="py-2">: {{ $aspirasi->lokasi }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium">Tanggal</td>
                                <td class="py-2">: {{ $aspirasi->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            <tr>
                                <td class="py-2 font-medium">Status</td>
                                <td class="py-2">: 
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($aspirasi->status === 'Menunggu') bg-yellow-100 text-yellow-800
                                        @elseif($aspirasi->status === 'Proses') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ $aspirasi->status }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- Pesan Aspirasi -->
                    <div class="border rounded-lg p-4 mb-4">
                        <h3 class="text-lg font-semibold mb-3">Pesan Aspirasi</h3>
                        <div class="bg-gray-50 p-3 rounded">
                            {{ $aspirasi->kel }}
                        </div>
                    </div>

                    <!-- Tanggapan Admin (Feedback) -->
                    <div class="border rounded-lg p-4">
                        <h3 class="text-lg font-semibold mb-3">Tanggapan Admin</h3>
                        @if($aspirasi->feedback)
                        <div class="bg-blue-50 p-3 rounded">
                            {{ $aspirasi->feedback }}
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            Ditanggapi pada: {{ $aspirasi->updated_at->format('d M Y, H:i') }}
                        </p>
                        @else
                        <div class="bg-gray-100 p-3 rounded text-gray-500">
                            Belum ada tanggapan dari admin.
                        </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>