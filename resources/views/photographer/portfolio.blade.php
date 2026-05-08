@extends('layouts.app')
@section('title', 'Portfolio Foto')
@section('content')

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-8">

    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">FOTOGRAFER</p>
            <h1 class="text-3xl font-black text-gray-900">Portfolio Foto</h1>
            <p class="text-gray-500 text-sm mt-1">Kelola semua foto yang sudah kamu upload.</p>
        </div>
        <a href="{{ route('photographer.upload') }}" class="flex items-center gap-2 px-5 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Upload Foto
        </a>
    </div>

    @if(session('success'))
    <div class="flex items-start gap-3 bg-green-50 border border-green-100 text-green-700 rounded-2xl px-5 py-4 mb-6">
        <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        <p class="text-sm font-bold">{{ session('success') }}</p>
    </div>
    @endif

    @if($photos->isEmpty())
    <div class="text-center py-24">
        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        <p class="font-black text-gray-400 text-lg">Belum ada foto</p>
        <p class="text-gray-400 text-sm mt-1">Mulai upload foto eventmu sekarang.</p>
        <a href="{{ route('photographer.upload') }}" class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition">Upload Sekarang</a>
    </div>
    @else
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @foreach($photos as $photo)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md hover:border-blue-200 transition-all group">

            {{-- Thumbnail --}}
            <div class="relative aspect-square overflow-hidden bg-gray-100">
                @if($photo->watermark_path)
                <img src="{{ env('AWS_URL') }}/{{ $photo->watermark_path }}" alt="Foto"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                @endif

                {{-- Embed Status Badge --}}
                <div class="absolute top-2 left-2">
                    @if($photo->embed_status === 'embedded')
                    <span class="inline-block bg-green-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">AI Ready</span>
                    @elseif($photo->embed_status === 'failed')
                    <span class="inline-block bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">Failed</span>
                    @else
                    <span class="inline-block bg-yellow-400 text-white text-[10px] font-black px-2 py-0.5 rounded-full">Pending</span>
                    @endif
                </div>

                {{-- Active Status --}}
                @if(!$photo->is_active)
                <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                    <span class="text-white text-xs font-black">Dinonaktifkan</span>
                </div>
                @endif
            </div>

            {{-- Info --}}
            <div class="p-3 space-y-1">
                <p class="text-xs font-bold text-gray-500 truncate">{{ $photo->event->name ?? 'Tanpa Event' }}</p>
                @if($photo->category)
                <p class="text-[11px] text-gray-400">{{ $photo->category }}</p>
                @endif
            </div>

            {{-- Update Harga --}}
            <div class="px-3 pb-3">
                <form action="{{ route('photographer.photos.price.post', $photo->id) }}" method="POST" class="flex gap-2">
                    @csrf
                    @method('PUT')
                    <input type="number" name="price" value="{{ $photo->price }}" min="5000" step="1000"
                        class="flex-1 min-w-0 bg-slate-50 border border-slate-100 rounded-xl px-3 py-2 text-xs font-bold text-gray-900 outline-none focus:ring-2 focus:ring-blue-100">
                    <button type="submit" class="px-3 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $photos->links() }}
    </div>
    @endif

</div>
@endsection
