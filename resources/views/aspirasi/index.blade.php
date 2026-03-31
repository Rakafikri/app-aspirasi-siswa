<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Aspirasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Tombol Buat Laporan (Hanya Siswa) -->
                    @if(auth()->user()->role === 'siswa')
                    <div class="mb-4">
                        <a href="{{ route('aspirasi.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Buat Laporan Baru
                        </a>
                    </div>
                    @endif

                    <!-- Tabel List Aspirasi -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                @if(auth()->user()->role === 'admin')
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                                @endif
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($aspirasi as $index => $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                @if(auth()->user()->role === 'admin')
                                <td class="px-6 py-4 whitespace-nowrap">{{ $item->siswa->nis ?? '-' }}</td>
                                @endif
                                <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($item->kel, 50) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($item->status === 'Menunggu') bg-yellow-100 text-yellow-800
                                        @elseif($item->status === 'Proses') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800 @endif">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('aspirasi.show', $item->id_pelaporan) }}" 
                                       class="text-blue-600 hover:text-blue-900 mr-2">Lihat</a>
                                    @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('aspirasi.edit', $item->id_pelaporan) }}" 
                                       class="text-green-600 hover:text-green-900">Edit</a>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada aspirasi.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>