@php
    $user    = auth()->user();
    $profile = $user->photographerProfile;
    $status  = $profile->verification_status ?? 'pending';
    if ($status === 'rejected') {
        $hideNav = true;
    }
@endphp
@extends('layouts.app')
@section('title', $status === 'rejected' ? 'Pendaftaran Ditolak' : 'Menunggu Verifikasi')
@section('content')

<style>
    .clean-glass {
        background: rgba(255, 255, 255, 0.72);
        backdrop-filter: blur(32px) saturate(140%);
        -webkit-backdrop-filter: blur(32px) saturate(140%);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 30px 60px -15px rgba(15, 23, 42, 0.05), 0 0 0 1px rgba(255, 255, 255, 0.6) inset;
    }
    .clean-glass-box {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(15, 23, 42, 0.06);
        color: #334155;
    }
</style>

<div class="max-w-xl mx-auto px-6 {{ $status === 'rejected' ? 'min-h-screen flex flex-col justify-center' : 'py-12 flex flex-col items-center' }} text-center relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-1000">

    <div class="clean-glass p-8 md:p-10 rounded-[2.5rem] w-full space-y-6 relative overflow-hidden">
        {{-- Modern Ambient Decorative Glow inside Card --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-sky-400/4 rounded-full blur-3xl pointer-events-none"></div>

        @if($status === 'verified')
        {{-- VERIFIED --}}
        <div class="mx-auto w-20 h-20 rounded-3xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center border border-emerald-500/20 shadow-inner mb-2">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        
        <div>
            <span class="inline-block bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-emerald-100 mb-4">Terverifikasi</span>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Akun Diaktifkan!</h1>
            <p class="text-slate-500 font-semibold text-xs leading-relaxed mt-2 max-w-sm mx-auto">
                Selamat! Akun fotografer kamu sudah diverifikasi. Kamu sekarang bisa mulai mengunggah foto acara.
            </p>
        </div>

        <div class="clean-glass-box rounded-2xl p-5 text-left space-y-4">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tahapan Verifikasi</p>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Pendaftaran Dikirim</p>
                        <p class="text-[10px] text-slate-400">Data pendaftaran telah diterima</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Ditinjau Admin</p>
                        <p class="text-[10px] text-slate-400">Proses evaluasi dokumen selesai</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Akun Diaktifkan</p>
                        <p class="text-[10px] text-slate-400">Akses penuh galeri fotografer aktif</p>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('photographer.portfolio') }}" class="w-full py-3.5 bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-md shadow-slate-300/40 hover:shadow-lg hover:shadow-slate-300/60 hover:-translate-y-0.5 active:translate-y-0 transition-all cursor-pointer flex items-center justify-center gap-2 mt-2">
            Mulai Unggah Foto
            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
        </a>

        @elseif($status === 'rejected')
        {{-- REJECTED --}}
        <div class="mx-auto w-20 h-20 rounded-3xl bg-red-500/10 text-red-600 flex items-center justify-center border border-red-500/20 shadow-inner mb-2">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        
        <div>
            <span class="inline-block bg-red-50 text-red-500 text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-red-100 mb-4">Ditolak</span>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Pendaftaran Ditolak</h1>
            <p class="text-slate-500 font-semibold text-xs leading-relaxed mt-2 max-w-sm mx-auto">
                Maaf, pendaftaran fotografer kamu tidak disetujui oleh admin KeJepret.
                @if($profile->rejection_reason)
                <span class="block mt-2 font-black text-red-600">Alasan: {{ $profile->rejection_reason }}</span>
                @endif
            </p>
        </div>

        <div class="clean-glass-box rounded-2xl p-5 text-left space-y-4">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tahapan Verifikasi</p>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Pendaftaran Dikirim</p>
                        <p class="text-[10px] text-slate-400">Data pendaftaran telah diterima</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Ditinjau Admin</p>
                        <p class="text-[10px] text-slate-400">Evaluasi dokumen tidak disetujui</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-slate-100 rounded-full flex items-center justify-center flex-shrink-0 border border-slate-200">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400">Akun Diaktifkan</p>
                        <p class="text-[10px] text-slate-400/60">Akses penuh galeri fotografer aktif</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="clean-glass-box rounded-2xl p-5 text-left space-y-3 mt-2">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Butuh Bantuan?</p>
            <div class="space-y-2">
                <textarea id="complaint-text" rows="3" class="w-full clean-glass-input rounded-xl p-3 text-xs focus:outline-none resize-none" placeholder="Tulis pertanyaan atau keluhan Anda di sini..."></textarea>
                <button onclick="sendToWhatsapp()" class="w-full py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white rounded-xl font-black text-[10px] uppercase tracking-widest transition-all shadow-sm active:scale-[0.98] cursor-pointer flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Kirim ke WhatsApp
                </button>
            </div>
        </div>

        <div class="mt-4">
            <form action="{{ route('logout') }}" method="POST" class="w-full">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 py-3.5 bg-white/40 hover:bg-white/75 border border-slate-350 hover:border-slate-400 text-slate-650 hover:text-slate-800 rounded-full font-black text-[10px] uppercase tracking-widest transition-all shadow-sm shadow-slate-200/40 hover:shadow active:scale-[0.98] cursor-pointer">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

        <script>
            function sendToWhatsapp() {
                const keluhan = document.getElementById('complaint-text').value.trim();
                if (!keluhan) {
                    alert('Silakan tulis pertanyaan atau keluhan Anda terlebih dahulu.');
                    return;
                }
                
                const name = "{{ $user->name }}";
                const email = "{{ $user->email }}";
                const status = "Ditolak";
                
                const message = `Halo Admin KeJepret, saya membutuhkan bantuan mengenai akun fotografer saya.

Detail Akun:
- Nama: ${name}
- Email: ${email}
- Status: ${status}

Pertanyaan/Keluhan:
${keluhan}`;

                const encodedMessage = encodeURIComponent(message);
                const whatsappUrl = `https://wa.me/6285319252270?text=${encodedMessage}`;
                
                window.open(whatsappUrl, '_blank');
            }
        </script>

        @else
        {{-- PENDING --}}
        <div class="mx-auto w-20 h-20 rounded-3xl bg-amber-500/10 text-amber-600 flex items-center justify-center border border-amber-500/20 shadow-inner mb-2 relative">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="absolute -top-1 -right-1 flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-amber-500"></span>
            </span>
        </div>
        
        <div>
            <span class="inline-block bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-amber-100 mb-4 animate-pulse">Menunggu Verifikasi</span>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Sedang Diproses</h1>
            <p class="text-slate-500 font-semibold text-xs leading-relaxed mt-2 max-w-sm mx-auto">
                Pendaftaran fotografer kamu sedang ditinjau oleh admin KeJepret.
                Proses verifikasi membutuhkan waktu maksimal <span class="font-black text-indigo-650">1x24 jam</span>.
            </p>
        </div>

        <div class="clean-glass-box rounded-2xl p-5 text-left space-y-4">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tahapan Verifikasi</p>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Pendaftaran Dikirim</p>
                        <p class="text-[10px] text-slate-400">Data pendaftaran telah diterima</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-amber-500 rounded-full flex items-center justify-center flex-shrink-0 animate-pulse">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Ditinjau Admin</p>
                        <p class="text-[10px] text-slate-400">Sedang dalam proses peninjauan berkas</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-slate-100 rounded-full flex items-center justify-center flex-shrink-0 border border-slate-200">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400">Akun Diaktifkan</p>
                        <p class="text-[10px] text-slate-400/60">Akses penuh galeri fotografer aktif</p>
                    </div>
                </div>
            </div>
        </div>



        @endif

    </div>

    <p class="text-center text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em] mt-8">
        &copy; 2026 KEJEPRET STUDIO
    </p>

</div>
@endsection