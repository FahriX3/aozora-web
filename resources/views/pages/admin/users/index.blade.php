@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="max-w-[1280px] mx-auto px-margin-mobile md:px-margin py-space-lg">
    <div class="flex justify-between items-center mb-space-md">
        <h1 class="text-headline-md font-bold text-indigo-night">Manajemen Pengguna</h1>
        <a href="{{ route('admin.users.create') }}" class="px-space-md py-2 bg-primary text-cloud-white rounded-lg hover:bg-indigo-night transition-colors">
            + Tambah Pengguna
        </a>
    </div>

    @if(session('success'))
        <div class="bg-primary-container/50 text-on-primary-container p-4 rounded-xl mb-space-md font-medium border border-primary/20">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-error-container/50 text-on-error-container p-4 rounded-xl mb-space-md font-medium border border-error/20">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-surface-container-lowest rounded-2xl shadow-sm border border-outline-variant overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[800px]">
                <thead>
                    <tr class="bg-surface-container-low text-secondary text-label-md uppercase tracking-wider">
                        <th class="p-4 border-b border-outline-variant font-semibold">Profil</th>
                        <th class="p-4 border-b border-outline-variant font-semibold">Detail Pengguna</th>
                        <th class="p-4 border-b border-outline-variant font-semibold">Peran</th>
                        <th class="p-4 border-b border-outline-variant font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant">
                    @foreach($users as $user)
                    <tr class="hover:bg-surface-container-low/30 transition-colors group">
                        <td class="p-4 w-24">
                            <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-on-primary font-bold text-lg shadow-sm uppercase">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="font-bold text-indigo-night text-base mb-1">{{ $user->name }}</div>
                            <div class="flex items-center gap-2">
                                <span class="text-xs text-secondary font-medium">{{ $user->email }}</span>
                            </div>
                        </td>
                        <td class="p-4">
                            @if($user->email === 'admin@aozora.local')
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide bg-sakura-tint text-torii-vermilion">
                                Super Admin
                            </span>
                            @else
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide bg-primary/10 text-primary">
                                Admin
                            </span>
                            @endif
                        </td>
                        <td class="p-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="w-8 h-8 rounded-lg bg-surface-container text-secondary hover:bg-primary hover:text-on-primary flex items-center justify-center transition-colors">
                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                </a>
                                @if($user->email !== 'admin@aozora.local')
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-surface-container text-secondary hover:bg-error-container hover:text-error flex items-center justify-center transition-colors">
                                        <span class="material-symbols-outlined text-[18px]">delete</span>
                                    </button>
                                </form>
                                @else
                                <button disabled class="w-8 h-8 rounded-lg bg-surface-container text-secondary opacity-50 flex items-center justify-center cursor-not-allowed" title="Super Admin tidak dapat dihapus">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
