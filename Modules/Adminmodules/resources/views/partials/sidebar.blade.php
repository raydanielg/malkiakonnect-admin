<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidenav">
    <div class="overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-2 pb-4">
            <div class="text-lg font-extrabold tracking-tight text-gray-900 dark:text-white">Malkia Konnect</div>
            <div class="text-xs text-gray-500 dark:text-gray-400">Admin Panel</div>

            <div class="mt-4 rounded-xl bg-primary-600 text-white p-4">
                <div class="text-sm font-semibold break-all">{{ auth()->user()->email ?? 'admin@admin.com' }}</div>
                <div class="mt-1 text-xs text-primary-100">{{ (auth()->user()->role ?? 'module') === 'module' ? 'super-admin' : (auth()->user()->role ?? 'user') }}</div>
            </div>

            <div class="mt-3">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.414-1.414l3.387 3.387a1 1 0 01-1.414 1.414l-3.387-3.387zM14 8a6 6 0 11-12 0 6 6 0 0112 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <input type="text" placeholder="Search Here" class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                </div>
            </div>
        </div>

        <div class="px-2 pt-1 pb-2 text-[11px] font-bold tracking-widest text-gray-500 dark:text-gray-400">NAVIGATION</div>

        <ul class="space-y-1">
            <li>
                <a href="{{ url('/admin') }}" class="group flex items-center gap-3 px-2 py-2 text-sm font-medium {{ request()->is('admin') ? 'text-primary-700 dark:text-primary-300' : 'text-gray-700 dark:text-gray-200' }}">
                    <span class="material-symbols-outlined text-[20px] {{ request()->is('admin') ? 'text-primary-700 dark:text-primary-300' : 'text-gray-500 dark:text-gray-400' }}">dashboard</span>
                    <span>Overview</span>
                </a>
            </li>

            <li>
                <a href="#" class="group flex items-center gap-3 px-2 py-2 text-sm font-medium text-gray-700 dark:text-gray-200" aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages" data-collapse-link>
                    <span class="material-symbols-outlined text-[20px] text-gray-500 dark:text-gray-400">layers</span>
                    <span class="flex-1">Pages</span>
                    <span class="material-symbols-outlined text-[20px] text-gray-500 dark:text-gray-400 transition-transform" data-collapse-caret>expand_more</span>
                </a>
                <ul id="dropdown-pages" class="hidden mt-1 space-y-1">
                    <li>
                        <a href="{{ route('adminmodules.index') }}" class="flex items-center gap-3 pl-9 pr-2 py-2 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 dark:text-gray-500">view_module</span>
                            <span>Admin Modules</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 pl-9 pr-2 py-2 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                            <span class="material-symbols-outlined text-[18px] text-gray-400 dark:text-gray-500">account_circle</span>
                            <span>User Dashboard</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <form method="POST" action="{{ route('auth.logout') }}">
                    @csrf
                    <button type="submit" class="w-full group flex items-center gap-3 px-2 py-2 text-sm font-medium text-gray-700 dark:text-gray-200">
                        <span class="material-symbols-outlined text-[20px] text-gray-500 dark:text-gray-400">logout</span>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
