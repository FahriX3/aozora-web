@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="max-w-3xl mx-auto px-margin-mobile md:px-margin py-space-lg">
    <div class="flex items-center gap-2 mb-space-md">
        <a href="{{ route('admin.users.index') }}" class="text-secondary hover:text-primary">&larr; Kembali</a>
        <h1 class="text-headline-md font-bold text-indigo-night ml-4">Tambah Pengguna Baru</h1>
    </div>

    @if ($errors->any())
        <div class="bg-torii-vermilion/20 text-torii-vermilion p-4 rounded-lg mb-space-md">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-cloud-white rounded-2xl shadow-md p-space-lg border border-outline-variant">
        <form action="{{ route('admin.users.store') }}" method="POST" class="flex flex-col gap-space-md">
            @csrf
            
            <div class="flex flex-col gap-1">
                <label class="font-bold text-indigo-night">Nama Pengguna *</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-primary transition-all">
            </div>

            <div class="flex flex-col gap-1">
                <label class="font-bold text-indigo-night">Alamat Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-primary transition-all">
            </div>

            <div class="flex flex-col gap-1">
                <label class="font-bold text-indigo-night">Password *</label>
                <input type="password" name="password" required class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-primary transition-all">
                <span class="text-xs text-secondary mt-1">Minimal 8 karakter.</span>
            </div>

            <div class="flex flex-col gap-1">
                <label class="font-bold text-indigo-night">Konfirmasi Password *</label>
                <input type="password" name="password_confirmation" required class="p-3 border border-outline-variant bg-surface-container-lowest rounded-xl focus:outline-primary transition-all">
            </div>

            <div class="pt-space-md flex justify-end">
                <button type="submit" class="px-space-lg py-3 bg-primary text-cloud-white rounded-lg font-bold hover:bg-indigo-night transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-[20px]">save</span> Simpan Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
