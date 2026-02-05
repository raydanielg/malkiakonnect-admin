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
                <div class="bg-white rounded-2xl border border-slate-200 p-6">
                    <div class="text-sm text-slate-500">Usimamizi wa Fomu</div>
                    <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Fomu Zote</h1>
                    <p class="mt-2 text-slate-600">Majibu yote ya fomu ya kujiunga (Mother Intake) yanatoka kwenye API.</p>
                </div>

                <div class="mt-6 bg-white rounded-2xl border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 bg-white flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div class="flex items-center gap-3 flex-wrap">
                            <div class="text-sm font-semibold text-slate-700">Chuja kwa:</div>
                            <select id="filter-status" class="px-3 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 hover:bg-slate-50">
                                <option value="">Status (yote)</option>
                                <option value="pending">pending</option>
                                <option value="reviewed">reviewed</option>
                                <option value="completed">completed</option>
                            </select>
                            <input id="filter-phone" class="px-3 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Simu" />
                            <input id="filter-full-name" class="px-3 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Jina kamili" />
                        </div>

                        <div class="flex items-center gap-2">
                            <select id="filter-per-page" class="px-3 py-2 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 hover:bg-slate-50">
                                <option value="10">10</option>
                                <option value="25" selected>25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <button id="btn-apply" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Tafuta</button>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs uppercase text-slate-500 bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th class="text-left py-3 px-4">#</th>
                                    <th class="text-left py-3 px-4">Jina</th>
                                    <th class="text-left py-3 px-4">Simu</th>
                                    <th class="text-left py-3 px-4">Hatua</th>
                                    <th class="text-left py-3 px-4">Status</th>
                                    <th class="text-left py-3 px-4">Tarehe</th>
                                    <th class="text-right py-3 px-4">Vitendo</th>
                                </tr>
                            </thead>
                            <tbody id="mother-intakes-body" class="divide-y divide-slate-100">
                                <tr>
                                    <td colspan="7" class="py-10 px-4 text-slate-500" id="mother-intakes-loading">Inapakia...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-slate-200 bg-white flex items-center justify-between gap-3">
                        <div class="text-sm text-slate-600" id="mother-intakes-meta"></div>
                        <div class="flex items-center gap-2">
                            <button id="btn-prev" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Nyuma</button>
                            <button id="btn-next" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Mbele</button>
                        </div>
                    </div>
                </div>

                <div id="intake-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                        <div class="relative p-4 bg-white rounded-2xl border border-slate-200 shadow md:p-8">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="text-sm font-semibold text-slate-500">Maelezo ya Fomu</div>
                                    <h3 class="mt-1 text-2xl font-extrabold text-slate-900" id="intake-modal-title">Mother Intake</h3>
                                </div>
                                <button id="intake-close" type="button" class="py-2 px-4 text-sm font-semibold text-slate-600 bg-white rounded-xl border border-slate-200 hover:bg-slate-50">Funga</button>
                            </div>

                            <div class="mt-5">
                                <pre id="intake-modal-json" class="text-xs bg-slate-50 border border-slate-200 rounded-xl p-4 overflow-auto"></pre>
                            </div>
                        </div>
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

        <script>
            (function () {
                const tbody = document.getElementById('mother-intakes-body');
                const metaEl = document.getElementById('mother-intakes-meta');

                const statusEl = document.getElementById('filter-status');
                const phoneEl = document.getElementById('filter-phone');
                const fullNameEl = document.getElementById('filter-full-name');
                const perPageEl = document.getElementById('filter-per-page');
                const applyBtn = document.getElementById('btn-apply');
                const prevBtn = document.getElementById('btn-prev');
                const nextBtn = document.getElementById('btn-next');

                const modalEl = document.getElementById('intake-modal');
                const modalTitleEl = document.getElementById('intake-modal-title');
                const modalJsonEl = document.getElementById('intake-modal-json');
                const modalCloseEl = document.getElementById('intake-close');

                let currentPage = 1;
                let lastPage = 1;

                const detailsModal = (modalEl && typeof Modal !== 'undefined')
                    ? new Modal(modalEl, { placement: 'center' })
                    : null;

                function escapeHtml(str) {
                    return String(str ?? '')
                        .replaceAll('&', '&amp;')
                        .replaceAll('<', '&lt;')
                        .replaceAll('>', '&gt;')
                        .replaceAll('"', '&quot;')
                        .replaceAll("'", '&#039;');
                }

                function buildUrl() {
                    const url = new URL('/api/mother-intakes', window.location.origin);
                    url.searchParams.set('per_page', perPageEl ? perPageEl.value : '25');
                    url.searchParams.set('page', String(currentPage));
                    if (statusEl && statusEl.value) url.searchParams.set('status', statusEl.value);
                    if (phoneEl && phoneEl.value) url.searchParams.set('phone', phoneEl.value);
                    if (fullNameEl && fullNameEl.value) url.searchParams.set('full_name', fullNameEl.value);
                    return url.toString();
                }

                function setLoading() {
                    if (!tbody) return;
                    tbody.innerHTML = '<tr><td colspan="7" class="py-10 px-4 text-slate-500">Inapakia...</td></tr>';
                }

                function renderRows(rows) {
                    if (!tbody) return;
                    if (!rows || rows.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="7" class="py-10 px-4 text-slate-500">Hakuna majibu ya fomu.</td></tr>';
                        return;
                    }

                    tbody.innerHTML = rows.map(function (r) {
                        return (
                            '<tr class="hover:bg-slate-50">'
                            + '<td class="py-3 px-4 font-semibold text-slate-900">' + escapeHtml(r.id) + '</td>'
                            + '<td class="py-3 px-4 text-slate-900">' + escapeHtml(r.full_name || '-') + '</td>'
                            + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(r.phone || '-') + '</td>'
                            + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(r.journey_stage || '-') + '</td>'
                            + '<td class="py-3 px-4">'
                                + '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">'
                                + escapeHtml(r.status || '-')
                                + '</span>'
                            + '</td>'
                            + '<td class="py-3 px-4 text-slate-600">' + escapeHtml((r.created_at || '').slice(0, 10) || '-') + '</td>'
                            + '<td class="py-3 px-4">'
                                + '<div class="flex items-center justify-end gap-2">'
                                    + '<button type="button" class="px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition" data-view-intake="' + escapeHtml(r.id) + '">Angalia</button>'
                                + '</div>'
                            + '</td>'
                            + '</tr>'
                        );
                    }).join('');
                }

                async function fetchList() {
                    setLoading();
                    const res = await fetch(buildUrl(), {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });

                    const json = await res.json();
                    const meta = json && json.meta ? json.meta : null;

                    lastPage = meta && meta.last_page ? meta.last_page : 1;

                    renderRows(json && json.data ? json.data : []);

                    if (metaEl && meta) {
                        metaEl.textContent = 'Ukurasa ' + meta.current_page + ' / ' + meta.last_page + ' (Jumla: ' + meta.total + ')';
                    }

                    if (prevBtn) prevBtn.disabled = currentPage <= 1;
                    if (nextBtn) nextBtn.disabled = currentPage >= lastPage;
                }

                async function openDetails(id) {
                    if (!detailsModal || !modalJsonEl) return;
                    modalTitleEl.textContent = 'Mother Intake #' + id;
                    modalJsonEl.textContent = 'Inapakia...';
                    detailsModal.show();

                    const url = new URL('/api/mother-intakes/' + id, window.location.origin);
                    const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
                    const json = await res.json();
                    modalJsonEl.textContent = JSON.stringify(json, null, 2);
                }

                if (applyBtn) {
                    applyBtn.addEventListener('click', function () {
                        currentPage = 1;
                        fetchList();
                    });
                }

                if (prevBtn) {
                    prevBtn.addEventListener('click', function () {
                        if (currentPage <= 1) return;
                        currentPage -= 1;
                        fetchList();
                    });
                }

                if (nextBtn) {
                    nextBtn.addEventListener('click', function () {
                        if (currentPage >= lastPage) return;
                        currentPage += 1;
                        fetchList();
                    });
                }

                document.addEventListener('click', function (e) {
                    const btn = e.target.closest && e.target.closest('[data-view-intake]');
                    if (!btn) return;
                    openDetails(btn.getAttribute('data-view-intake'));
                });

                if (modalCloseEl) {
                    modalCloseEl.addEventListener('click', function () {
                        if (!detailsModal) return;
                        detailsModal.hide();
                    });
                }

                fetchList();
            })();
        </script>
    </div>
</x-adminmodules::layouts.master>
