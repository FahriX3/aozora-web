<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - Aozora Nihongo Club</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Be Vietnam Pro', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-surface-container-low min-h-screen flex items-center justify-center p-4">
    <div class="bg-surface-container-lowest w-full max-w-md rounded-2xl shadow-xl overflow-hidden">
        <div class="bg-primary p-6 text-center">
            <span class="material-symbols-outlined text-on-primary text-5xl mb-2">cyclone</span>
            <h2 class="text-2xl font-bold text-on-primary font-headline-md tracking-tight">Portal Admin Aozora</h2>
            <p class="text-on-primary-container text-sm mt-1">Masuk untuk mengelola event & dokumentasi.</p>
        </div>
        
        <div class="p-8">
            <form action="{{ route('login.post') }}" method="POST" class="flex flex-col gap-5">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-error-container text-on-error-container p-3 rounded-lg text-sm">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm font-semibold text-on-surface">Email Administrator</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">mail</span>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                            placeholder="admin@aozora.local">
                    </div>
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password" class="text-sm font-semibold text-on-surface">Kata Sandi</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline">lock</span>
                        <input type="password" name="password" id="password" required
                            class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-outline-variant bg-surface-container-lowest text-on-surface focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors"
                            placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="mt-2 w-full py-3 px-4 bg-primary hover:bg-primary-container text-on-primary font-bold rounded-lg transition-colors flex items-center justify-center gap-2">
                    Masuk ke Dashboard
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
                
                <a href="{{ route('home') }}" class="text-center text-sm font-semibold text-primary mt-4 hover:underline">
                    &larr; Kembali ke Beranda
                </a>
            </form>
        </div>
    </div>
</body>
</html>
