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
                <div class="rounded-2xl border border-slate-200 bg-gradient-to-br from-white to-slate-50 p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <div class="text-sm font-semibold text-slate-500">Admin</div>
                            <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Statistics & Reports</h1>
                            <p class="mt-2 text-slate-600">Quick reports in short: users, tasks, and login trends.</p>
                        </div>
                        <a href="{{ route('admin.overview') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">
                            <span class="material-symbols-outlined">arrow_back</span>
                            Back to Overview
                        </a>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">Users</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($usersCount ?? 0) }}</div>
                                <div class="mt-1 text-xs text-slate-500">Total registered</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-primary-50 text-primary-700 flex items-center justify-center">
                                <span class="material-symbols-outlined">group</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">Admins</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($adminsCount ?? 0) }}</div>
                                <div class="mt-1 text-xs text-slate-500">System access</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                                <span class="material-symbols-outlined">admin_panel_settings</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">Completed</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($completedTasksCount ?? 0) }}</div>
                                <div class="mt-1 text-xs text-slate-500">Tasks done</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-700 flex items-center justify-center">
                                <span class="material-symbols-outlined">task_alt</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">Pending</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($pendingTasksCount ?? 0) }}</div>
                                <div class="mt-1 text-xs text-slate-500">Waiting action</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                                <span class="material-symbols-outlined">schedule</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <h2 class="text-base font-extrabold text-slate-900">Users Breakdown</h2>
                        <div class="mt-4 h-[260px]">
                            <canvas id="usersPie"></canvas>
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <h2 class="text-base font-extrabold text-slate-900">Tasks Status (Bar)</h2>
                        <div class="mt-4 h-[260px]">
                            <canvas id="tasksBar"></canvas>
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <h2 class="text-base font-extrabold text-slate-900">Logins Trend (7 Days)</h2>
                        <div class="mt-4 h-[260px]">
                            <canvas id="loginsLine"></canvas>
                        </div>
                    </section>
                </div>

                <div class="mt-6 bg-white rounded-2xl border border-slate-200 p-5">
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-extrabold text-slate-900">Short Report (Last 7 Days)</h2>
                        <div class="text-xs text-slate-500">Logins per day</div>
                    </div>

                    <div class="mt-4 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs uppercase text-slate-500 border-b border-slate-200">
                                <tr>
                                    <th class="text-left py-3 pr-4">Day</th>
                                    <th class="text-left py-3 pr-4">Logins</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse(($reportRows ?? []) as $row)
                                    <tr>
                                        <td class="py-3 pr-4 font-semibold text-slate-900">{{ $row['day'] }}</td>
                                        <td class="py-3 pr-4 text-slate-700">{{ number_format($row['logins'] ?? 0) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-6 text-slate-500" colspan="2">No report data yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <script>
            (function () {
                const usersCount = Number(@json($usersCount ?? 0));
                const adminsCount = Number(@json($adminsCount ?? 0));
                const completedTasksCount = Number(@json($completedTasksCount ?? 0));
                const pendingTasksCount = Number(@json($pendingTasksCount ?? 0));

                const loginLabels = @json($loginLabels ?? []);
                const loginSeries = @json($loginSeries ?? []);

                const usersPie = document.getElementById('usersPie');
                if (usersPie && window.Chart) {
                    new Chart(usersPie, {
                        type: 'doughnut',
                        data: {
                            labels: ['Admins', 'Users'],
                            datasets: [
                                {
                                    data: [adminsCount, Math.max(0, usersCount - adminsCount)],
                                    backgroundColor: ['#059669', '#16a34a'],
                                    borderWidth: 0,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { position: 'bottom' } },
                            cutout: '68%',
                        },
                    });
                }

                const tasksBar = document.getElementById('tasksBar');
                if (tasksBar && window.Chart) {
                    new Chart(tasksBar, {
                        type: 'bar',
                        data: {
                            labels: ['Completed', 'Pending'],
                            datasets: [
                                {
                                    label: 'Tasks',
                                    data: [completedTasksCount, pendingTasksCount],
                                    backgroundColor: ['#4f46e5', '#d97706'],
                                    borderRadius: 12,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { display: false } },
                            scales: {
                                y: { beginAtZero: true, grid: { color: 'rgba(148, 163, 184, 0.25)' } },
                                x: { grid: { display: false } },
                            },
                        },
                    });
                }

                const loginsLine = document.getElementById('loginsLine');
                if (loginsLine && window.Chart) {
                    new Chart(loginsLine, {
                        type: 'line',
                        data: {
                            labels: loginLabels,
                            datasets: [
                                {
                                    label: 'Logins',
                                    data: loginSeries,
                                    borderColor: '#047857',
                                    backgroundColor: 'rgba(16, 185, 129, 0.20)',
                                    fill: true,
                                    tension: 0.35,
                                    pointRadius: 4,
                                    pointBackgroundColor: '#047857',
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: { legend: { position: 'bottom' } },
                            scales: {
                                y: { beginAtZero: true, grid: { color: 'rgba(148, 163, 184, 0.25)' } },
                                x: { grid: { display: false } },
                            },
                        },
                    });
                }
            })();
        </script>
    </div>
</x-adminmodules::layouts.master>
