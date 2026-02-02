<aside class="fixed inset-y-0 left-0 z-40 w-72 bg-emerald-900 text-emerald-50 flex flex-col lg:translate-x-0" data-sidebar>
    <div class="h-16 px-5 flex items-center justify-between border-b border-emerald-800">
        <div>
            <div class="text-lg font-extrabold tracking-tight">Malkia Konnect</div>
            <div class="text-xs text-emerald-200/80">Admin Panel</div>
        </div>
        <button type="button" class="lg:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-emerald-800 text-emerald-100" data-sidebar-close>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <path d="M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
    </div>

    <div class="px-5 py-4">
        <div class="text-xs font-semibold tracking-wider text-emerald-200/70">NAVIGATION</div>
    </div>

    <nav class="px-3 pb-4 flex-1 overflow-y-auto">
        <a href="{{ url('/admin') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl bg-emerald-800/70 hover:bg-emerald-800 transition">
            <span class="w-9 h-9 rounded-lg bg-emerald-700 flex items-center justify-center">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 12L12 3L21 12V20A1 1 0 0 1 20 21H4A1 1 0 0 1 3 20V12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 21V12H15V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <span class="font-semibold">Dashboard</span>
        </a>

        <div class="mt-2 space-y-1">
            <a href="{{ route('adminmodules.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-800/60 transition">
                <span class="w-9 h-9 rounded-lg bg-emerald-800/60 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4H10V10H4V4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 4H20V10H14V4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4 14H10V20H4V14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M14 14H20V20H14V14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <span class="font-medium">Admin Modules</span>
            </a>

            <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-emerald-800/60 transition">
                <span class="w-9 h-9 rounded-lg bg-emerald-800/60 flex items-center justify-center">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 20H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M12 4H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M4 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M4 15H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <path d="M10 12H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="font-medium">User Dashboard</span>
            </a>
        </div>
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
