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
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                    <div>
                        <div class="text-sm text-slate-500">Mother Intake</div>
                        <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Hariri Intake</h1>
                        <p class="mt-2 text-slate-600">Badilisha taarifa na u-save kwenye database ya hapa (local). Ili u-save, lazima MK Number iwepo.</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ url('/admin/forms/intakes/'.$intakeId) }}" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">View Report</a>
                        <a href="{{ url('/admin/forms') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Rudi nyuma</a>
                    </div>
                </div>

                <div class="mt-6 bg-white rounded-2xl border border-slate-200 p-6">
                    <div class="text-xs font-bold text-slate-500 uppercase">MK Number</div>
                    <div class="mt-2 flex flex-col md:flex-row md:items-center gap-3">
                        <div class="flex items-center gap-2">
                            <div class="px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-extrabold text-slate-900">MK-</div>
                            <input id="mk-digits" class="w-full max-w-[240px] px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-900" placeholder="0001" inputmode="numeric" />
                        </div>
                        <div class="flex items-center gap-2">
                            <button id="mk-generate" type="button" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Generate</button>
                            <button id="mk-save" type="button" class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Hifadhi MK</button>
                        </div>
                        <div class="text-sm text-slate-500">ID: <span class="font-extrabold" id="intake-id">-</span></div>
                    </div>

                    <div class="mt-3 hidden" id="mk-error">
                        <div class="px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold"></div>
                    </div>

                    <div class="mt-3 hidden" id="mk-success">
                        <div class="px-4 py-3 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 text-sm font-semibold">MK Number imehifadhiwa. Sasa unaweza kuhifadhi mabadiliko ya taarifa.</div>
                    </div>
                </div>

                <div class="mt-6 hidden" id="page-error">
                    <div class="px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold"></div>
                </div>

                <div class="mt-6" id="page-loading">
                    <div class="bg-white rounded-2xl border border-slate-200 p-6 animate-pulse">
                        <div class="h-3 bg-slate-100 rounded w-1/4"></div>
                        <div class="mt-3 h-3 bg-slate-100 rounded w-1/2"></div>
                        <div class="mt-3 h-3 bg-slate-100 rounded w-1/3"></div>
                    </div>
                </div>

                <form class="mt-6 hidden" id="edit-form">
                    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6" id="edit-grid"></div>

                    <div class="mt-6 flex items-center justify-end gap-2">
                        <button id="btn-save" type="button" class="px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold transition disabled:opacity-60 disabled:cursor-not-allowed">Hifadhi Mabadiliko</button>
                    </div>

                    <div class="mt-3 hidden" id="save-status">
                        <div class="px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-800 text-sm font-semibold"></div>
                    </div>
                </form>

                @include('adminmodules::partials.footer')
            </main>
        </div>

        <script>
            (function () {
                const id = @json($intakeId ?? null);
                const API_BASE_URL = @json(rtrim((string) config('app.api_base_url'), '/').'/');

                const loadingEl = document.getElementById('page-loading');
                const errorWrapEl = document.getElementById('page-error');
                const errorTextEl = errorWrapEl ? errorWrapEl.querySelector('div') : null;

                const mkDigitsEl = document.getElementById('mk-digits');
                const mkGenerateBtn = document.getElementById('mk-generate');
                const mkSaveBtn = document.getElementById('mk-save');
                const mkErrorWrapEl = document.getElementById('mk-error');
                const mkErrorTextEl = mkErrorWrapEl ? mkErrorWrapEl.querySelector('div') : null;
                const mkSuccessEl = document.getElementById('mk-success');

                const intakeIdEl = document.getElementById('intake-id');

                const formEl = document.getElementById('edit-form');
                const gridEl = document.getElementById('edit-grid');
                const saveBtn = document.getElementById('btn-save');
                const saveStatusWrap = document.getElementById('save-status');
                const saveStatusText = saveStatusWrap ? saveStatusWrap.querySelector('div') : null;

                let hasMk = false;

                function escapeHtml(str) {
                    return String(str ?? '')
                        .replaceAll('&', '&amp;')
                        .replaceAll('<', '&lt;')
                        .replaceAll('>', '&gt;')
                        .replaceAll('"', '&quot;')
                        .replaceAll("'", '&#039;');
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

                function setMkError(message) {
                    if (!mkErrorWrapEl || !mkErrorTextEl) return;
                    mkErrorTextEl.textContent = message;
                    mkErrorWrapEl.classList.remove('hidden');
                }

                function clearMkError() {
                    if (!mkErrorWrapEl) return;
                    mkErrorWrapEl.classList.add('hidden');
                }

                function setSaveStatus(message, kind) {
                    if (!saveStatusWrap || !saveStatusText) return;
                    saveStatusText.textContent = message;
                    saveStatusWrap.classList.remove('hidden');
                    const box = saveStatusText;
                    box.parentElement.classList.remove('border-rose-200', 'bg-rose-50', 'text-rose-800', 'border-emerald-200', 'bg-emerald-50', 'text-emerald-800', 'border-slate-200', 'bg-slate-50', 'text-slate-800');
                    if (kind === 'success') {
                        box.parentElement.classList.add('border-emerald-200', 'bg-emerald-50', 'text-emerald-800');
                    } else if (kind === 'error') {
                        box.parentElement.classList.add('border-rose-200', 'bg-rose-50', 'text-rose-800');
                    } else {
                        box.parentElement.classList.add('border-slate-200', 'bg-slate-50', 'text-slate-800');
                    }
                }

                function setHasMk(on) {
                    hasMk = !!on;
                    if (saveBtn) saveBtn.disabled = !hasMk;
                    if (mkSuccessEl) mkSuccessEl.classList.toggle('hidden', !hasMk);
                }

                function control(label, key, value, type) {
                    const v = (value === null || typeof value === 'undefined') ? '' : value;

                    if (type === 'bool') {
                        const checked = v ? 'checked' : '';
                        return (
                            '<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">'
                            + '<div class="px-6 py-4 border-b border-slate-200 bg-slate-50">'
                            + '<div class="text-sm font-extrabold text-slate-900">' + escapeHtml(label) + '</div>'
                            + '</div>'
                            + '<div class="p-6">'
                            + '<label class="inline-flex items-center gap-3">'
                            + '<input type="checkbox" class="h-5 w-5" data-key="' + escapeHtml(key) + '" ' + checked + ' />'
                            + '<span class="text-sm font-semibold text-slate-700">Ndiyo</span>'
                            + '</label>'
                            + '</div>'
                            + '</div>'
                        );
                    }

                    if (type === 'textarea') {
                        return (
                            '<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">'
                            + '<div class="px-6 py-4 border-b border-slate-200 bg-slate-50">'
                            + '<div class="text-sm font-extrabold text-slate-900">' + escapeHtml(label) + '</div>'
                            + '</div>'
                            + '<div class="p-6">'
                            + '<textarea rows="4" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-900 outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500" data-key="' + escapeHtml(key) + '">' + escapeHtml(v) + '</textarea>'
                            + '</div>'
                            + '</div>'
                        );
                    }

                    if (key === 'journey_stage') {
                        const options = ['pregnant', 'postpartum', 'ttc', 'other'];
                        const opts = ['<option value="">-</option>'].concat(options.map(function (o) {
                            const sel = String(v) === o ? 'selected' : '';
                            return '<option value="' + escapeHtml(o) + '" ' + sel + '>' + escapeHtml(o) + '</option>';
                        })).join('');

                        return (
                            '<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">'
                            + '<div class="px-6 py-4 border-b border-slate-200 bg-slate-50">'
                            + '<div class="text-sm font-extrabold text-slate-900">' + escapeHtml(label) + '</div>'
                            + '</div>'
                            + '<div class="p-6">'
                            + '<select class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-900 outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500" data-key="' + escapeHtml(key) + '">' + opts + '</select>'
                            + '</div>'
                            + '</div>'
                        );
                    }

                    return (
                        '<div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">'
                        + '<div class="px-6 py-4 border-b border-slate-200 bg-slate-50">'
                        + '<div class="text-sm font-extrabold text-slate-900">' + escapeHtml(label) + '</div>'
                        + '</div>'
                        + '<div class="p-6">'
                        + '<input type="text" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-slate-900 outline-none focus:ring-2 focus:ring-emerald-500/30 focus:border-emerald-500" data-key="' + escapeHtml(key) + '" value="' + escapeHtml(String(v)) + '" />'
                        + '</div>'
                        + '</div>'
                    );
                }

                function renderForm(data) {
                    if (!gridEl) return;
                    const d = data || {};

                    const interests = Array.isArray(d.interests) ? d.interests.join(', ') : (d.interests || '');

                    const fields = [
                        { label: 'Full Name', key: 'full_name' },
                        { label: 'Whatsapp Number', key: 'phone' },
                        { label: 'Email', key: 'email' },
                        { label: 'Age', key: 'age' },
                        { label: 'Location', key: 'location' },
                        { label: 'Journey Stage', key: 'journey_stage' },
                        { label: 'Pregnancy Weeks', key: 'pregnancy_weeks' },
                        { label: 'Baby Weeks Old', key: 'baby_weeks_old' },
                        { label: 'Pregnancy Stage', key: 'pregnancy_stage' },
                        { label: 'Due Date', key: 'due_date' },
                        { label: 'Previous Pregnancies', key: 'previous_pregnancies' },
                        { label: 'Hospital Planned', key: 'hospital_planned' },
                        { label: 'Hospital Alternative', key: 'hospital_alternative' },
                        { label: 'Delivery Hospital', key: 'delivery_hospital' },
                        { label: 'Birth Hospital', key: 'birth_hospital' },
                        { label: 'TTC Duration', key: 'ttc_duration' },
                        { label: 'Interests (comma separated)', key: 'interests', value: interests },
                        { label: 'Concerns', key: 'concerns', type: 'textarea' },
                        { label: 'Notes', key: 'notes', type: 'textarea' },
                        { label: 'Agree Comms', key: 'agree_comms', type: 'bool' },
                        { label: 'Disclaimer Ack', key: 'disclaimer_ack', type: 'bool' },
                        { label: 'Status', key: 'status' },
                        { label: 'Priority', key: 'priority' },
                    ];

                    gridEl.innerHTML = fields.map(function (f) {
                        const val = (typeof f.value !== 'undefined') ? f.value : d[f.key];
                        return control(f.label, f.key, val, f.type || 'text');
                    }).join('');

                    if (formEl) formEl.classList.remove('hidden');
                }

                async function loadLocal() {
                    try {
                        const url = @json(url('/admin/forms/mother-intakes')) + '/' + encodeURIComponent(String(id)) + '/local';
                        const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) return null;
                        const json = await res.json().catch(function () { return null; });
                        return json && json.data ? json.data : null;
                    } catch (e) {
                        return null;
                    }
                }

                async function loadRemote() {
                    const detailsUrl = new URL('api/mother-intakes/' + encodeURIComponent(String(id)), API_BASE_URL || window.location.origin);
                    const res = await fetch(detailsUrl.toString(), { headers: { 'Accept': 'application/json' } });
                    if (!res.ok) return null;
                    const json = await res.json().catch(function () { return null; });
                    return json && json.data ? json.data : null;
                }

                async function loadMkDigits() {
                    try {
                        const url = @json(url('/admin/forms/mother-intakes')) + '/' + encodeURIComponent(String(id)) + '/mk';
                        const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) return null;
                        const json = await res.json().catch(function () { return null; });
                        const mkNumber = json && json.data ? json.data.mk_number : null;
                        if (mkNumber && String(mkNumber).startsWith('MK-')) return String(mkNumber).slice(3);
                        return null;
                    } catch (e) {
                        return null;
                    }
                }

                async function saveMkDigits() {
                    clearMkError();
                    if (!mkDigitsEl) return;
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
                        const url = @json(url('/admin/forms/mother-intakes')) + '/' + encodeURIComponent(String(id)) + '/mk';
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': @json(csrf_token()),
                            },
                            body: JSON.stringify({ mk_digits: digits }),
                        });

                        const json = await res.json().catch(function () { return null; });
                        if (!res.ok) {
                            setMkError((json && json.message) ? json.message : 'Imeshindikana kuhifadhi MK.');
                            return;
                        }

                        setHasMk(true);
                    } catch (e) {
                        setMkError('Imeshindikana kuhifadhi MK.');
                    } finally {
                        if (mkSaveBtn) {
                            mkSaveBtn.disabled = false;
                            mkSaveBtn.textContent = 'Hifadhi MK';
                        }
                    }
                }

                async function generateMk() {
                    clearMkError();
                    if (mkGenerateBtn) {
                        mkGenerateBtn.disabled = true;
                        mkGenerateBtn.textContent = 'Inatengeneza...';
                    }

                    try {
                        const url = @json(url('/admin/forms/mother-intakes')) + '/' + encodeURIComponent(String(id)) + '/mk/generate';
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': @json(csrf_token()),
                            },
                            body: JSON.stringify({}),
                        });

                        const json = await res.json().catch(function () { return null; });
                        if (!res.ok) {
                            setMkError((json && json.message) ? json.message : 'Imeshindikana kutengeneza MK.');
                            return;
                        }

                        const mkNumber = json && json.data ? json.data.mk_number : null;
                        if (mkNumber && mkDigitsEl) {
                            mkDigitsEl.value = String(mkNumber).startsWith('MK-') ? String(mkNumber).slice(3) : '';
                        }
                        setHasMk(true);
                    } catch (e) {
                        setMkError('Imeshindikana kutengeneza MK.');
                    } finally {
                        if (mkGenerateBtn) {
                            mkGenerateBtn.disabled = false;
                            mkGenerateBtn.textContent = 'Generate';
                        }
                    }
                }

                async function saveDetails() {
                    if (!hasMk) {
                        setSaveStatus('Huwezi kuhifadhi taarifa mpaka MK Number iwepo.', 'error');
                        return;
                    }

                    if (!gridEl) return;
                    if (saveBtn) {
                        saveBtn.disabled = true;
                        saveBtn.textContent = 'Inahifadhi...';
                    }

                    try {
                        const data = {};
                        gridEl.querySelectorAll('[data-key]').forEach(function (el) {
                            const key = el.getAttribute('data-key');
                            if (!key) return;
                            if (el.type === 'checkbox') {
                                data[key] = !!el.checked;
                                return;
                            }
                            data[key] = el.value;
                        });

                        if (typeof data.interests === 'string') {
                            const parts = data.interests.split(',').map(function (s) { return s.trim(); }).filter(Boolean);
                            data.interests = parts;
                        }

                        const url = @json(url('/admin/forms/mother-intakes')) + '/' + encodeURIComponent(String(id)) + '/details';
                        const res = await fetch(url, {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': @json(csrf_token()),
                            },
                            body: JSON.stringify({ data: data }),
                        });

                        const json = await res.json().catch(function () { return null; });
                        if (!res.ok) {
                            setSaveStatus((json && json.message) ? json.message : 'Imeshindikana kuhifadhi mabadiliko.', 'error');
                            return;
                        }

                        setSaveStatus('Mabadiliko yamehifadhiwa kwenye DB ya hapa (local).', 'success');
                    } catch (e) {
                        setSaveStatus('Imeshindikana kuhifadhi mabadiliko.', 'error');
                    } finally {
                        if (saveBtn) {
                            saveBtn.disabled = !hasMk;
                            saveBtn.textContent = 'Hifadhi Mabadiliko';
                        }
                    }
                }

                async function boot() {
                    clearError();
                    if (intakeIdEl) intakeIdEl.textContent = String(id ?? '-');

                    if (!id) {
                        setError('ID haijapatikana.');
                        if (loadingEl) loadingEl.classList.add('hidden');
                        return;
                    }

                    const mkDigits = await loadMkDigits();
                    if (mkDigitsEl && mkDigits) {
                        mkDigitsEl.value = mkDigits;
                        setHasMk(true);
                    } else {
                        setHasMk(false);
                    }

                    const local = await loadLocal();
                    if (local && local.mk_number) {
                        renderForm(local);
                        setHasMk(true);
                        if (mkDigitsEl && local.mk_number && String(local.mk_number).startsWith('MK-')) {
                            mkDigitsEl.value = String(local.mk_number).slice(3);
                        }
                    } else {
                        const remote = await loadRemote();
                        if (!remote) {
                            setError('Imeshindikana kupata taarifa za intake.');
                        } else {
                            renderForm(remote);
                        }
                    }

                    if (loadingEl) loadingEl.classList.add('hidden');
                }

                if (mkGenerateBtn) mkGenerateBtn.addEventListener('click', generateMk);
                if (mkSaveBtn) mkSaveBtn.addEventListener('click', saveMkDigits);
                if (saveBtn) saveBtn.addEventListener('click', saveDetails);

                boot();
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
