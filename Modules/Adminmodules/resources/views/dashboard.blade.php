<x-adminmodules::layouts.master>
    <div class="min-h-screen bg-slate-50">
        @include('adminmodules::partials.sidebar')

        <div class="sm:ml-64">
            <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                </svg>
            </button>

            @include('adminmodules::partials.header')

            <main class="px-4 sm:px-6 py-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">Total Users</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">24</div>
                                <div class="mt-1 text-xs text-slate-500">+2 this month</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 21V19C16 17.9391 15.5786 16.9217 14.8284 16.1716C14.0783 15.4214 13.0609 15 12 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8.5 11C10.7091 11 12.5 9.20914 12.5 7C12.5 4.79086 10.7091 3 8.5 3C6.29086 3 4.5 4.79086 4.5 7C4.5 9.20914 6.29086 11 8.5 11Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M23 21V19C22.9993 18.1137 22.7044 17.2528 22.1614 16.5523C21.6184 15.8519 20.8581 15.3516 20 15.13" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 3.13C16.8604 3.3503 17.623 3.8507 18.1676 4.55231C18.7122 5.25392 19.0078 6.11683 19.0078 7.005C19.0078 7.89317 18.7122 8.75608 18.1676 9.45769C17.623 10.1593 16.8604 10.6597 16 10.88" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">Completed Tasks</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">18</div>
                                <div class="mt-1 text-xs text-slate-500">75% completion</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12L11 14L15 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">Pending</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">6</div>
                                <div class="mt-1 text-xs text-slate-500">25% remaining</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 8V12L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">System Health</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">85%</div>
                                <div class="mt-1 text-xs text-slate-500">+5% improvement</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-fuchsia-50 text-fuchsia-700 flex items-center justify-center">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
                    <section class="xl:col-span-2 bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-extrabold text-slate-900">Recent Activity</h2>
                            <a href="#" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">View all</a>
                        </div>

                        <div class="mt-4 divide-y divide-slate-100">
                            <div class="py-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M20 21V5A2 2 0 0 0 18 3H6A2 2 0 0 0 4 5V21" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M9 7H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M9 11H15" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M9 15H13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-slate-900">New module configuration</div>
                                    <div class="text-xs text-slate-500">Updated on {{ now()->format('M d, Y') }}</div>
                                </div>
                                <div class="text-sm font-bold text-emerald-700">92%</div>
                            </div>

                            <div class="py-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 20H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M12 4H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M4 9H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M4 15H8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M10 12H21" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-slate-900">Login redirects enabled</div>
                                    <div class="text-xs text-slate-500">Role-based routing is active</div>
                                </div>
                                <div class="text-sm font-bold text-blue-700">88%</div>
                            </div>

                            <div class="py-4 flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 8V12L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="font-semibold text-slate-900">Pending review</div>
                                    <div class="text-xs text-slate-500">3 items in progress</div>
                                </div>
                                <div class="text-sm font-bold text-amber-700">45%</div>
                            </div>
                        </div>
                    </section>

                    <aside class="bg-white rounded-2xl border border-slate-200 p-5">
                        <h2 class="text-base font-extrabold text-slate-900">Quick Actions</h2>
                        <div class="mt-4 space-y-2">
                            <a href="{{ route('adminmodules.create') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">
                                <span class="text-lg leading-none">+</span>
                                Create Module
                            </a>
                            <a href="{{ route('adminmodules.index') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-800 font-semibold transition">
                                View Modules
                            </a>
                            <a href="#" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-800 font-semibold transition">
                                Settings
                            </a>
                        </div>
                    </aside>
                </div>

                @include('adminmodules::partials.footer')
            </main>
        </div>
    </div>
</x-adminmodules::layouts.master>
