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
                <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
                    <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <div>
                                <div class="flex items-center gap-2">
                                    <h1 class="text-base font-extrabold text-slate-900">Watumiaji Wote</h1>
                                    <span class="text-sm text-slate-500">{{ number_format($users->total()) }} Matokeo</span>
                                    <span class="material-symbols-outlined text-slate-400" style="font-size: 18px">info</span>
                                </div>
                                <div class="mt-1 text-xs text-slate-500">Usimamizi wa Watumiaji</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">
                                Sajili Mtumiaji
                            </a>
                            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">
                                <svg class="w-5 h-5 text-slate-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                                    <path d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3.546l3.2 3.659a1 1 0 0 0 1.506 0L13.454 14H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-8 10H5a1 1 0 0 1 0-2h5a1 1 0 1 1 0 2Zm5-4H5a1 1 0 0 1 0-2h10a1 1 0 1 1 0 2Z"/>
                                </svg>
                                Angalia
                            </a>
                            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">
                                <svg class="w-5 h-5 text-slate-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3"/>
                                </svg>
                                Pakua
                            </a>
                            <button type="button" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">
                                Vitendo
                                <svg class="w-4 h-4 text-slate-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 8">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 5.326 5.7a.909.909 0 0 0 1.348 0L13 1"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="px-6 py-4 border-t border-slate-200 bg-white flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex items-center gap-3 flex-wrap">
                            <div class="text-sm font-semibold text-slate-700">Chuja kwa:</div>
                            <button type="button" class="px-3 py-1.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 hover:bg-slate-50">Role</button>
                            <button type="button" class="px-3 py-1.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 hover:bg-slate-50">Created</button>
                            <button type="button" class="px-3 py-1.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 hover:bg-slate-50">Status</button>
                            <button type="button" class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl text-sm font-semibold text-primary-700 hover:bg-primary-50">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.75 4H19M7.75 4a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 4h2.25m13.5 6H19m-2.25 0a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 10h11.25m-4.5 6H19M7.75 16a2.25 2.25 0 0 1-4.5 0m4.5 0a2.25 2.25 0 0 0-4.5 0M1 16h2.25"/>
                                </svg>
                                Chaguo zaidi
                            </button>
                        </div>

                        <form method="get" class="flex items-center gap-2">
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                                <input name="q" value="{{ $q ?? '' }}" placeholder="Tafuta jina, barua pepe, jina la mtumiaji" class="pl-10 pr-4 py-2.5 w-72 max-w-full rounded-xl border border-slate-200 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300" />
                            </div>
                            <button class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Tafuta</button>
                        </form>
                    </div>
                </div>

                <div class="mt-6 bg-white rounded-2xl border border-slate-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs uppercase text-slate-500 bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th class="text-left py-3 px-4">#</th>
                                    <th class="text-left py-3 px-4">Jina</th>
                                    <th class="text-left py-3 px-4">Barua pepe</th>
                                    <th class="text-left py-3 px-4">Jina la mtumiaji</th>
                                    <th class="text-left py-3 px-4">Aina</th>
                                    <th class="text-left py-3 px-4">Tarehe</th>
                                    <th class="text-right py-3 px-4">Vitendo</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($users as $user)
                                    <tr class="hover:bg-slate-50">
                                        <td class="py-3 px-4 font-semibold text-slate-900">{{ $user->id }}</td>
                                        <td class="py-3 px-4 text-slate-900">{{ $user->name ?? '-' }}</td>
                                        <td class="py-3 px-4 text-slate-700">{{ $user->email ?? '-' }}</td>
                                        <td class="py-3 px-4 text-slate-700">{{ $user->username ?? '-' }}</td>
                                        <td class="py-3 px-4">
                                            @php($isAdmin = (($user->role ?? 'user') === 'module') || (bool) ($user->is_admin ?? false))
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $isAdmin ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-700' }}">
                                                {{ $isAdmin ? 'admin' : ($user->role ?? 'user') }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 text-slate-600">{{ optional($user->created_at)->format('M d, Y') }}</td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 transition" title="Maelezo">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                                        <path d="M16 0H4a2 2 0 0 0-2 2v1H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v2H1a1 1 0 0 0 0 2h1v1a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4.5a3 3 0 1 1 0 6 3 3 0 0 1 0-6ZM13.929 17H7.071a.5.5 0 0 1-.5-.5 3.935 3.935 0 1 1 7.858 0 .5.5 0 0 1-.5.5Z"/>
                                                    </svg>
                                                </a>
                                                <button type="button" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 transition" title="Futa" data-delete-user-button data-delete-user-id="{{ $user->id }}" data-delete-user-name="{{ $user->name ?? $user->email ?? 'Mtumiaji' }}" data-delete-user-action="{{ route('admin.users.destroy', $user) }}">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                                        <path d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z"/>
                                                    </svg>
                                                </button>
                                                <a href="{{ route('admin.users.logs', $user) }}" class="inline-flex items-center justify-center w-9 h-9 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 transition" title="Rekodi">
                                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 20">
                                                        <path d="M12.133 10.632v-1.8A5.406 5.406 0 0 0 7.979 3.57.946.946 0 0 0 8 3.464V1.1a1 1 0 0 0-2 0v2.364a.946.946 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C1.867 13.018 0 13.614 0 14.807 0 15.4 0 16 .538 16h12.924C14 16 14 15.4 14 14.807c0-1.193-1.867-1.789-1.867-4.175ZM3.823 17a3.453 3.453 0 0 0 6.354 0H3.823Z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-8 px-4 text-slate-500">Hakuna watumiaji.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4">
                        {{ $users->links() }}
                    </div>
                </div>

                @include('adminmodules::partials.footer')
            </main>
        </div>

        <div id="info-popup" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
            <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
                <div class="relative p-4 bg-white rounded-2xl border border-slate-200 shadow md:p-8">
                    <div class="mb-4 text-sm font-light text-slate-600">
                        <h3 class="mb-3 text-2xl font-extrabold text-slate-900">Thibitisha kufuta</h3>
                        <p>
                            Unakaribia kumfuta <span class="font-extrabold text-slate-900" data-delete-user-name></span>.
                            Hatua hii haiwezi kurudishwa.
                        </p>
                    </div>
                    <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                        <a href="#" class="font-semibold text-primary-700 hover:underline">Soma zaidi</a>
                        <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                            <button id="close-modal" type="button" class="py-2.5 px-4 w-full text-sm font-semibold text-slate-600 bg-white rounded-xl border border-slate-200 sm:w-auto hover:bg-slate-50 focus:ring-4 focus:outline-none focus:ring-primary-200 hover:text-slate-900 focus:z-10">Ghairi</button>
                            <form method="POST" id="delete-user-form" action="#" class="w-full sm:w-auto">
                                @csrf
                                @method('DELETE')
                                <button id="confirm-button" type="submit" class="py-2.5 px-4 w-full text-sm font-semibold text-center text-white rounded-xl bg-rose-600 sm:w-auto hover:bg-rose-500 focus:ring-4 focus:outline-none focus:ring-rose-200">Thibitisha</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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

        <script>
            (function () {
                const modalEl = document.getElementById('info-popup');
                if (!modalEl || typeof Modal === 'undefined') return;

                const deleteModal = new Modal(modalEl, {
                    placement: 'center',
                });

                const nameEl = modalEl.querySelector('[data-delete-user-name]');
                const formEl = document.getElementById('delete-user-form');

                function openModal(name, action) {
                    if (!nameEl || !formEl) return;
                    nameEl.textContent = name || 'User';
                    formEl.setAttribute('action', action || '#');
                    deleteModal.show();
                }

                function closeModal() {
                    deleteModal.hide();
                }

                document.addEventListener('click', function (e) {
                    const btn = e.target.closest && e.target.closest('[data-delete-user-button]');
                    if (btn) {
                        openModal(btn.getAttribute('data-delete-user-name'), btn.getAttribute('data-delete-user-action'));
                        return;
                    }
                });

                const closeBtn = document.getElementById('close-modal');
                if (closeBtn) closeBtn.addEventListener('click', closeModal);

                modalEl.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape') closeModal();
                });
            })();
        </script>
    </div>
</x-adminmodules::layouts.master>
