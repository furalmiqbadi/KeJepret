@extends('layouts.app')
@section('title', 'Portfolio Foto')
@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-12 relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-1000">

    <div class="mb-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 mb-2">FOTOGRAFER</p>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-1">Portfolio Foto</h1>
            <p class="text-sm font-bold text-slate-500">Kelola semua foto yang sudah kamu upload.</p>
        </div>
        <a href="{{ route('photographer.upload') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-black text-xs uppercase tracking-widest px-6 py-4 rounded-2xl shadow-xl shadow-blue-500/25 hover:shadow-blue-500/40 transition-all duration-300 hover:-translate-y-1">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Upload Baru
        </a>
    </div>

    {{-- SUCCESS TOAST --}}
    @if(session('success'))
    <div id="toast-success" class="bg-green-50 border border-green-100 text-green-600 px-6 py-5 rounded-[1.5rem] mb-8 shadow-sm flex items-start gap-4 animate-in fade-in slide-in-from-top-4 relative">
        <svg class="w-6 h-6 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="flex-1">
            <p class="text-sm font-black mb-1.5 tracking-wide">Berhasil!</p>
            <p class="text-xs font-bold text-green-700">{{ session('success') }}</p>
        </div>
        <button onclick="dismissToast('toast-success')" class="text-green-400 hover:text-green-700 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    @if($photos->isEmpty())
    <div class="glass-card rounded-[2.5rem] p-12 text-center relative overflow-hidden shadow-2xl">
        <div class="w-24 h-24 bg-blue-50 text-blue-300 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-inner">
            <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <p class="text-2xl font-black text-slate-800 tracking-tight">Belum ada foto</p>
        <p class="text-sm font-bold text-slate-500 mt-2">Mulai upload foto eventmu sekarang untuk dijual.</p>
        <a href="{{ route('photographer.upload') }}" class="inline-flex mt-6 px-8 py-4 bg-white border-2 border-slate-200 text-slate-700 rounded-2xl font-black text-xs uppercase tracking-widest hover:border-blue-500 hover:text-blue-600 transition-all shadow-sm">Upload Sekarang</a>
    </div>
    @else
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($photos as $photo)
        <div class="bg-white rounded-[1.5rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden hover:shadow-2xl hover:-translate-y-1 hover:border-blue-200 transition-all duration-300 group flex flex-col">

            {{-- Thumbnail --}}
            <div class="relative aspect-square overflow-hidden bg-slate-100">
                @if($photo->watermark_path)
                <img src="{{ env('AWS_URL') }}/{{ $photo->watermark_path }}" alt="Foto"
                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 {{ !$photo->is_active ? 'grayscale opacity-60' : '' }}">
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-10 h-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                @endif
                
                {{-- Overlay actions (Archive / Delete) --}}
                <div class="absolute z-10 inset-x-0 top-0 p-3 bg-gradient-to-b from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex justify-end gap-2">
                    <form action="{{ route('photographer.photos.archive.post', $photo->id, false) }}" method="POST" class="inline">
                        @csrf @method('PUT')
                        <button type="submit" title="{{ $photo->is_active ? 'Arsipkan' : 'Aktifkan' }}" class="bg-white/20 hover:bg-white text-white hover:text-blue-600 backdrop-blur-md p-2 rounded-full transition-all shadow-sm">
                            @if($photo->is_active)
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            @else
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            @endif
                        </button>
                    </form>
                    <form action="{{ route('photographer.photos.destroy.post', $photo->id, false) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus foto ini permanen?')">
                        @csrf @method('DELETE')
                        <button type="submit" title="Hapus Foto" class="bg-red-500/80 hover:bg-red-600 text-white backdrop-blur-md p-2 rounded-full transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>

                {{-- Embed Status Badge --}}
                <div class="absolute bottom-3 left-3 flex gap-2">
                    @if($photo->embed_status === 'embedded')
                    <span class="inline-flex items-center gap-1 bg-green-500/90 backdrop-blur-sm text-white text-[10px] uppercase tracking-wider font-black px-2.5 py-1 rounded-lg shadow-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Ready
                    </span>
                    @elseif($photo->embed_status === 'failed')
                    <span class="inline-flex items-center gap-1 bg-red-500/90 backdrop-blur-sm text-white text-[10px] uppercase tracking-wider font-black px-2.5 py-1 rounded-lg shadow-sm">
                        Failed
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1 bg-amber-400/90 backdrop-blur-sm text-white text-[10px] uppercase tracking-wider font-black px-2.5 py-1 rounded-lg shadow-sm">
                        <svg class="w-3 h-3 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Pending
                    </span>
                    @endif
                </div>

                {{-- Active Status --}}
                @if(!$photo->is_active)
                <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-[2px] flex items-center justify-center pointer-events-none">
                    <span class="bg-black/60 text-white text-[10px] uppercase tracking-widest font-black px-4 py-1.5 rounded-full backdrop-blur-md">Diarsipkan</span>
                </div>
                @endif
            </div>

            <div class="p-5 flex-1 flex flex-col">
                <div class="mb-4">
                    <p class="text-[11px] font-black text-blue-600 uppercase tracking-widest mb-1 truncate">{{ $photo->event->name ?? 'Tanpa Event' }}</p>
                    @if($photo->category)
                    <p class="text-xs font-bold text-slate-400">{{ $photo->category }}</p>
                    @endif
                </div>

                {{-- Update Harga --}}
                <div class="mt-auto">
                    <form action="{{ route('photographer.photos.price.post', $photo->id, false) }}" method="POST" class="relative group/price">
                        @csrf
                        @method('PUT')
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-xs font-black text-slate-400 pointer-events-none">Rp</span>
                        <input type="number" name="price" value="{{ $photo->price }}" min="5000" step="1000"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-8 pr-12 py-3 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 transition-all shadow-inner">
                        <button type="submit" class="absolute inset-y-1 right-1 px-3 bg-blue-600 text-white rounded-lg text-xs font-bold hover:bg-blue-700 transition shadow-sm opacity-0 group-hover/price:opacity-100 focus:opacity-100 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $photos->links() }}
    </div>
    @endif

</div>

<script>
    function dismissToast(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.style.opacity = '0';
        el.style.transform = 'translateY(-12px)';
        setTimeout(() => el.remove(), 400);
    }
    @if(session('success'))
    setTimeout(() => dismissToast('toast-success'), 5000);
    @endif
</script>

@endsection
