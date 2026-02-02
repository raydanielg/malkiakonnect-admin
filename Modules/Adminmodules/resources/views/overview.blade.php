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
                <div class="rounded-2xl border border-slate-200 bg-gradient-to-br from-white to-primary-50 p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <div class="text-sm font-semibold text-slate-500">Admin</div>
                            <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Overview</h1>
                            <p class="mt-2 text-slate-600">Quick snapshot of system status, tasks, and admin activity.</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">
                                <span class="material-symbols-outlined">dashboard</span>
                                Open Dashboard
                            </a>
                            <a href="{{ route('admin.statistics') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">
                                <span class="material-symbols-outlined">query_stats</span>
                                View Stats
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">Users</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($usersCount ?? 0) }}</div>
                                <div class="mt-1 text-xs text-slate-500">Registered</div>
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
                                <div class="text-xs font-semibold text-slate-500">Tasks</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">{{ number_format($pendingTasksCount ?? 0) }}/{{ number_format($completedTasksCount ?? 0) }}</div>
                                <div class="mt-1 text-xs text-slate-500">Pending/Done</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center">
                                <span class="material-symbols-outlined">checklist</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-start justify-between">
                            <div>
                                <div class="text-xs font-semibold text-slate-500">System</div>
                                <div class="mt-2 text-3xl font-extrabold text-slate-900">OK</div>
                                <div class="mt-1 text-xs text-slate-500">Health & uptime</div>
                            </div>
                            <div class="w-12 h-12 rounded-2xl bg-fuchsia-50 text-fuchsia-700 flex items-center justify-center">
                                <span class="material-symbols-outlined">bolt</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 xl:grid-cols-3 gap-4">
                    <section class="xl:col-span-2 bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-extrabold text-slate-900">System Status</h2>
                            <div class="text-xs text-slate-500">Last updated {{ now()->format('M d, Y H:i') }}</div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-extrabold text-slate-900">Authentication</div>
                                    <div class="text-xs font-bold text-emerald-700">Healthy</div>
                                </div>
                                <div class="mt-2 text-xs text-slate-500">Login, redirect, and session handling.</div>
                                <div class="mt-4 h-2 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full bg-emerald-600" style="width: 96%"></div>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-extrabold text-slate-900">Database</div>
                                    <div class="text-xs font-bold text-emerald-700">Connected</div>
                                </div>
                                <div class="mt-2 text-xs text-slate-500">Migrations and core tables availability.</div>
                                <div class="mt-4 h-2 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full bg-emerald-600" style="width: 92%"></div>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-extrabold text-slate-900">Modules</div>
                                    <div class="text-xs font-bold text-amber-700">Active</div>
                                </div>
                                <div class="mt-2 text-xs text-slate-500">Adminmodules and Authmanagement.</div>
                                <div class="mt-4 h-2 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full bg-amber-600" style="width: 85%"></div>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-extrabold text-slate-900">Notifications</div>
                                    <div class="text-xs font-bold text-slate-600">Ready</div>
                                </div>
                                <div class="mt-2 text-xs text-slate-500">Toast alerts and UI feedback.</div>
                                <div class="mt-4 h-2 rounded-full bg-slate-100 overflow-hidden">
                                    <div class="h-full bg-slate-600" style="width: 78%"></div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <aside class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-extrabold text-slate-900">Next Actions</h2>
                            <span class="text-xs text-slate-500">Today</span>
                        </div>

                        <div class="mt-4 space-y-3">
                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="font-extrabold text-slate-900">Review new registrations</div>
                                        <div class="mt-1 text-xs text-slate-500">Check user signups and approvals.</div>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold">Pending</span>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="font-extrabold text-slate-900">Update membership forms</div>
                                        <div class="mt-1 text-xs text-slate-500">Validate required fields and rules.</div>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-primary-50 text-primary-700 text-xs font-bold">Planned</span>
                                </div>
                            </div>

                            <div class="rounded-2xl border border-slate-200 p-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="font-extrabold text-slate-900">Chat setup review</div>
                                        <div class="mt-1 text-xs text-slate-500">Confirm channels and permissions.</div>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold">Ready</span>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>

                <div class="mt-6 grid grid-cols-1 xl:grid-cols-2 gap-4">
                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-extrabold text-slate-900">Upcoming Tasks</h2>
                            <div class="text-xs text-slate-500">Pending</div>
                        </div>

                        <div class="mt-4 divide-y divide-slate-100">
                            @forelse(($upcomingTasks ?? []) as $task)
                                <div class="py-3 flex items-center justify-between gap-3">
                                    <div class="min-w-0">
                                        <div class="font-semibold text-slate-900 truncate">{{ $task->title }}</div>
                                        <div class="text-xs text-slate-500 truncate">
                                            @if($task->due_at)
                                                Due {{ $task->due_at->format('M d, Y') }}
                                            @else
                                                No due date
                                            @endif
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-bold">Pending</span>
                                </div>
                            @empty
                                <div class="py-6 text-sm text-slate-500">No pending tasks.</div>
                            @endforelse
                        </div>
                    </section>

                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-extrabold text-slate-900">Shortcuts</h2>
                            <div class="text-xs text-slate-500">Manage</div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <a href="{{ route('admin.users.index') }}" class="group rounded-2xl border border-slate-200 p-4 hover:bg-slate-50 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary-50 text-primary-700 flex items-center justify-center">
                                        <span class="material-symbols-outlined">group</span>
                                    </div>
                                    <div>
                                        <div class="font-extrabold text-slate-900">All Users</div>
                                        <div class="text-xs text-slate-500">Manage users</div>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('admin.forms.index') }}" class="group rounded-2xl border border-slate-200 p-4 hover:bg-slate-50 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center">
                                        <span class="material-symbols-outlined">description</span>
                                    </div>
                                    <div>
                                        <div class="font-extrabold text-slate-900">All Forms</div>
                                        <div class="text-xs text-slate-500">Forms & rules</div>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('admin.communication') }}" class="group rounded-2xl border border-slate-200 p-4 hover:bg-slate-50 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center">
                                        <span class="material-symbols-outlined">forum</span>
                                    </div>
                                    <div>
                                        <div class="font-extrabold text-slate-900">Communication</div>
                                        <div class="text-xs text-slate-500">Messaging</div>
                                    </div>
                                </div>
                            </a>

                            <a href="{{ route('admin.chat.setup') }}" class="group rounded-2xl border border-slate-200 p-4 hover:bg-slate-50 transition">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                                        <span class="material-symbols-outlined">settings</span>
                                    </div>
                                    <div>
                                        <div class="font-extrabold text-slate-900">Chat Setup</div>
                                        <div class="text-xs text-slate-500">Permissions</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </section>
                </div>

                <div class="mt-6 grid grid-cols-1 xl:grid-cols-2 gap-4">
                    <section class="bg-white rounded-2xl border border-slate-200 p-5">
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-extrabold text-slate-900">Recent Activities</h2>
                            <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">Open dashboard</a>
                        </div>

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
                        <div class="flex items-center justify-between">
                            <h2 class="text-base font-extrabold text-slate-900">Last Logins</h2>
                            <div class="text-xs text-slate-500">Latest</div>
                        </div>

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
    </div>
</x-adminmodules::layouts.master>
