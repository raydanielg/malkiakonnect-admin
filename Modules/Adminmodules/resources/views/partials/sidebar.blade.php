<aside class="fixed inset-y-0 left-0 z-40 w-72 bg-emerald-900 text-emerald-50 flex flex-col lg:translate-x-0" data-sidebar>
    <div class="h-16 px-5 flex items-center justify-between border-b border-emerald-800">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center font-extrabold">M</div>
            <div>
                <div class="text-lg font-extrabold tracking-tight leading-none">Malkia Konnect</div>
                <div class="text-xs text-emerald-200/80">Admin Panel</div>
            </div>
        </div>
        <button type="button" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-emerald-800 text-emerald-100" data-sidebar-close>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    </div>

    <div class="px-5 py-4">
        <div class="rounded-2xl bg-emerald-600/90 p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20 21V19C20 17.9391 19.5786 16.9217 18.8284 16.1716C18.0783 15.4214 17.0609 15 16 15H8C6.93913 15 5.92172 15.4214 5.17157 16.1716C4.42143 16.9217 4 17.9391 4 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="min-w-0">
                    <div class="text-sm font-extrabold truncate">{{ auth()->user()->email ?? 'admin@admin.com' }}</div>
                    <div class="text-xs text-emerald-100/90">{{ (auth()->user()->role ?? 'module') === 'module' ? 'super-admin' : (auth()->user()->role ?? 'user') }}</div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-emerald-200/90">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21 21L16.65 16.65" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11 18C14.866 18 18 14.866 18 11C18 7.13401 14.866 4 11 4C7.13401 4 4 7.13401 4 11C4 14.866 7.13401 18 11 18Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <input type="text" placeholder="Search Here" class="w-full h-10 rounded-xl bg-white/10 border border-emerald-800 pl-10 pr-4 text-sm placeholder:text-emerald-200/70 outline-none focus:ring-2 focus:ring-white/20 focus:border-white/30" />
            </div>
        </div>
    </div>

    <nav class="px-3 pb-4 flex-1 overflow-y-auto">
        <div class="px-2 py-2 text-xs font-extrabold tracking-wider text-emerald-200/80">DASHBOARD</div>

        <a href="{{ url('/admin') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->is('admin') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-emerald-50' }}">
            <span class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 13H10V21H4V13Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 3H20V21H14V3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 9H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            <span class="font-semibold">Dashboard</span>
        </a>

        <a href="{{ route('adminmodules.index') }}" class="mt-1 flex items-center gap-3 px-3 py-2.5 rounded-xl transition {{ request()->is('adminmodules*') ? 'bg-white/10 text-white' : 'hover:bg-white/5 text-emerald-50' }}">
            <span class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 4H10V10H4V4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 4H20V10H14V4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M4 14H10V20H4V14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14 14H20V20H14V14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <span class="font-semibold">Admin Modules</span>
        </a>

        <div class="mt-4 px-2 py-2 text-xs font-extrabold tracking-wider text-emerald-200/80">MANAGEMENT</div>

        <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition hover:bg-white/5 text-emerald-50">
            <span class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 20H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M12 4H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M4 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M4 15H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    <path d="M10 12H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </span>
            <span class="font-semibold">User Dashboard</span>
        </a>
    </nav>

    <div class="px-4 py-4 border-t border-emerald-800">
        <form method="POST" action="{{ route('auth.logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 transition font-semibold">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 21H5A2 2 0 0 1 3 19V5A2 2 0 0 1 5 3H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 17L21 12L16 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M21 12H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>
