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
                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <div class="text-sm font-semibold text-slate-500">Maelezo ya Mfanyakazi</div>
                            <h1 class="mt-1 text-2xl font-extrabold text-slate-900">{{ $employee->full_name }}</h1>
                            <p class="mt-2 text-slate-600">Taarifa za mfanyakazi na hali yake.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.employees.logs', $employee) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Rekodi</a>
                            <a href="{{ route('admin.employees.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Rudi Kwa Wafanyakazi</a>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
                    <section class="xl:col-span-2 bg-white rounded-2xl border border-slate-200 p-5">
                        <h2 class="text-base font-extrabold text-slate-900">Taarifa</h2>
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="text-xs font-semibold text-slate-500">Kodi ya Mfanyakazi</div>
                                <div class="mt-1 font-extrabold text-slate-900">{{ $employee->employee_code ?? '-' }}</div>
                            </div>
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="text-xs font-semibold text-slate-500">Hali</div>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold {{ ($employee->status ?? 'active') === 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                                        {{ $employee->status ?? 'active' }}
                                    </span>
                                </div>
                            </div>
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="text-xs font-semibold text-slate-500">Barua pepe</div>
                                <div class="mt-1 font-extrabold text-slate-900">{{ $employee->email ?? '-' }}</div>
                            </div>
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="text-xs font-semibold text-slate-500">Simu</div>
                                <div class="mt-1 font-extrabold text-slate-900">{{ $employee->phone ?? '-' }}</div>
                            </div>
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="text-xs font-semibold text-slate-500">Cheo</div>
                                <div class="mt-1 font-extrabold text-slate-900">{{ $employee->position ?? '-' }}</div>
                            </div>
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="text-xs font-semibold text-slate-500">Tarehe ya Kuajiriwa</div>
                                <div class="mt-1 font-extrabold text-slate-900">{{ optional($employee->hired_at)->format('M d, Y') ?? '-' }}</div>
                            </div>
                            <div class="rounded-2xl border border-slate-200 p-4 sm:col-span-2">
                                <div class="text-xs font-semibold text-slate-500">Mtumiaji Aliyeunganishwa</div>
                                <div class="mt-1 font-extrabold text-slate-900">{{ $employee->user?->email ?? '-' }}</div>
                            </div>
                        </div>
                    </section>

                    <aside class="bg-white rounded-2xl border border-slate-200 p-5">
                        <h2 class="text-base font-extrabold text-slate-900">Vitendo</h2>
                        <div class="mt-4 space-y-2">
                            <a href="{{ route('admin.employees.logs', $employee) }}" class="w-full inline-flex items-center justify-center px-4 py-3 rounded-xl border border-slate-200 hover:bg-slate-50 text-slate-800 font-semibold transition">Angalia Rekodi</a>
                            <form method="POST" action="{{ route('admin.employees.destroy', $employee) }}" class="w-full" onsubmit="return confirm('Unataka kumfuta mfanyakazi huyu?');">
                                @csrf
                                @method('DELETE')
                                <button class="w-full inline-flex items-center justify-center px-4 py-3 rounded-xl bg-rose-600 hover:bg-rose-500 text-white font-semibold transition">Futa Mfanyakazi</button>
                            </form>
                        </div>
                    </aside>
                </div>

                @include('adminmodules::partials.footer')
            </main>
        </div>

        <script>
            (function () {
                function updateCarets() {
                    document.querySelectorAll('[data-collapse-link]').forEach(function (link) {
                        const targetId = link.getAttribute('data-collapse-toggle');
                        if (!targetId) return;
                        const target = document.getElementById(targetId);
                        const caret = link.querySelector('[data-collapse-caret]');
                        if (!target || !caret) return;
                        const expanded = !target.classList.contains('hidden');
                        caret.classList.toggle('rotate-180', expanded);
                    });
                }

                updateCarets();
                document.addEventListener('click', function (e) {
                    const link = e.target.closest && e.target.closest('[data-collapse-link]');
                    if (!link) return;
                    setTimeout(updateCarets, 0);
                });
            })();
        </script>
    </div>
</x-adminmodules::layouts.master>
