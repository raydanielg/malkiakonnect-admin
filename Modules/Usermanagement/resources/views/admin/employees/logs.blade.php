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
                            <div class="text-sm font-semibold text-slate-500">Logs</div>
                            <h1 class="mt-1 text-2xl font-extrabold text-slate-900">{{ $employee->full_name }}</h1>
                            <p class="mt-2 text-slate-600">Login history and recent activities (linked user).</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.employees.show', $employee) }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Details</a>
                            <a href="{{ route('admin.employees.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Back to Employees</a>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 xl:grid-cols-2 gap-4">
                    <section class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-200">
                            <h2 class="text-base font-extrabold text-slate-900">Login Logs</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="text-xs uppercase text-slate-500 bg-slate-50 border-b border-slate-200">
                                    <tr>
                                        <th class="text-left py-3 px-4">Time</th>
                                        <th class="text-left py-3 px-4">IP</th>
                                        <th class="text-left py-3 px-4">User Agent</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($loginLogs as $log)
                                        <tr class="hover:bg-slate-50">
                                            <td class="py-3 px-4 font-semibold text-slate-900">{{ optional($log->logged_in_at)->format('M d, Y H:i') }}</td>
                                            <td class="py-3 px-4 text-slate-700">{{ $log->ip_address ?? '-' }}</td>
                                            <td class="py-3 px-4 text-slate-600">{{ $log->user_agent ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-8 px-4 text-slate-500">No login logs.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4">{{ $loginLogs->links() }}</div>
                    </section>

                    <section class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-200">
                            <h2 class="text-base font-extrabold text-slate-900">Activity Logs</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm">
                                <thead class="text-xs uppercase text-slate-500 bg-slate-50 border-b border-slate-200">
                                    <tr>
                                        <th class="text-left py-3 px-4">Time</th>
                                        <th class="text-left py-3 px-4">Action</th>
                                        <th class="text-left py-3 px-4">Meta</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @forelse($activityLogs as $activity)
                                        <tr class="hover:bg-slate-50">
                                            <td class="py-3 px-4 font-semibold text-slate-900">{{ optional($activity->created_at)->format('M d, Y H:i') }}</td>
                                            <td class="py-3 px-4 text-slate-700">{{ $activity->action }}</td>
                                            <td class="py-3 px-4 text-slate-600">{{ is_array($activity->meta) ? json_encode($activity->meta) : ($activity->meta ?? '-') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="py-8 px-4 text-slate-500">No activity logs.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4">{{ $activityLogs->links() }}</div>
                    </section>
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
