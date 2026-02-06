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
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <div class="text-sm text-slate-500">Mother Intake</div>
                        <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Intake Details</h1>
                    </div>

                    <div class="flex items-center gap-2">
                        <button id="btn-toggle-edit" type="button" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Washa Uhariri</button>
                        <a href="{{ url('/admin/forms') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Rudi nyuma</a>
                    </div>
                </div>

                <div class="mt-6 bg-white rounded-2xl border border-slate-200 p-6">
                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                        <div class="flex-1">
                            <div class="text-xs font-bold text-slate-500 uppercase">MK Number</div>
                            <div class="mt-2 flex items-center flex-wrap gap-2">
                                <div class="px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-extrabold text-slate-900">MK-</div>
                                <input id="mk-digits" class="w-full max-w-[220px] px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900" placeholder="0001" inputmode="numeric" />
                                <button id="mk-generate" type="button" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Generate</button>
                                <button id="mk-save" type="button" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Hifadhi</button>
                            </div>
                            <div class="mt-2 text-xs text-slate-500">Namba lazima iwe unique. Prefix ya <span class="font-extrabold">MK-</span> haiwezi kubadilishwa.</div>
                            <div class="mt-3 hidden" id="mk-error">
                                <div class="px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold"></div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center gap-2">
                            <div class="px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm font-semibold">ID: <span class="font-extrabold" id="intake-id">-</span></div>
                            <div class="px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm font-semibold">Tarehe: <span class="font-extrabold" id="intake-date">-</span></div>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 rounded-2xl border border-slate-200 bg-white">
                            <div class="text-[11px] font-extrabold text-slate-500 uppercase">Full Name</div>
                            <div class="mt-1 text-sm font-semibold text-slate-900" id="intake-full-name">-</div>
                        </div>
                        <div class="p-4 rounded-2xl border border-slate-200 bg-white">
                            <div class="text-[11px] font-extrabold text-slate-500 uppercase">Whatsapp Number</div>
                            <div class="mt-1 text-sm font-semibold text-slate-900" id="intake-phone">-</div>
                        </div>
                        <div class="p-4 rounded-2xl border border-slate-200 bg-white">
                            <div class="text-[11px] font-extrabold text-slate-500 uppercase">Journey Stage</div>
                            <div class="mt-1 text-sm font-semibold text-slate-900" id="intake-journey">-</div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 hidden" id="details-error">
                    <div class="px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold"></div>
                </div>

                <div class="mt-6" id="details-loading">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 animate-pulse">
                        <div class="h-3 bg-slate-100 rounded w-1/4"></div>
                        <div class="mt-3 h-3 bg-slate-100 rounded w-1/2"></div>
                        <div class="mt-3 h-3 bg-slate-100 rounded w-1/3"></div>
                    </div>
                </div>

                <div class="mt-6 hidden grid grid-cols-1 xl:grid-cols-2 gap-6" id="details-grid"></div>

                @include('adminmodules::partials.footer')
            </main>
        </div>

        <script>
            (function () {
                function escapeHtml(str) {
                    return String(str ?? '')
                        .replaceAll('&', '&amp;')
                        .replaceAll('<', '&lt;')
                        .replaceAll('>', '&gt;')
                        .replaceAll('"', '&quot;')
                        .replaceAll("'", '&#039;');
                }

                function setError(message) {
                    const wrap = document.getElementById('details-error');
                    const text = wrap ? wrap.querySelector('div') : null;
                    if (!wrap || !text) return;
                    text.textContent = message;
                    wrap.classList.remove('hidden');
                }

                function clearError() {
                    const wrap = document.getElementById('details-error');
                    if (!wrap) return;
                    wrap.classList.add('hidden');
                }

                function fmtDate(dateString) {
                    if (!dateString) return '-';
                    const dateOnly = String(dateString).slice(0, 10);
                    return dateOnly || '-';
                }

                function card(title, items) {
                    const body = (items || []).map(function (it) {
                        return (
                            '<div class="p-4 rounded-2xl border border-slate-200 bg-white">'
                            + '<div class="text-[11px] font-extrabold text-slate-500 uppercase">' + escapeHtml(it.label) + '</div>'
                            + '<div class="mt-1 text-sm font-semibold text-slate-900 break-words">' + escapeHtml(it.value ?? '-') + '</div>'
                            + '</div>'
                        );
                    }).join('');

                    return (
                        '<section class="bg-white rounded-2xl border border-slate-200 overflow-hidden">'
                        + '<div class="px-6 py-4 border-b border-slate-200 bg-slate-50">'
                        + '<div class="text-sm font-extrabold text-slate-900">' + escapeHtml(title) + '</div>'
                        + '</div>'
                        + '<div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">'
                        + body
                        + '</div>'
                        + '</section>'
                    );
                }

                async function loadMkNumber(sourceId) {
                    try {
                        const url = @json(url('/admin/forms/mother-intakes')) + '/' + encodeURIComponent(String(sourceId)) + '/mk';
                        const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) return null;
                        const json = await res.json().catch(function () { return null; });
                        return json && json.data ? json.data.mk_number : null;
                    } catch (e) {
                        return null;
                    }
                }

                async function loadDetails() {
                    clearError();

                    const id = @json($intakeId ?? null);
                    const API_BASE_URL = @json(rtrim((string) config('app.api_base_url'), '/').'/');

                    const loadingEl = document.getElementById('details-loading');
                    const gridEl = document.getElementById('details-grid');

                    const mkNumberEl = document.getElementById('mk-number');
                    const intakeIdEl = document.getElementById('intake-id');
                    const intakeDateEl = document.getElementById('intake-date');
                    const fullNameEl = document.getElementById('intake-full-name');
                    const phoneEl = document.getElementById('intake-phone');
                    const journeyEl = document.getElementById('intake-journey');

                    if (intakeIdEl) intakeIdEl.textContent = String(id ?? '-');

                    if (!id) {
                        setError('ID haijapatikana.');
                        if (loadingEl) loadingEl.classList.add('hidden');
                        return;
                    }

                    try {
                        const detailsUrl = new URL('api/mother-intakes/' + encodeURIComponent(String(id)), API_BASE_URL || window.location.origin);
                        const res = await fetch(detailsUrl.toString(), { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) {
                            setError('Imeshindikana kupata taarifa za intake.');
                            return;
                        }

                        const json = await res.json();
                        const data = json && json.data ? json.data : null;
                        if (!data) {
                            setError('Hakuna taarifa zilizopatikana.');
                            return;
                        }

                        if (fullNameEl) fullNameEl.textContent = data.full_name || '-';
                        if (phoneEl) phoneEl.textContent = data.phone || '-';
                        if (journeyEl) journeyEl.textContent = data.journey_stage || '-';
                        if (intakeDateEl) intakeDateEl.textContent = fmtDate(data.created_at);

                        const mk = (data.mk_number || data.mkNumber) ? (data.mk_number || data.mkNumber) : (await loadMkNumber(id));
                        if (mkNumberEl) mkNumberEl.textContent = mk || '-';

                        const sections = [
                            {
                                title: 'Taarifa za Msingi',
                                items: [
                                    { label: 'Full Name', value: data.full_name },
                                    { label: 'Whatsapp Number', value: data.phone },
                                    { label: 'Journey Stage', value: data.journey_stage },
                                    { label: 'Interests', value: Array.isArray(data.interests) ? data.interests.join(', ') : data.interests },
                                ],
                            },
                            {
                                title: 'Ujauzito / Mtoto',
                                items: [
                                    { label: 'Pregnancy Weeks', value: data.pregnancy_weeks },
                                    { label: 'Baby Weeks Old', value: data.baby_weeks_old },
                                    { label: 'TTC Duration', value: data.ttc_duration },
                                ],
                            },
                            {
                                title: 'Hospitali',
                                items: [
                                    { label: 'Hospital Planned', value: data.hospital_planned },
                                    { label: 'Hospital Alternative', value: data.hospital_alternative },
                                    { label: 'Delivery Hospital', value: data.delivery_hospital },
                                    { label: 'Birth Hospital', value: data.birth_hospital },
                                ],
                            },
                            {
                                title: 'Ridhaa / Mawasiliano',
                                items: [
                                    { label: 'Agree Comms', value: (typeof data.agree_comms !== 'undefined') ? String(!!data.agree_comms) : null },
                                    { label: 'Disclaimer Ack', value: (typeof data.disclaimer_ack !== 'undefined') ? String(!!data.disclaimer_ack) : null },
                                ],
                            },
                        ];

                        const extraKeys = Object.keys(data || {}).filter(function (k) {
                            return ![
                                'id', 'full_name', 'phone', 'journey_stage', 'pregnancy_weeks', 'baby_weeks_old', 'ttc_duration',
                                'hospital_planned', 'hospital_alternative', 'delivery_hospital', 'birth_hospital',
                                'interests', 'agree_comms', 'disclaimer_ack', 'created_at', 'updated_at', 'mk_number', 'mkNumber'
                            ].includes(k);
                        });

                        if (extraKeys.length) {
                            sections.push({
                                title: 'Taarifa Nyingine',
                                items: extraKeys.sort().map(function (k) {
                                    const v = data[k];
                                    return { label: k, value: Array.isArray(v) ? v.join(', ') : v };
                                }),
                            });
                        }

                        if (gridEl) {
                            gridEl.innerHTML = sections.map(function (s) { return card(s.title, s.items); }).join('');
                            gridEl.classList.remove('hidden');
                        }
                    } catch (e) {
                        setError('Imeshindikana kupata taarifa za intake.');
                    } finally {
                        if (loadingEl) loadingEl.classList.add('hidden');
                    }
                }

                loadDetails();
            })();
        </script>

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
