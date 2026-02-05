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
                    <div class="px-6 py-4 border-b border-slate-200 bg-white">
                        <div class="flex flex-col xl:flex-row xl:items-end xl:justify-between gap-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 w-full">
                                <div>
                                    <div class="text-xs font-bold text-slate-500 uppercase">Status</div>
                                    <select id="filter-status" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 hover:bg-slate-50">
                                        <option value="">Zote</option>
                                        <option value="pending">pending</option>
                                        <option value="reviewed">reviewed</option>
                                        <option value="completed">completed</option>
                                    </select>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-500 uppercase">Simu</div>
                                    <input id="filter-phone" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Mfano: +2557..." />
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-500 uppercase">Jina</div>
                                    <input id="filter-full-name" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Tafuta jina..." />
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-500 uppercase">Kwa ukurasa</div>
                                    <select id="filter-per-page" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 hover:bg-slate-50">
                                        <option value="10">10</option>
                                        <option value="25" selected>25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <button id="btn-refresh" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Onyesha upya</button>
                                <button id="btn-apply" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Tafuta</button>
                            </div>
                        </div>

                        <div class="mt-3 hidden" id="mother-intakes-error">
                            <div class="px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold"></div>
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

                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4" id="intake-modal-grid"></div>
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
                const refreshBtn = document.getElementById('btn-refresh');
                const prevBtn = document.getElementById('btn-prev');
                const nextBtn = document.getElementById('btn-next');

                const modalEl = document.getElementById('intake-modal');
                const modalTitleEl = document.getElementById('intake-modal-title');
                const modalGridEl = document.getElementById('intake-modal-grid');
                const modalCloseEl = document.getElementById('intake-close');

                const errorWrapEl = document.getElementById('mother-intakes-error');
                const errorTextEl = errorWrapEl ? errorWrapEl.querySelector('div') : null;

                let currentPage = 1;
                let lastPage = 1;
                let debounceTimer = null;

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
                    tbody.innerHTML = [
                        '<tr class="animate-pulse">',
                        '<td colspan="7" class="py-6 px-4">',
                        '<div class="h-3 bg-slate-100 rounded w-1/4"></div>',
                        '<div class="mt-3 h-3 bg-slate-100 rounded w-1/2"></div>',
                        '<div class="mt-3 h-3 bg-slate-100 rounded w-1/3"></div>',
                        '</td>',
                        '</tr>'
                    ].join('');
                }

                function setError(message) {
                    if (!errorWrapEl || !errorTextEl) return;
                    errorTextEl.textContent = message;
                    errorWrapEl.classList.remove('hidden');
                }

                function clearError() {
                    if (!errorWrapEl) return;
                    errorWrapEl.classList.add('hidden');
                }

                function statusBadge(status) {
                    const s = String(status || '').toLowerCase();
                    if (s === 'completed') {
                        return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">completed</span>';
                    }
                    if (s === 'reviewed') {
                        return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">reviewed</span>';
                    }
                    return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">' + escapeHtml(status || 'pending') + '</span>';
                }

                function fmtDate(dateString) {
                    if (!dateString) return '-';
                    const dateOnly = String(dateString).slice(0, 10);
                    return dateOnly || '-';
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
                            + '<td class="py-3 px-4">' + statusBadge(r.status) + '</td>'
                            + '<td class="py-3 px-4 text-slate-600">' + escapeHtml(fmtDate(r.created_at)) + '</td>'
                            + '<td class="py-3 px-4">'
                                + '<div class="flex items-center justify-end gap-2">'
                                    + '<button type="button" class="px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition" data-view-intake="' + escapeHtml(r.id) + '">Angalia</button>'
                                + '</div>'
                            + '</td>'
                            + '</tr>'
                        );
                    }).join('');
                }

                function cardItem(label, value) {
                    return [
                        '<div class="p-4 rounded-2xl border border-slate-200 bg-white">',
                        '<div class="text-[11px] font-extrabold text-slate-500 uppercase">' + escapeHtml(label) + '</div>',
                        '<div class="mt-1 text-sm font-semibold text-slate-900 break-words">' + escapeHtml(value ?? '-') + '</div>',
                        '</div>'
                    ].join('');
                }

                function renderDetails(data) {
                    if (!modalGridEl) return;
                    const interests = Array.isArray(data && data.interests) ? data.interests.join(', ') : (data && data.interests ? String(data.interests) : '-');

                    modalGridEl.innerHTML = [
                        cardItem('id', data && data.id),
                        cardItem('full_name', data && data.full_name),
                        cardItem('phone', data && data.phone),
                        cardItem('journey_stage', data && data.journey_stage),
                        cardItem('pregnancy_weeks', data && data.pregnancy_weeks),
                        cardItem('baby_weeks_old', data && data.baby_weeks_old),
                        cardItem('hospital_planned', data && data.hospital_planned),
                        cardItem('hospital_alternative', data && data.hospital_alternative),
                        cardItem('delivery_hospital', data && data.delivery_hospital),
                        cardItem('birth_hospital', data && data.birth_hospital),
                        cardItem('ttc_duration', data && data.ttc_duration),
                        cardItem('agree_comms', (data && typeof data.agree_comms !== 'undefined') ? String(!!data.agree_comms) : '-'),
                        cardItem('disclaimer_ack', (data && typeof data.disclaimer_ack !== 'undefined') ? String(!!data.disclaimer_ack) : '-'),
                        cardItem('email', data && data.email),
                        cardItem('age', data && data.age),
                        cardItem('pregnancy_stage', data && data.pregnancy_stage),
                        cardItem('due_date', data && data.due_date),
                        cardItem('location', data && data.location),
                        cardItem('previous_pregnancies', data && data.previous_pregnancies),
                        cardItem('concerns', data && data.concerns),
                        cardItem('interests', interests),
                        cardItem('status', data && data.status),
                        cardItem('reviewed_by', data && data.reviewed_by),
                        cardItem('reviewed_at', data && data.reviewed_at),
                        cardItem('completed_at', data && data.completed_at),
                        cardItem('notes', data && data.notes),
                        cardItem('priority', data && data.priority),
                        cardItem('user_id', data && data.user_id),
                        cardItem('created_at', data && data.created_at),
                        cardItem('updated_at', data && data.updated_at)
                    ].join('');
                }

                async function fetchList() {
                    clearError();
                    setLoading();
                    try {
                        const res = await fetch(buildUrl(), {
                            headers: {
                                'Accept': 'application/json'
                            }
                        });

                        if (!res.ok) {
                            throw new Error('Imeshindikana kupata data. Jaribu tena.');
                        }

                        const json = await res.json();
                        const meta = json && json.meta ? json.meta : null;

                        lastPage = meta && meta.last_page ? meta.last_page : 1;

                        renderRows(json && json.data ? json.data : []);

                        if (metaEl && meta) {
                            metaEl.textContent = 'Ukurasa ' + meta.current_page + ' / ' + meta.last_page + ' (Jumla: ' + meta.total + ')';
                        }

                        if (prevBtn) prevBtn.disabled = currentPage <= 1;
                        if (nextBtn) nextBtn.disabled = currentPage >= lastPage;
                    } catch (err) {
                        if (tbody) {
                            tbody.innerHTML = '<tr><td colspan="7" class="py-10 px-4 text-slate-500">Hakuna data kwa sasa.</td></tr>';
                        }
                        setError((err && err.message) ? err.message : 'Imeshindikana kupata data.');
                    }
                }

                async function openDetails(id) {
                    if (!detailsModal || !modalGridEl) return;
                    modalTitleEl.textContent = 'Mother Intake #' + id;
                    modalGridEl.innerHTML = '<div class="md:col-span-2 px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm font-semibold">Inapakia...</div>';
                    detailsModal.show();

                    try {
                        const url = new URL('/api/mother-intakes/' + id, window.location.origin);
                        const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) {
                            throw new Error('Imeshindikana kupata maelezo ya fomu.');
                        }
                        const json = await res.json();
                        renderDetails(json && json.data ? json.data : null);
                    } catch (err) {
                        modalGridEl.innerHTML = '<div class="md:col-span-2 px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold">Imeshindikana kupata maelezo ya fomu.</div>';
                    }
                }

                function scheduleFetch() {
                    if (debounceTimer) window.clearTimeout(debounceTimer);
                    debounceTimer = window.setTimeout(function () {
                        currentPage = 1;
                        fetchList();
                    }, 450);
                }

                if (applyBtn) {
                    applyBtn.addEventListener('click', function () {
                        currentPage = 1;
                        fetchList();
                    });
                }

                if (refreshBtn) {
                    refreshBtn.addEventListener('click', function () {
                        fetchList();
                    });
                }

                if (statusEl) {
                    statusEl.addEventListener('change', scheduleFetch);
                }

                if (perPageEl) {
                    perPageEl.addEventListener('change', function () {
                        currentPage = 1;
                        fetchList();
                    });
                }

                if (phoneEl) {
                    phoneEl.addEventListener('input', scheduleFetch);
                }

                if (fullNameEl) {
                    fullNameEl.addEventListener('input', scheduleFetch);
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
