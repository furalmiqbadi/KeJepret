<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KeJepret') â€” KeJepret</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <style type="text/tailwindcss">
        @theme {
            --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            --color-sky-500: #0ea5e9;
            --color-sky-600: #0284c7;
        }
        body {
            font-family: var(--font-sans);
            -webkit-font-smoothing: antialiased;
        }
        .clean-glass {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(32px) saturate(140%);
            -webkit-backdrop-filter: blur(32px) saturate(140%);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 30px 60px -15px rgba(15, 23, 42, 0.05), 0 0 0 1px rgba(255, 255, 255, 0.6) inset;
        }
        .clean-glass-input {
            background: rgba(248, 250, 252, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(15, 23, 42, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #1e293b;
        }
        .clean-glass-input::placeholder {
            color: #94a3b8;
        }
        .clean-glass-input:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.08);
        }
        .clean-glass-box {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(15, 23, 42, 0.06);
            color: #334155;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.72);
            backdrop-filter: blur(32px) saturate(140%);
            -webkit-backdrop-filter: blur(32px) saturate(140%);
            border: 1px solid rgba(255, 255, 255, 0.8);
            box-shadow: 0 30px 60px -15px rgba(15, 23, 42, 0.05), 0 0 0 1px rgba(255, 255, 255, 0.6) inset;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-card:hover {
            background: rgba(255, 255, 255, 0.85);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 40px 80px -15px rgba(99, 102, 241, 0.12), 0 0 0 1px rgba(255, 255, 255, 0.8) inset;
        }
        .glass-input {
            background: rgba(248, 250, 252, 0.6);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(15, 23, 42, 0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: #1e293b;
            outline: none;
        }
        .glass-input::placeholder {
            color: #94a3b8;
        }
        .glass-input:focus {
            background: rgba(255, 255, 255, 0.95);
            border-color: rgba(99, 102, 241, 0.4);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.08);
        }
        .glass-btn-blue {
            background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-btn-blue:hover {
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 50%, #4f46e5 100%);
            box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.4);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="bg-[#eef2f6] text-gray-900 min-h-screen relative">

    <!-- Neumorphic 3D Clean & Elegant Background Ornament -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        <!-- Ambient Soft Premium Glows -->
        <div class="absolute -top-[10%] -left-[10%] w-[60%] h-[60%] rounded-full bg-blue-400/8 blur-[130px]"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[65%] h-[65%] rounded-full bg-indigo-400/8 blur-[130px]"></div>
        
        <!-- Embossed 3D Curves SVG -->
        <svg class="absolute inset-0 w-full h-full opacity-65" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <!-- Neumorphic Drop Shadow Filter -->
                <filter id="neumorphic-shadow-1" x="-20%" y="-20%" width="140%" height="140%">
                    <feDropShadow dx="3" dy="4" stdDeviation="5" flood-color="#cbd5e1" flood-opacity="0.4"/>
                    <feDropShadow dx="-3" dy="-4" stdDeviation="5" flood-color="#ffffff" flood-opacity="0.9"/>
                </filter>
            </defs>

            <!-- Minimal Concentric Neumorphic Circles (Pojok Kanan Bawah - Sangat Elegan) -->
            <circle cx="100%" cy="100%" r="200" fill="none" stroke="#eef2f6" stroke-width="8" filter="url(#neumorphic-shadow-1)" />
            <circle cx="100%" cy="100%" r="350" fill="none" stroke="#eef2f6" stroke-width="12" filter="url(#neumorphic-shadow-1)" />
            <circle cx="100%" cy="100%" r="500" fill="none" stroke="#eef2f6" stroke-width="16" filter="url(#neumorphic-shadow-1)" />

            <!-- Minimal Concentric Neumorphic Circles (Pojok Kiri Atas - Sangat Tipis) -->
            <circle cx="0" cy="0" r="150" fill="none" stroke="#eef2f6" stroke-width="8" filter="url(#neumorphic-shadow-1)" />
            <circle cx="0" cy="0" r="280" fill="none" stroke="#eef2f6" stroke-width="12" filter="url(#neumorphic-shadow-1)" />

            <!-- 3D Parallel Curves (Grup 1 - Indah & Bersih) -->
            <path d="M-100 300 C 350 200, 450 600, 850 400 C 1250 200, 1450 800, 2100 700" 
                  fill="none" stroke="#eef2f6" stroke-width="20" stroke-linecap="round" filter="url(#neumorphic-shadow-1)" />
            <path d="M-100 340 C 350 240, 450 640, 850 440 C 1250 240, 1450 840, 2100 740" 
                  fill="none" stroke="#eef2f6" stroke-width="12" stroke-linecap="round" filter="url(#neumorphic-shadow-1)" />

            <!-- 3D Parallel Curves (Grup 2 - Bawah) -->
            <path d="M-50 850 C 450 650, 650 950, 1150 750 C 1650 550, 1850 1150, 2300 950" 
                  fill="none" stroke="#eef2f6" stroke-width="16" stroke-linecap="round" filter="url(#neumorphic-shadow-1)" />
            <path d="M-50 890 C 450 690, 650 990, 1150 790 C 1650 590, 1850 1190, 2300 990" 
                  fill="none" stroke="#eef2f6" stroke-width="10" stroke-linecap="round" filter="url(#neumorphic-shadow-1)" />
        </svg>
    </div>

    {{-- Top Navbar --}}
    @if(!isset($hideNav))
        @include('partials.navbar')
    @endif

    {{-- Main Content --}}
    <main class="relative z-10 {{ isset($hideNav) ? 'pt-0 pb-0' : 'pt-20 pb-24 md:pb-8' }}">
        @yield('content')
    </main>

    {{-- Bottom Navigation (Mobile) --}}
    @if(!isset($hideNav))
        @include('partials.bottom-nav')
    @endif

    <script>
        (() => {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
            const widgets = Array.from(document.querySelectorAll('[data-photographer-notification-widget]'));

            if (!widgets.length) {
                return;
            }

            const escapeHtml = (value) => String(value ?? '').replace(/[&<>'"]/g, (character) => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                "'": '&#39;',
                '"': '&quot;'
            })[character]);

            widgets.forEach((widget) => {
                if (window.getComputedStyle(widget).display === 'none') {
                    return;
                }
                const toggle = widget.querySelector('[data-notification-toggle]');
                const panel = widget.querySelector('[data-notification-panel]');
                const list = widget.querySelector('[data-notification-list]');
                const badge = widget.querySelector('[data-notification-badge]');
                const pageLabel = widget.querySelector('[data-notification-page]');
                const prevButton = widget.querySelector('[data-notification-prev]');
                const nextButton = widget.querySelector('[data-notification-next]');
                const closeButton = widget.querySelector('[data-notification-close]');
                const indexUrl = widget.dataset.indexUrl;
                const readUrlTemplate = widget.dataset.readUrlTemplate;
                const limit = Number(widget.dataset.limit || 8);
                let currentPage = 1;
                let currentUnread = Number(badge?.textContent?.trim() || 0) || 0;

                const setBadge = (count) => {
                    if (!badge) return;
                    badge.textContent = String(Math.min(count, 99));
                    badge.classList.toggle('hidden', count <= 0);
                };

                const setPanelVisible = (visible) => {
                    panel?.classList.toggle('hidden', !visible);
                };

                const renderEmpty = (message) => {
                    if (!list) return;
                    list.innerHTML = `<div class="p-5 text-center text-xs font-bold text-slate-400">${escapeHtml(message)}</div>`;
                };

                const renderItems = (items) => {
                    if (!list) return;

                    if (!items.length) {
                        renderEmpty('Belum ada notifikasi.');
                        return;
                    }

                    list.innerHTML = items.map((item) => `
                        <button type="button" data-notification-item="${item.id}" data-sales-url="${escapeHtml(item.sales_url)}" class="w-full text-left p-4 hover:bg-slate-50/90 transition flex gap-3 ${item.is_read ? 'bg-white/20' : 'bg-blue-50/70'}">
                            <div class="w-14 h-14 rounded-2xl overflow-hidden bg-slate-100 shrink-0 border border-white/60">
                                ${item.thumbnail_url ? `<img src="${escapeHtml(item.thumbnail_url)}" alt="${escapeHtml(item.filename)}" class="w-full h-full object-cover">` : '<div class="w-full h-full flex items-center justify-center text-slate-300"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>'}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-2">
                                    <div>
                                        <p class="text-sm font-black text-slate-900 leading-tight">${escapeHtml(item.title)}</p>
                                        <p class="text-[11px] text-slate-500 font-semibold mt-1 leading-snug">${escapeHtml(item.message)}</p>
                                    </div>
                                    ${item.is_read ? '' : '<span class="mt-1 w-2.5 h-2.5 rounded-full bg-blue-500 shrink-0"></span>'}
                                </div>
                                <div class="mt-3 flex items-center justify-between gap-3 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                    <span>${escapeHtml(item.category || 'Foto Event')} - ${escapeHtml(item.amount_formatted)}</span>
                                    <span>${escapeHtml(item.time_label)}</span>
                                </div>
                            </div>
                        </button>
                    `).join('');
                };

                const updatePagination = (meta) => {
                    if (pageLabel) pageLabel.textContent = String(meta.page || 1);
                    if (prevButton) prevButton.disabled = !meta.has_prev;
                    if (nextButton) nextButton.disabled = !meta.has_next;
                };

                const loadNotifications = async (targetPage = 1, autoOpen = false) => {
                    try {
                        const response = await fetch(`${indexUrl}?limit=${limit}&page=${targetPage}`, { headers: { 'Accept': 'application/json' } });
                        if (!response.ok) return;
                        const payload = await response.json();
                        const data = payload?.data || [];
                        const meta = payload?.meta || {};
                        const nextUnread = Number(meta.unread_count || 0);
                        const hasNew = currentUnread !== null && nextUnread > currentUnread;

                        currentUnread = nextUnread;
                        setBadge(nextUnread);
                        currentPage = meta.page || targetPage;
                        renderItems(data);
                        updatePagination(meta);

                        if ((autoOpen || hasNew) && nextUnread > 0) {
                            setPanelVisible(true);
                        }
                    } catch (error) {
                        renderEmpty('Gagal memuat notifikasi.');
                    }
                };

                const markReadAndGo = async (item) => {
                    try {
                        await fetch(readUrlTemplate.replace('__ID__', item.id), {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest',
                            },
                        });
                    } finally {
                        window.location.href = item.salesUrl;
                    }
                };

                toggle?.addEventListener('click', () => {
                    const willOpen = panel?.classList.contains('hidden');
                    setPanelVisible(willOpen);
                    if (willOpen) {
                        loadNotifications(currentPage || 1, true);
                    }
                });

                closeButton?.addEventListener('click', () => setPanelVisible(false));
                prevButton?.addEventListener('click', () => {
                    if (currentPage > 1) {
                        loadNotifications(currentPage - 1, true);
                    }
                });
                nextButton?.addEventListener('click', () => {
                    loadNotifications(currentPage + 1, true);
                });

                list?.addEventListener('click', (event) => {
                    const button = event.target.closest('[data-notification-item]');
                    if (!button) return;
                    markReadAndGo({
                        id: button.getAttribute('data-notification-item'),
                        salesUrl: button.getAttribute('data-sales-url'),
                    });
                });

                document.addEventListener('click', (event) => {
                    if (!widget.contains(event.target)) {
                        setPanelVisible(false);
                    }
                });

                loadNotifications(1, false);
                window.setInterval(() => loadNotifications(currentPage || 1, false), 15000);
            });
        })();
    </script>

</body>
</html>
