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
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-4">
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
                                <div class="text-xs font-semibold text-slate-500">Completed Tasks</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($completedTasksCount ?? 0) }}</div>
                                <div class="mt-1 text-xs text-slate-500">Done</div>
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
                                <div class="mt-1 text-xs text-slate-500">Awaiting action</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                                <span class="material-symbols-outlined">schedule</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">System Health</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">{{ (int) ($systemHealth ?? 0) }}%</div>
                                <div class="mt-1 text-xs text-slate-500">Based on tasks</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-fuchsia-50 text-fuchsia-700 flex items-center justify-center">
                                <span class="material-symbols-outlined">bolt</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <h2 class="text-base font-extrabold text-slate-900">Users (Pie)</h2>
                        <div class="mt-4 h-[240px]">
                            <canvas id="usersPie"></canvas>
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <h2 class="text-base font-extrabold text-slate-900">Tasks (Pie)</h2>
                        <div class="mt-4 h-[240px]">
                            <canvas id="tasksPie"></canvas>
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-extrabold text-slate-900">Calendar</h2>
                            <div class="text-xs text-slate-500">Task due dates</div>
                        </div>
                        <div class="mt-4 rounded-2xl border border-slate-200 bg-white p-3 shadow-sm" id="adminCalendar"></div>
                    </section>
                </div>

                <div class="mt-6 grid grid-cols-1 xl:grid-cols-2 gap-4">
                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <h2 class="text-base font-extrabold text-slate-900">Recent Activities</h2>
                        <div class="mt-4 divide-y divide-slate-100">
                            @forelse(($recentActivities ?? []) as $activity)
                                <div class="py-3 flex items-center justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="font-semibold text-slate-900 truncate">{{ $activity->action }}</div>
                                        <div class="text-xs text-slate-500 truncate">
                                            {{ $activity->user?->email ?? 'System' }}
                                            <span class="mx-1">•</span>
                                            {{ optional($activity->created_at)->format('M d, Y H:i') }}
                                        </div>
                                    </div>
                                    <div class="text-slate-400">
                                        <span class="material-symbols-outlined">history</span>
                                    </div>
                                </div>
                            @empty
                                <div class="py-6 text-sm text-slate-500">No activity yet.</div>
                            @endforelse
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <h2 class="text-base font-extrabold text-slate-900">Last Logins</h2>
                        <div class="mt-4 divide-y divide-slate-100">
                            @forelse(($lastLogins ?? []) as $login)
                                <div class="py-3 flex items-center justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="font-semibold text-slate-900 truncate">{{ $login->user?->email ?? '-' }}</div>
                                        <div class="text-xs text-slate-500 truncate">
                                            {{ optional($login->logged_in_at)->format('M d, Y H:i') }}
                                            <span class="mx-1">•</span>
                                            {{ $login->ip_address ?? '-' }}
                                        </div>
                                    </div>
                                    <div class="text-slate-400">
                                        <span class="material-symbols-outlined">login</span>
                                    </div>
                                </div>
                            @empty
                                <div class="py-6 text-sm text-slate-500">No logins recorded yet.</div>
                            @endforelse
                        </div>
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

        <style>
            #adminCalendar .fc {
                --fc-border-color: #e2e8f0;
                --fc-page-bg-color: transparent;
                --fc-today-bg-color: rgba(16, 185, 129, 0.10);
                --fc-neutral-bg-color: transparent;
                --fc-event-bg-color: #059669;
                --fc-event-border-color: #059669;
                --fc-event-text-color: #ffffff;
                font-size: 0.875rem;
            }

            #adminCalendar .fc .fc-toolbar-title {
                font-size: 1rem;
                font-weight: 800;
                color: #0f172a;
            }

            #adminCalendar .fc .fc-button {
                background: #ffffff;
                border: 1px solid #e2e8f0;
                color: #0f172a;
                border-radius: 0.75rem;
                padding: 0.45rem 0.75rem;
                font-weight: 700;
                box-shadow: 0 1px 0 rgba(15, 23, 42, 0.04);
            }

            #adminCalendar .fc .fc-button:hover {
                background: #f8fafc;
                border-color: #cbd5e1;
            }

            #adminCalendar .fc .fc-button-primary:not(:disabled).fc-button-active,
            #adminCalendar .fc .fc-button-primary:not(:disabled):active {
                background: #047857;
                border-color: #047857;
                color: #ffffff;
            }

            #adminCalendar .fc .fc-scrollgrid {
                border-radius: 1rem;
                overflow: hidden;
            }

            #adminCalendar .fc .fc-col-header-cell {
                background: #f8fafc;
                border-color: #e2e8f0;
            }

            #adminCalendar .fc .fc-col-header-cell-cushion {
                padding: 0.75rem 0.5rem;
                font-weight: 800;
                color: #334155;
            }

            #adminCalendar .fc .fc-daygrid-day-number {
                padding: 0.5rem;
                font-weight: 700;
                color: #334155;
            }

            #adminCalendar .fc .fc-daygrid-event {
                border-radius: 9999px;
                padding: 0.1rem 0.55rem;
                font-weight: 700;
            }

            #adminCalendar .fc .fc-daygrid-event .fc-event-title {
                padding: 0.1rem 0;
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

        <script>
            (function () {
                const usersCount = Number(@json($usersCount ?? 0));
                const adminsCount = Number(@json($adminsCount ?? 0));
                const completedTasksCount = Number(@json($completedTasksCount ?? 0));
                const pendingTasksCount = Number(@json($pendingTasksCount ?? 0));
                const taskEvents = @json($taskEvents ?? []);

                const usersCtx = document.getElementById('usersPie');
                if (usersCtx && window.Chart) {
                    new Chart(usersCtx, {
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
                            plugins: {
                                legend: { position: 'bottom' },
                            },
                            cutout: '68%',
                        },
                    });
                }

                const tasksCtx = document.getElementById('tasksPie');
                if (tasksCtx && window.Chart) {
                    new Chart(tasksCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Completed', 'Pending'],
                            datasets: [
                                {
                                    data: [completedTasksCount, pendingTasksCount],
                                    backgroundColor: ['#4f46e5', '#d97706'],
                                    borderWidth: 0,
                                },
                            ],
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'bottom' },
                            },
                            cutout: '68%',
                        },
                    });
                }

                const calendarEl = document.getElementById('adminCalendar');
                if (calendarEl && window.FullCalendar) {
                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        height: 420,
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek',
                        },
                        buttonText: {
                            today: 'Today',
                            month: 'Month',
                            week: 'Week',
                        },
                        nowIndicator: true,
                        dayMaxEvents: 3,
                        events: taskEvents,
                    });
                    calendar.render();
                }
            })();
        </script>
    </div>
</x-adminmodules::layouts.master>
