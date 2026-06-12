@extends('layouts.app')
@section('title', 'Ubah Profil')
@section('content')

@php 
    $user = auth()->user(); 
    if ($user && $user->role === 'admin') {
        $hideNav = true;
    }
@endphp

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-12 relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-1000">

    <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-1">Pengaturan Profil</h1>
            <p class="text-sm font-bold text-slate-500">Perbarui informasi pribadi dan kata sandi Anda</p>
        </div>
        <a href="{{ route('profil') }}" class="inline-flex items-center justify-center gap-2 bg-white/60 hover:bg-white text-slate-700 hover:text-blue-600 font-bold text-xs uppercase tracking-widest px-5 py-3 rounded-2xl border border-slate-200/60 hover:border-blue-200 transition-all shadow-sm">
            <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 border border-red-100 text-red-600 px-6 py-5 rounded-[1.5rem] mb-8 shadow-sm flex items-start gap-4 animate-in fade-in slide-in-from-top-4">
        <svg class="w-6 h-6 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>
            <p class="text-sm font-black mb-1.5 tracking-wide">Terdapat kesalahan:</p>
            <ul class="list-disc pl-5 text-sm font-semibold space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="glass-card rounded-[2.5rem] p-8 md:p-12 relative overflow-hidden shadow-2xl hover:shadow-blue-500/10 transition-all duration-500">
        {{-- Ambient decorative glow --}}
        <div class="absolute -top-32 -right-32 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col md:flex-row gap-10 items-start">
            
            {{-- Avatar Section --}}
            <div class="flex flex-col items-center gap-5 w-full md:w-auto">
                <div class="w-36 h-36 rounded-[2.5rem] bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center border-[6px] border-white shadow-[0_15px_35px_rgba(37,99,235,0.25)] relative group cursor-pointer overflow-hidden transition-transform duration-500 hover:scale-105" onclick="document.getElementById('profile_photo').click()">
                    @if($user->profile_face_url)
                        <img src="{{ $user->profile_face_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-6xl font-black text-white italic tracking-tighter">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    @endif
                    <div class="absolute inset-0 bg-slate-900/40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 backdrop-blur-[2px]">
                        <svg class="w-8 h-8 text-white mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="text-[9px] font-black text-white uppercase tracking-widest">Ubah Foto</span>
                    </div>
                </div>
                <div class="text-center">
                    <span class="inline-block bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-blue-100 shadow-sm">{{ $user->role === 'runner' ? 'Pelari' : ($user->role === 'admin' ? 'Administrator' : 'Fotografer') }}</span>
                </div>
            </div>

            {{-- Form Section --}}
            <div class="flex-1 w-full">
                <form action="{{ route('profil.update', [], false) }}" method="POST" enctype="multipart/form-data" class="space-y-7">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">
                        <div class="relative group">
                            <label for="name" class="block text-[11px] font-black text-slate-500 mb-2 uppercase tracking-widest group-focus-within:text-blue-600 transition-colors">Nama Lengkap</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </span>
                                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                       class="w-full bg-white/70 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 block pl-12 pr-4 py-4 transition-all shadow-sm outline-none placeholder:text-slate-300">
                            </div>
                        </div>

                        <div class="relative group opacity-80">
                            <label for="email" class="block text-[11px] font-black text-slate-500 mb-2 uppercase tracking-widest">Surel (Permanen)</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </span>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" disabled
                                       class="w-full bg-slate-100/50 border border-slate-200/50 text-slate-500 text-sm font-bold rounded-2xl block pl-12 pr-4 py-4 shadow-inner cursor-not-allowed">
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <label for="profile_photo" class="block text-[11px] font-black text-slate-500 mb-2 uppercase tracking-widest group-focus-within:text-blue-600 transition-colors">Foto Profil (Opsional)</label>
                        <div class="relative">
                            <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                                   class="w-full bg-white/70 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 block px-4 py-4 transition-all shadow-sm outline-none file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100 placeholder:text-slate-300">
                        </div>
                        <p class="mt-2 text-[10px] text-slate-400 font-medium">Format: JPG, PNG, WEBP. Maks 10MB.</p>
                    </div>

                    <div class="my-10 relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-slate-200/80"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white/90 backdrop-blur-md px-5 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-full border border-slate-200/80 py-1.5 shadow-sm">Ubah Kata Sandi (Opsional)</span>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div class="relative group">
                            <label for="password" class="block text-[11px] font-black text-slate-500 mb-2 uppercase tracking-widest group-focus-within:text-indigo-600 transition-colors">Kata Sandi Baru</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </span>
                                <input type="password" name="password" id="password" placeholder="Biarkan kosong jika tidak diubah"
                                       class="w-full bg-white/70 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-indigo-500/15 focus:border-indigo-500 block pl-12 pr-12 py-4 transition-all shadow-sm outline-none placeholder:text-slate-300">
                                <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 pr-4.5 flex items-center text-slate-400 hover:text-indigo-600 transition-colors focus:outline-none">
                                    <svg id="icon-password" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="relative group">
                            <label for="password_confirmation" class="block text-[11px] font-black text-slate-500 mb-2 uppercase tracking-widest group-focus-within:text-indigo-600 transition-colors">Konfirmasi Kata Sandi</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </span>
                                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi kata sandi baru"
                                       class="w-full bg-white/70 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-indigo-500/15 focus:border-indigo-500 block pl-12 pr-12 py-4 transition-all shadow-sm outline-none placeholder:text-slate-300">
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute inset-y-0 right-0 pr-4.5 flex items-center text-slate-400 hover:text-indigo-600 transition-colors focus:outline-none">
                                    <svg id="icon-password_confirmation" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8">
                        <button type="submit" class="w-full flex items-center justify-center gap-3 text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-700 hover:to-indigo-800 font-black rounded-2xl text-[11px] px-6 py-4.5 text-center uppercase tracking-[0.2em] shadow-xl shadow-blue-500/25 hover:shadow-blue-500/40 transition-all duration-300 hover:-translate-y-1 active:translate-y-0">
                            Simpan Perubahan
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById('icon-' + inputId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
        } else {
            input.type = 'password';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
        }
    }
</script>

@endsection
