<header class="sticky top-0 z-30 bg-white/80 backdrop-blur border-b border-slate-200">
    <div class="h-16 px-4 sm:px-6 flex items-center gap-3">
        <button type="button" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-slate-200 text-slate-700" data-sidebar-toggle>
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 7H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M4 12H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M4 17H20" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>

        <div class="flex-1">
            <div class="text-sm text-slate-500">Dashboard</div>
            <div class="text-lg font-semibold text-slate-900">Welcome back, {{ auth()->user()->name ?? auth()->user()->email }}</div>
        </div>

        <div class="hidden md:block w-[360px]">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11 18C14.866 18 18 14.866 18 11C18 7.13401 14.866 4 11 4C7.13401 4 4 7.13401 4 11C4 14.866 7.13401 18 11 18Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <input type="text" placeholder="Search..." class="w-full h-10 rounded-xl border border-slate-200 bg-white pl-10 pr-4 text-sm outline-none focus:ring-2 focus:ring-emerald-500/40 focus:border-emerald-500" />
            </div>
        </div>

        <div class="flex items-center gap-2">
            <button type="button" class="relative inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 text-slate-700">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 8C18 6.4087 17.3679 4.88258 16.2426 3.75736C15.1174 2.63214 13.5913 2 12 2C10.4087 2 8.88258 2.63214 7.75736 3.75736C6.63214 4.88258 6 6.4087 6 8C6 15 3 17 3 17H21C21 17 18 15 18 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M13.73 21C13.5542 21.3031 13.3019 21.5547 12.9982 21.7295C12.6946 21.9044 12.3504 21.9965 12 21.9965C11.6496 21.9965 11.3054 21.9044 11.0018 21.7295C10.6982 21.5547 10.4458 21.3031 10.27 21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="absolute -top-1 -right-1 w-5 h-5 rounded-full bg-rose-500 text-white text-[11px] leading-5 text-center">3</span>
            </button>

            <div class="flex items-center gap-2 pl-1">
                <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-semibold">
                    {{ strtoupper(substr(auth()->user()->name ?? auth()->user()->email ?? 'A', 0, 1)) }}
                </div>
                <div class="hidden sm:block">
                    <div class="text-sm font-semibold text-slate-900">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-xs text-slate-500">{{ auth()->user()->email ?? '' }}</div>
                </div>
            </div>
        </div>
    </div>
</header>
