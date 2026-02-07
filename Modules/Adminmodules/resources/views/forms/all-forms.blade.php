<x-adminmodules::layouts.master>
    <style>
        .action-btn {
            pointer-events: auto;
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: #f8fafc;
        }
    </style>
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
                    <div class="text-sm text-slate-500">Form Management</div>
                    <h1 class="mt-1 text-2xl font-extrabold text-slate-900">{{ $pageTitle ?? 'All Forms' }}</h1>
                    <p class="mt-2 text-slate-600">Hapa tunaonyesha majibu yote ya fomu kutoka kwenye API. Ukisha-approve, intake itahifadhiwa kwenye database ya hapa (local).</p>
                    @if(!empty($defaultJourneyStage))
                        <div class="mt-3 inline-flex items-center gap-2 px-3 py-1.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm font-extrabold">
                            <span>Journey:</span>
                            <span class="uppercase">{{ $defaultJourneyStage }}</span>
                            <a href="{{ url('/admin/forms') }}" class="ml-2 text-slate-600 hover:text-slate-900 font-semibold">Clear</a>
                        </div>
                    @endif
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
                                <button id="btn-refresh" class="relative inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">
                                    <span class="inline-flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 12a9 9 0 1 1-3-6.7" />
                                            <path d="M21 3v6h-6" />
                                        </svg>
                                    </span>
                                    <span>Onyesha upya</span>
                                    <span id="refresh-badge" class="hidden absolute -top-2 -right-2 min-w-5 h-5 px-1 rounded-full bg-rose-600 text-white text-[11px] leading-5 text-center font-extrabold">0</span>
                                </button>
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
                                    <th class="text-left py-3 px-4">Full Name</th>
                                    <th class="text-left py-3 px-4">Whatsapp Number</th>
                                    <th class="text-left py-3 px-4">Journey Stage</th>
                                    <th class="text-left py-3 px-4">Weeks while joining</th>
                                    <th class="text-left py-3 px-4">Date of Joining</th>
                                    <th class="text-left py-3 px-4">Hospital Planned</th>
                                    <th class="text-right py-3 px-4">Actions</th>
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

                            <div class="mt-6 flex flex-wrap items-center justify-end gap-2" id="intake-modal-actions"></div>
                        </div>
                    </div>
                </div>

                <div id="mk-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
                        <div class="relative p-4 bg-white rounded-2xl border border-slate-200 shadow md:p-8">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="text-sm font-semibold text-slate-500">Edit</div>
                                    <h3 class="mt-1 text-2xl font-extrabold text-slate-900" id="mk-modal-title">MK Number</h3>
                                </div>
                                <button id="mk-close" type="button" class="py-2 px-4 text-sm font-semibold text-slate-600 bg-white rounded-xl border border-slate-200 hover:bg-slate-50">Funga</button>
                            </div>

                            <div class="mt-5 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div>
                                        <div class="text-xs font-bold text-slate-500 uppercase">Full Name</div>
                                        <div class="mt-1 text-sm font-semibold text-slate-900" id="mk-full-name">-</div>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-500 uppercase">Whatsapp Number</div>
                                        <div class="mt-1 text-sm font-semibold text-slate-900" id="mk-phone">-</div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <div class="text-xs font-bold text-slate-500 uppercase">MK Number</div>
                                <div class="mt-2 flex items-center gap-2">
                                    <div class="px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-extrabold text-slate-900">MK-</div>
                                    <input id="mk-digits" class="flex-1 px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900" placeholder="2631" inputmode="numeric" />
                                    <button id="mk-generate" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Generate</button>
                                </div>
                                <div class="mt-2 text-xs text-slate-500">Namba lazima iwe unique. Prefix ya <span class="font-extrabold">MK-</span> haiwezi kubadilishwa.</div>
                                <div class="mt-3 hidden" id="mk-error">
                                    <div class="px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold"></div>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-end gap-2">
                                <button id="mk-save" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Hifadhi</button>
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

                const API_BASE_URL = @json(rtrim((string) config('app.api_base_url'), '/').'/');

                const statusEl = document.getElementById('filter-status');
                const phoneEl = document.getElementById('filter-phone');
                const fullNameEl = document.getElementById('filter-full-name');
                const perPageEl = document.getElementById('filter-per-page');
                const applyBtn = document.getElementById('btn-apply');
                const refreshBtn = document.getElementById('btn-refresh');
                const prevBtn = document.getElementById('btn-prev');
                const nextBtn = document.getElementById('btn-next');

                const DEFAULT_JOURNEY_STAGE = @json($defaultJourneyStage ?? '');

                const modalEl = document.getElementById('intake-modal');
                const modalTitleEl = document.getElementById('intake-modal-title');
                const modalGridEl = document.getElementById('intake-modal-grid');
                const modalActionsEl = document.getElementById('intake-modal-actions');
                const modalCloseEl = document.getElementById('intake-close');

                const mkModalEl = document.getElementById('mk-modal');
                const mkModalTitleEl = document.getElementById('mk-modal-title');
                const mkCloseEl = document.getElementById('mk-close');
                const mkFullNameEl = document.getElementById('mk-full-name');
                const mkPhoneEl = document.getElementById('mk-phone');
                const mkDigitsEl = document.getElementById('mk-digits');
                const mkGenerateBtn = document.getElementById('mk-generate');
                const mkSaveBtn = document.getElementById('mk-save');
                const mkErrorWrapEl = document.getElementById('mk-error');
                const mkErrorTextEl = mkErrorWrapEl ? mkErrorWrapEl.querySelector('div') : null;

                const errorWrapEl = document.getElementById('mother-intakes-error');
                const errorTextEl = errorWrapEl ? errorWrapEl.querySelector('div') : null;

                let currentPage = 1;
                let lastPage = 1;
                let debounceTimer = null;

                const refreshBadgeEl = document.getElementById('refresh-badge');
                let pendingUpdates = 0;
                let lastSeenTopId = null;
                let pollTimer = null;

                const mkBySourceId = {};
                const approvedBySourceId = {};
                let activeEdit = null;
                let activeDetails = null;

                const detailsModal = (modalEl && typeof Modal !== 'undefined')
                    ? new Modal(modalEl, { placement: 'center' })
                    : null;

                const editModal = (mkModalEl && typeof Modal !== 'undefined')
                    ? new Modal(mkModalEl, { placement: 'center' })
                    : null;

                function setMkError(message) {
                    if (!mkErrorWrapEl || !mkErrorTextEl) return;
                    mkErrorTextEl.textContent = message;
                    mkErrorWrapEl.classList.remove('hidden');
                }

                function clearMkError() {
                    if (!mkErrorWrapEl) return;
                    mkErrorWrapEl.classList.add('hidden');
                }

                async function generateMk() {
                    if (!activeEdit) return;
                    clearMkError();

                    if (mkGenerateBtn) {
                        mkGenerateBtn.disabled = true;
                        mkGenerateBtn.textContent = 'Inatengeneza...';
                    }

                    try {
                        const url = @json(url('/admin/forms/mother-intakes')) + '/' + encodeURIComponent(activeEdit.sourceId) + '/mk/generate';
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': @json(csrf_token()),
                            },
                            body: JSON.stringify({
                                full_name: activeEdit.fullName,
                                phone: activeEdit.phone,
                            }),
                        });

                        const json = await res.json().catch(function () { return null; });
                        if (!res.ok) {
                            const msg = (json && json.message) ? json.message : 'Imeshindikana kutengeneza MK Number.';
                            setMkError(msg);
                            return;
                        }

                        const mkNumber = json && json.data ? json.data.mk_number : null;
                        if (mkNumber && mkDigitsEl) {
                            mkDigitsEl.value = String(mkNumber).startsWith('MK-') ? String(mkNumber).slice(3) : '';
                            mkBySourceId[activeEdit.sourceId] = mkNumber;
                            fetchList();
                        }
                    } catch (err) {
                        setMkError('Imeshindikana kutengeneza MK Number.');
                    } finally {
                        if (mkGenerateBtn) {
                            mkGenerateBtn.disabled = false;
                            mkGenerateBtn.textContent = 'Generate';
                        }
                    }
                }

                const expandedGroups = {};

                function groupByPhone(rows) {
                    const list = Array.isArray(rows) ? rows : [];
                    const map = {};
                    const order = [];

                    list.forEach(function (r) {
                        const phoneKey = normalizePhone(r && r.phone);
                        const key = phoneKey ? ('phone:' + phoneKey) : ('id:' + String(r && r.id));
                        if (!map[key]) {
                            map[key] = [];
                            order.push(key);
                        }
                        map[key].push(r);
                    });

                    order.forEach(function (key) {
                        map[key].sort(function (a, b) {
                            const aTime = String(a && a.created_at ? a.created_at : '');
                            const bTime = String(b && b.created_at ? b.created_at : '');
                            if (aTime === bTime) {
                                return Number(b && b.id ? b.id : 0) - Number(a && a.id ? a.id : 0);
                            }
                            return aTime < bTime ? 1 : -1;
                        });
                    });

                    return { map, order };
                }

                async function openEdit(sourceId, fullName, phone) {
                    if (!editModal || !mkDigitsEl) return;
                    activeEdit = { sourceId: String(sourceId), fullName: fullName || '', phone: phone || '' };
                    clearMkError();

                    if (mkModalTitleEl) mkModalTitleEl.textContent = 'Edit MK Number';
                    if (mkFullNameEl) mkFullNameEl.textContent = fullName || '-';
                    if (mkPhoneEl) mkPhoneEl.textContent = phone || '-';
                    mkDigitsEl.value = '';
                    editModal.show();

                    try {
                        const url = @json(url('/admin/forms/mother-intakes')) + '/' + encodeURIComponent(sourceId) + '/mk';
                        const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) return;
                        const json = await res.json();
                        const mkNumber = json && json.data ? json.data.mk_number : null;

                        if (mkNumber && typeof mkNumber === 'string' && mkNumber.startsWith('MK-')) {
                            mkDigitsEl.value = mkNumber.slice(3);
                            mkBySourceId[activeEdit.sourceId] = mkNumber;
                            return;
                        }

                        await generateMk();
                    } catch (err) {
                        // ignore
                    }
                }

                async function saveMk() {
                    if (!activeEdit || !mkDigitsEl) return;
                    clearMkError();
                    const digits = String(mkDigitsEl.value || '').trim();
                    if (!/^[0-9]{1,10}$/.test(digits)) {
                        setMkError('Weka namba sahihi (digits tu).');
                        return;
                    }

                    if (mkSaveBtn) {
                        mkSaveBtn.disabled = true;
                        mkSaveBtn.textContent = 'Inahifadhi...';
                    }

                    try {
                        const url = @json(url('/admin/forms/mother-intakes')) + '/' + encodeURIComponent(activeEdit.sourceId) + '/mk';
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': @json(csrf_token()),
                            },
                            body: JSON.stringify({
                                mk_digits: digits,
                                full_name: activeEdit.fullName,
                                phone: activeEdit.phone,
                            }),
                        });

                        const json = await res.json().catch(function () { return null; });
                        if (!res.ok) {
                            const msg = (json && json.message) ? json.message : 'Imeshindikana kuhifadhi MK Number.';
                            setMkError(msg);
                            return;
                        }

                        const mkNumber = json && json.data ? json.data.mk_number : null;
                        if (mkNumber) {
                            mkBySourceId[activeEdit.sourceId] = mkNumber;
                            fetchList();
                        }

                        if (editModal) editModal.hide();
                    } catch (err) {
                        setMkError('Imeshindikana kuhifadhi MK Number.');
                    } finally {
                        if (mkSaveBtn) {
                            mkSaveBtn.disabled = false;
                            mkSaveBtn.textContent = 'Hifadhi';
                        }
                    }
                }

                async function approveIntake(sourceId, fullName, phone, buttonEl) {
                    if (!sourceId) return;

                    clearError();

                    if (buttonEl) {
                        buttonEl.disabled = true;
                        buttonEl.classList.add('opacity-60');
                    }

                    try {
                        const url = @json(url('/admin/forms/mother-intakes')) + '/' + encodeURIComponent(String(sourceId)) + '/approve';
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': @json(csrf_token()),
                            },
                            body: JSON.stringify({
                                full_name: fullName || null,
                                phone: phone || null,
                            }),
                        });

                        const json = await res.json().catch(function () { return null; });
                        if (!res.ok) {
                            const msg = (json && json.message) ? json.message : 'Imeshindikana ku-approve intake.';
                            setError(msg);
                            return;
                        }

                        const mk = json && json.data ? json.data.mk_number : null;
                        if (mk) {
                            mkBySourceId[String(sourceId)] = mk;
                        }

                        approvedBySourceId[String(sourceId)] = true;

                        await fetchList();
                    } catch (e) {
                        setError('Imeshindikana ku-approve intake.');
                    } finally {
                        if (buttonEl) {
                            buttonEl.disabled = false;
                            buttonEl.classList.remove('opacity-60');
                        }
                    }
                }

                function escapeHtml(str) {
                    return String(str ?? '')
                        .replaceAll('&', '&amp;')
                        .replaceAll('<', '&lt;')
                        .replaceAll('>', '&gt;')
                        .replaceAll('"', '&quot;')
                        .replaceAll("'", '&#039;');
                }

                function buildUrl() {
                    const url = new URL('api/mother-intakes', API_BASE_URL || window.location.origin);
                    url.searchParams.set('per_page', perPageEl ? perPageEl.value : '25');
                    url.searchParams.set('page', String(currentPage));
                    if (statusEl && statusEl.value) url.searchParams.set('status', statusEl.value);
                    if (phoneEl && phoneEl.value) url.searchParams.set('phone', phoneEl.value);
                    if (fullNameEl && fullNameEl.value) url.searchParams.set('full_name', fullNameEl.value);
                    if (DEFAULT_JOURNEY_STAGE) url.searchParams.set('journey_stage', DEFAULT_JOURNEY_STAGE);
                    return url.toString();
                }

                function setPendingUpdates(count) {
                    pendingUpdates = Math.max(0, Number(count) || 0);
                    if (!refreshBadgeEl) return;
                    if (pendingUpdates <= 0) {
                        refreshBadgeEl.textContent = '0';
                        refreshBadgeEl.classList.add('hidden');
                        return;
                    }

                    refreshBadgeEl.textContent = String(Math.min(99, pendingUpdates));
                    refreshBadgeEl.classList.remove('hidden');
                }

                async function pollForUpdates() {
                    try {
                        const url = new URL('api/mother-intakes', API_BASE_URL || window.location.origin);
                        url.searchParams.set('per_page', '1');
                        url.searchParams.set('page', '1');

                        const res = await fetch(url.toString(), {
                            headers: { 'Accept': 'application/json' }
                        });

                        if (!res.ok) return;
                        const json = await res.json().catch(function () { return null; });
                        const first = json && Array.isArray(json.data) ? json.data[0] : null;
                        const topId = first && typeof first.id !== 'undefined' ? String(first.id) : null;
                        if (!topId) return;

                        if (lastSeenTopId === null) {
                            lastSeenTopId = topId;
                            return;
                        }

                        if (topId !== lastSeenTopId) {
                            setPendingUpdates(pendingUpdates + 1);
                        }
                    } catch (e) {
                        // ignore
                    }
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

                function weeksWhileJoining(row) {
                    if (!row) return '-';
                    if (row.journey_stage === 'pregnant' && row.pregnancy_weeks != null) {
                        return row.pregnancy_weeks;
                    }
                    if (row.journey_stage === 'postpartum' && row.baby_weeks_old != null) {
                        return row.baby_weeks_old;
                    }
                    if (row.pregnancy_weeks != null) return row.pregnancy_weeks;
                    if (row.baby_weeks_old != null) return row.baby_weeks_old;
                    return '-';
                }

                function normalizePhone(phone) {
                    const raw = String(phone || '').trim();
                    if (!raw) return '';
                    const digits = raw.replace(/[^0-9]/g, '');
                    if (!digits) return '';
                    return digits;
                }

                function mkNumber(row) {
                    if (!row) return '-';
                    const id = row.id;
                    return mkBySourceId[id] || row.mk_number || row.mkNumber || '-';
                }

                function isApproved(row) {
                    if (!row) return false;
                    const key = String(row.id ?? '');
                    if (approvedBySourceId[key]) return true;
                    if (row.approved_at) return true;
                    const mk = mkNumber(row);
                    return mk && mk !== '-';
                }

                async function hydrateLocalStatus(rows) {
                    try {
                        const ids = (Array.isArray(rows) ? rows : [])
                            .map(function (r) { return r && typeof r.id !== 'undefined' ? String(r.id) : ''; })
                            .filter(function (v) { return v && /^[0-9]+$/.test(v); });

                        if (!ids.length) return;

                        const url = new URL(@json(url('/admin/forms/mother-intakes/local/batch')), window.location.origin);
                        url.searchParams.set('source_ids', ids.join(','));

                        const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) return;
                        const json = await res.json().catch(function () { return null; });
                        const data = json && json.data ? json.data : null;
                        if (!data) return;

                        Object.keys(data).forEach(function (k) {
                            const item = data[k];
                            if (!item) return;
                            if (item.mk_number) {
                                mkBySourceId[String(k)] = item.mk_number;
                            }
                            if (item.approved_at) {
                                approvedBySourceId[String(k)] = true;
                            }
                        });
                    } catch (e) {
                        // ignore
                    }
                }

                function renderRows(rows) {
                    if (!tbody) return;
                    if (!rows || rows.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="7" class="py-10 px-4 text-slate-500">Hakuna majibu ya fomu.</td></tr>';
                        return;
                    }

                    const grouped = groupByPhone(rows);

                    const html = [];

                    grouped.order.forEach(function (key) {
                        const group = grouped.map[key] || [];
                        if (!group.length) return;

                        const top = group[0];
                        const phoneKey = normalizePhone(top && top.phone);
                        const isDuplicateGroup = phoneKey && group.length > 1;

                        const approvedTop = isApproved(top);

                        const approveBtnTop = approvedTop
                            ? '<span class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700" title="Approved">'
                                + '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                    + '<path d="M20 6 9 17l-5-5" />'
                                + '</svg>'
                            + '</span>'
                            : '<button type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 transition" data-row-action="1" data-approve-intake="' + escapeHtml(top.id) + '" data-approve-full-name="' + escapeHtml(top.full_name || '') + '" data-approve-phone="' + escapeHtml(top.phone || '') + '" title="Approve">'
                                + '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                    + '<path d="M20 6 9 17l-5-5" />'
                                + '</svg>'
                            + '</button>';

                        const viewBtnTop = '<button type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 transition" data-row-action="1" data-view-intake="' + escapeHtml(top.id) + '" title="View">'
                            + '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                + '<path d="M2.062 12.348a1 1 0 0 1 0-.696C3.423 8.02 7.36 5 12 5c4.64 0 8.577 3.02 9.938 6.652a1 1 0 0 1 0 .696C20.577 15.98 16.64 19 12 19c-4.64 0-8.577-3.02-9.938-6.652" />'
                                + '<circle cx="12" cy="12" r="3" />'
                            + '</svg>'
                        + '</button>';

                        const expanded = !!expandedGroups[key];
                        const chevron = isDuplicateGroup
                            ? ('<button type="button" class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 text-slate-700" data-toggle-phone-group="' + escapeHtml(key) + '" title="Expand">'
                                + '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transition-transform ' + (expanded ? 'rotate-90' : '') + '" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                    + '<path d="M9 18l6-6-6-6" />'
                                + '</svg>'
                            + '</button>')
                            : '<span class="inline-flex items-center justify-center w-8 h-8 rounded-lg border border-transparent"></span>';

                        const dupBadge = isDuplicateGroup
                            ? ('<span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-extrabold bg-amber-50 text-amber-800 border border-amber-200">' + escapeHtml(String(group.length)) + '</span>')
                            : '';

                        html.push(
                            '<tr class="hover:bg-slate-50 cursor-pointer" data-view-intake="' + escapeHtml(top.id) + '">'
                            + '<td class="py-3 px-4 text-slate-900 font-semibold">'
                                + '<div class="flex items-center gap-2">'
                                    + chevron
                                    + '<div class="min-w-0">'
                                        + '<div class="truncate">' + escapeHtml(top.full_name || '-') + dupBadge + '</div>'
                                        + (isDuplicateGroup ? '<div class="text-xs text-slate-500 font-semibold">Duplicate submissions (phone)</div>' : '')
                                    + '</div>'
                                + '</div>'
                            + '</td>'
                            + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(top.phone || '-') + '</td>'
                            + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(top.journey_stage || '-') + '</td>'
                            + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(weeksWhileJoining(top)) + '</td>'
                            + '<td class="py-3 px-4 text-slate-600">' + escapeHtml(fmtDate(top.created_at)) + '</td>'
                            + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(top.hospital_planned || '-') + '</td>'
                            + '<td class="py-3 px-4">'
                                + '<div class="flex items-center justify-end gap-2">'
                                    + viewBtnTop
                                    + approveBtnTop
                                + '</div>'
                            + '</td>'
                            + '</tr>'
                        );

                        if (isDuplicateGroup && expanded) {
                            group.slice(1).forEach(function (r, idx) {
                                const approvedChild = isApproved(r);
                                const approveBtnChild = approvedChild
                                    ? '<span class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700" title="Approved">'
                                        + '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                            + '<path d="M20 6 9 17l-5-5" />'
                                        + '</svg>'
                                    + '</span>'
                                    : '<button type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 transition" data-row-action="1" data-approve-intake="' + escapeHtml(r.id) + '" data-approve-full-name="' + escapeHtml(r.full_name || '') + '" data-approve-phone="' + escapeHtml(r.phone || '') + '" title="Approve">'
                                        + '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                            + '<path d="M20 6 9 17l-5-5" />'
                                        + '</svg>'
                                    + '</button>';

                                const viewBtnChild = '<button type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 transition" data-row-action="1" data-view-intake="' + escapeHtml(r.id) + '" title="View">'
                                    + '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                        + '<path d="M2.062 12.348a1 1 0 0 1 0-.696C3.423 8.02 7.36 5 12 5c4.64 0 8.577 3.02 9.938 6.652a1 1 0 0 1 0 .696C20.577 15.98 16.64 19 12 19c-4.64 0-8.577-3.02-9.938-6.652" />'
                                        + '<circle cx="12" cy="12" r="3" />'
                                    + '</svg>'
                                + '</button>';

                                html.push(
                                    '<tr class="bg-white hover:bg-slate-50 cursor-pointer" data-view-intake="' + escapeHtml(r.id) + '">'
                                    + '<td class="py-3 pl-14 pr-4 text-slate-900 font-semibold">'
                                        + '<div class="flex items-center gap-2">'
                                            + '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-extrabold bg-slate-100 text-slate-700 border border-slate-200">#' + escapeHtml(String(idx + 2)) + '</span>'
                                            + '<span class="truncate">' + escapeHtml(r.full_name || '-') + '</span>'
                                        + '</div>'
                                    + '</td>'
                                    + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(r.phone || '-') + '</td>'
                                    + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(r.journey_stage || '-') + '</td>'
                                    + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(weeksWhileJoining(r)) + '</td>'
                                    + '<td class="py-3 px-4 text-slate-600">' + escapeHtml(fmtDate(r.created_at)) + '</td>'
                                    + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(r.hospital_planned || '-') + '</td>'
                                    + '<td class="py-3 px-4">'
                                        + '<div class="flex items-center justify-end gap-2">'
                                            + viewBtnChild
                                            + approveBtnChild
                                        + '</div>'
                                    + '</td>'
                                    + '</tr>'
                                );
                            });
                        }
                    });

                    tbody.innerHTML = html.join('');
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

                    if (!modalActionsEl) return;

                    const id = data && typeof data.id !== 'undefined' ? String(data.id) : '';
                    const approved = isApproved(data);
                    const editUrl = @json(url('/admin/forms/intakes')) + '/' + encodeURIComponent(id) + '/edit';

                    modalActionsEl.innerHTML = [
                        approved
                            ? '<span class="inline-flex items-center px-3 py-2 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-700 text-sm font-extrabold">Approved</span>'
                            : '<button type="button" id="modal-approve" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-extrabold transition" data-approve-intake="' + escapeHtml(id) + '" data-approve-full-name="' + escapeHtml((data && data.full_name) || '') + '" data-approve-phone="' + escapeHtml((data && data.phone) || '') + '">Approve</button>',
                        '<a href="' + escapeHtml(editUrl) + '" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-extrabold transition">Edit</a>',
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

                        const rows = json && json.data ? json.data : [];

                        await hydrateLocalStatus(rows);
                        renderRows(rows);

                        const first = Array.isArray(rows) ? rows[0] : null;
                        const topId = first && typeof first.id !== 'undefined' ? String(first.id) : null;
                        if (topId) {
                            lastSeenTopId = topId;
                        }

                        setPendingUpdates(0);

                        if (metaEl && meta) {
                            metaEl.textContent = 'Ukurasa ' + meta.current_page + ' / ' + meta.last_page + ' (Jumla: ' + meta.total + ')';
                        }

                        if (prevBtn) prevBtn.disabled = currentPage <= 1;
                        if (nextBtn) nextBtn.disabled = currentPage >= lastPage;
                    } catch (err) {
                        if (tbody) {
                            tbody.innerHTML = '<tr><td colspan="6" class="py-10 px-4 text-slate-500">Hakuna data kwa sasa.</td></tr>';
                        }
                        setError((err && err.message) ? err.message : 'Imeshindikana kupata data.');
                    }
                }

                async function openDetails(id) {
                    if (!detailsModal || !modalGridEl) return;
                    activeDetails = String(id);
                    modalTitleEl.textContent = 'Mother Intake #' + id;
                    modalGridEl.innerHTML = '<div class="md:col-span-2 px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm font-semibold">Inapakia...</div>';
                    if (modalActionsEl) modalActionsEl.innerHTML = '';
                    detailsModal.show();

                    try {
                        const url = new URL('api/mother-intakes/' + id, API_BASE_URL || window.location.origin);
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
                        setPendingUpdates(0);
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
                    const toggle = e.target.closest && e.target.closest('[data-toggle-phone-group]');
                    if (toggle) {
                        e.preventDefault();
                        e.stopPropagation();
                        const key = toggle.getAttribute('data-toggle-phone-group');
                        if (!key) return;
                        expandedGroups[key] = !expandedGroups[key];
                        fetchList();
                        return;
                    }

                    const btn = e.target.closest && e.target.closest('[data-view-intake]');
                    if (!btn) return;
                    if (btn.getAttribute('data-row-action')) {
                        e.preventDefault();
                        e.stopPropagation();
                    }
                    openDetails(btn.getAttribute('data-view-intake'));
                });

                document.addEventListener('click', function (e) {
                    const btn = e.target.closest && e.target.closest('[data-approve-intake]');
                    if (!btn) return;
                    e.preventDefault();
                    e.stopPropagation();
                    approveIntake(
                        btn.getAttribute('data-approve-intake'),
                        btn.getAttribute('data-approve-full-name'),
                        btn.getAttribute('data-approve-phone'),
                        btn
                    );
                });

                if (modalCloseEl) {
                    modalCloseEl.addEventListener('click', function () {
                        if (!detailsModal) return;
                        detailsModal.hide();
                    });
                }

                if (mkCloseEl) {
                    mkCloseEl.addEventListener('click', function () {
                        if (!editModal) return;
                        editModal.hide();
                    });
                }

                if (mkSaveBtn) {
                    mkSaveBtn.addEventListener('click', function () {
                        saveMk();
                    });
                }

                if (mkGenerateBtn) {
                    mkGenerateBtn.addEventListener('click', function () {
                        generateMk();
                    });
                }

                pollTimer = window.setInterval(pollForUpdates, 30000);
                fetchList();
            })();
        </script>
    </div>
</x-adminmodules::layouts.master>
