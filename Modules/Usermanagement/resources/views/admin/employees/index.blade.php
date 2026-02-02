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
                            <div class="text-sm font-semibold text-slate-500">User Management</div>
                            <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Employees</h1>
                            <p class="mt-2 text-slate-600">Employees directory and basic details.</p>
                        </div>

                        <form method="get" class="flex items-center gap-2">
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                                <input name="q" value="{{ $q ?? '' }}" placeholder="Search employee" class="pl-10 pr-4 py-2.5 w-72 rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300" />
                            </div>
                            <button class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Search</button>
                        </form>
                    </div>
                </div>

                <div class="mt-6 bg-white rounded-2xl border border-slate-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs uppercase text-slate-500 bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th class="text-left py-3 px-4">#</th>
                                    <th class="text-left py-3 px-4">Employee</th>
                                    <th class="text-left py-3 px-4">Code</th>
                                    <th class="text-left py-3 px-4">Email</th>
                                    <th class="text-left py-3 px-4">Phone</th>
                                    <th class="text-left py-3 px-4">Status</th>
                                    <th class="text-left py-3 px-4">Hired</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($employees as $employee)
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 px-4 font-semibold text-slate-900">{{ $employee->id }}</td>
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-slate-900">{{ $employee->full_name }}</div>
                                            <div class="text-xs text-slate-500">User: {{ $employee->user?->email ?? '-' }}</div>
                                        </td>
                                        <td class="py-3 px-4 text-slate-700">{{ $employee->employee_code ?? '-' }}</td>
                                        <td class="py-3 px-4 text-slate-700">{{ $employee->email ?? '-' }}</td>
                                        <td class="py-3 px-4 text-slate-700">{{ $employee->phone ?? '-' }}</td>
                                        <td class="py-3 px-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ ($employee->status ?? 'active') === 'active' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                                                {{ $employee->status ?? 'active' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-slate-600">{{ optional($employee->hired_at)->format('M d, Y') ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 px-4 text-slate-500">No employees found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4">
                        {{ $employees->links() }}
                    </div>
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
