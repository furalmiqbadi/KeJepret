@php
    $variant = $variant ?? 'desktop';
    $isMobile = $variant === 'mobile';
    $limit = $isMobile ? 5 : 8;
    $widgetClass = $isMobile
        ? 'md:hidden fixed left-7 bottom-[6.25rem] z-[70]'
        : 'hidden md:block relative mr-3';
    $panelClass = $isMobile
        ? 'fixed top-4 left-4 right-4 max-h-[78vh]'
        : 'absolute right-0 top-16 w-[24rem] max-h-[34rem]';
@endphp

<div class="{{ $widgetClass }}" data-photographer-notification-widget data-limit="{{ $limit }}" data-index-url="{{ route('photographer.notifications', [], false) }}" data-read-url-template="{{ route('photographer.notifications.read', ['id' => '__ID__'], false) }}">
    <button type="button" data-notification-toggle class="relative w-12 h-12 rounded-[1.1rem] bg-white/85 border border-white shadow-lg shadow-slate-200/70 text-slate-600 hover:text-blue-600 hover:scale-105 transition-all duration-300 flex items-center justify-center">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.4-1.4A2 2 0 0118 14.17V11a6 6 0 10-12 0v3.17c0 .53-.21 1.04-.59 1.42L4 17h5m6 0a3 3 0 11-6 0m6 0H9"/>
        </svg>
        <span data-notification-badge class="{{ ($photographerNotificationUnreadCount ?? 0) > 0 ? '' : 'hidden' }} absolute -top-1.5 -right-1.5 min-w-5 h-5 px-1 rounded-full bg-red-500 text-white text-[10px] font-black flex items-center justify-center shadow-md shadow-red-300/60">
            {{ min((int) ($photographerNotificationUnreadCount ?? 0), 99) }}
        </span>
    </button>

    <div data-notification-panel class="hidden {{ $panelClass }} clean-glass rounded-[2rem] border border-white/80 shadow-[0_24px_70px_-20px_rgba(15,23,42,0.35)] overflow-hidden z-[120]">
        <div class="px-5 py-4 border-b border-slate-100/70 flex items-center justify-between bg-white/40">
            <div>
                <p class="text-[9px] font-black uppercase tracking-[0.2em] text-blue-600">Notifikasi</p>
                <h3 class="text-sm font-black text-slate-900 mt-0.5">Penjualan Foto</h3>
            </div>
            <button type="button" data-notification-close class="w-8 h-8 rounded-full bg-white/70 hover:bg-white text-slate-400 hover:text-slate-700 transition flex items-center justify-center">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <div data-notification-list class="max-h-[23rem] overflow-y-auto divide-y divide-slate-100/70 bg-white/30">
            <div class="p-5 text-center text-xs font-bold text-slate-400">Memuat notifikasi...</div>
        </div>

        <div class="px-4 py-3 bg-white/55 border-t border-slate-100/70 flex items-center justify-between gap-3">
            <button type="button" data-notification-prev class="px-3 py-2 rounded-xl bg-white/70 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-blue-600 disabled:opacity-35 disabled:cursor-not-allowed transition">← Terbaru</button>
            <span data-notification-page class="text-[10px] font-black text-slate-400">1</span>
            <button type="button" data-notification-next class="px-3 py-2 rounded-xl bg-white/70 text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-blue-600 disabled:opacity-35 disabled:cursor-not-allowed transition">Sebelumnya →</button>
        </div>
    </div>
</div>
