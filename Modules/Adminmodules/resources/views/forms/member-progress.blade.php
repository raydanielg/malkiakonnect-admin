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
                    <div class="text-sm text-slate-500">Progress</div>
                    <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Member Progress</h1>
                    <p class="mt-2 text-slate-600">Inaonyesha hatua za ujauzito/uzazi kwa mwezi-mwezi, kuanzia mwanzo mpaka leo (au mpaka amejifungua).</p>

                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <a href="{{ url('/admin/forms/membership') }}" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Rudi Members</a>
                        <a href="{{ url('/admin/forms/intakes/'.(int) $intakeId.'/edit') }}" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Edit</a>
                    </div>
                </div>

                <div class="mt-6 grid grid-cols-1 lg:grid-cols-3 gap-4" id="progress-summary"></div>

                <div class="mt-6 bg-white rounded-2xl border border-slate-200 p-6">
                    <div class="text-sm text-slate-500">Completion</div>
                    <h2 class="mt-1 text-lg font-extrabold text-slate-900">Work Status</h2>

                    <div class="mt-4 grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <div class="p-4 rounded-2xl border border-slate-200 bg-slate-50">
                            <div class="text-[11px] font-extrabold text-slate-500 uppercase">Reviewed</div>
                            <div class="mt-1 text-sm font-extrabold text-slate-900" id="reviewed-state">-</div>
                            <button id="btn-reviewed" type="button" class="mt-3 w-full px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-extrabold transition">Mark Reviewed</button>
                        </div>
                        <div class="p-4 rounded-2xl border border-slate-200 bg-slate-50">
                            <div class="text-[11px] font-extrabold text-slate-500 uppercase">Completed</div>
                            <div class="mt-1 text-sm font-extrabold text-slate-900" id="completed-state">-</div>
                            <button id="btn-completed" type="button" class="mt-3 w-full px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold transition">Mark Completed</button>
                        </div>
                        <div class="p-4 rounded-2xl border border-slate-200 bg-white">
                            <div class="text-[11px] font-extrabold text-slate-500 uppercase">Comment</div>
                            <textarea id="progress-comment" rows="4" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-200" placeholder="Andika comment..." ></textarea>
                            <button id="btn-save-comment" type="button" class="mt-3 w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-extrabold transition">Save Comment</button>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="flex items-center justify-between gap-3">
                        <h2 class="text-lg font-extrabold text-slate-900">Timeline</h2>
                        <button id="btn-refresh" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Onyesha upya</button>
                    </div>

                    <div class="mt-4 hidden" id="progress-error">
                        <div class="px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold"></div>
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4" id="progress-grid">
                        <div class="p-6 rounded-2xl border border-slate-200 bg-white text-slate-600">Inapakia...</div>
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
                const intakeId = @json((int) $intakeId);
                const gridEl = document.getElementById('progress-grid');
                const summaryEl = document.getElementById('progress-summary');
                const refreshBtn = document.getElementById('btn-refresh');
                const reviewedStateEl = document.getElementById('reviewed-state');
                const completedStateEl = document.getElementById('completed-state');
                const reviewedBtn = document.getElementById('btn-reviewed');
                const completedBtn = document.getElementById('btn-completed');
                const commentEl = document.getElementById('progress-comment');
                const saveCommentBtn = document.getElementById('btn-save-comment');
                const errorWrapEl = document.getElementById('progress-error');
                const errorTextEl = errorWrapEl ? errorWrapEl.querySelector('div') : null;

                const csrfToken = @json(csrf_token());

                let current = null;

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

                function fmtDate(dateString) {
                    if (!dateString) return '-';
                    const s = String(dateString);
                    return s.slice(0, 10) || '-';
                }

                function renderCompletion(data) {
                    if (reviewedStateEl) {
                        reviewedStateEl.textContent = data && data.reviewed_at ? ('Ndiyo (' + fmtDate(data.reviewed_at) + ')') : 'Hapana';
                    }
                    if (completedStateEl) {
                        completedStateEl.textContent = data && data.completed_at ? ('Ndiyo (' + fmtDate(data.completed_at) + ')') : 'Hapana';
                    }
                    if (commentEl) {
                        const v = (data && (data.progress_comment || data.notes)) ? String(data.progress_comment || data.notes) : '';
                        if (commentEl.value !== v) {
                            commentEl.value = v;
                        }
                    }

                    if (reviewedBtn) {
                        reviewedBtn.disabled = !!(data && data.reviewed_at);
                        reviewedBtn.classList.toggle('opacity-50', reviewedBtn.disabled);
                        reviewedBtn.classList.toggle('cursor-not-allowed', reviewedBtn.disabled);
                    }
                    if (completedBtn) {
                        completedBtn.disabled = !!(data && data.completed_at);
                        completedBtn.classList.toggle('opacity-50', completedBtn.disabled);
                        completedBtn.classList.toggle('cursor-not-allowed', completedBtn.disabled);
                    }
                }

                function card(label, value) {
                    return [
                        '<div class="p-5 rounded-2xl border border-slate-200 bg-white">',
                        '<div class="text-[11px] font-extrabold text-slate-500 uppercase">' + escapeHtml(label) + '</div>',
                        '<div class="mt-1 text-base font-extrabold text-slate-900 break-words">' + escapeHtml(value ?? '-') + '</div>',
                        '</div>'
                    ].join('');
                }

                function monthLabel(d) {
                    try {
                        return d.toLocaleString(undefined, { month: 'long', year: 'numeric' });
                    } catch (e) {
                        return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0');
                    }
                }

                function startOfMonth(d) {
                    return new Date(d.getFullYear(), d.getMonth(), 1);
                }

                function addMonths(d, n) {
                    return new Date(d.getFullYear(), d.getMonth() + n, 1);
                }

                function diffWeeks(a, b) {
                    const ms = b.getTime() - a.getTime();
                    return Math.floor(ms / (7 * 24 * 60 * 60 * 1000));
                }

                function buildTimeline(data) {
                    const today = new Date();

                    const journey = String(data && data.journey_stage ? data.journey_stage : '').toLowerCase();
                    const pregnancyWeeks = (data && data.pregnancy_weeks != null) ? Number(data.pregnancy_weeks) : null;
                    const babyWeeks = (data && data.baby_weeks_old != null) ? Number(data.baby_weeks_old) : null;

                    let dueDate = null;
                    if (data && data.due_date) {
                        const dd = new Date(String(data.due_date).slice(0, 10));
                        if (!isNaN(dd.getTime())) dueDate = dd;
                    }

                    let startDate = null;
                    let endDate = today;

                    if (journey === 'postpartum' && babyWeeks != null && !isNaN(babyWeeks)) {
                        const birth = new Date(today.getTime() - (babyWeeks * 7 * 24 * 60 * 60 * 1000));
                        endDate = birth;
                        startDate = new Date(birth.getTime() - (40 * 7 * 24 * 60 * 60 * 1000));
                    } else if (dueDate) {
                        startDate = new Date(dueDate.getTime() - (40 * 7 * 24 * 60 * 60 * 1000));
                        endDate = today;
                    } else if (pregnancyWeeks != null && !isNaN(pregnancyWeeks)) {
                        startDate = new Date(today.getTime() - (pregnancyWeeks * 7 * 24 * 60 * 60 * 1000));
                        endDate = today;
                    } else {
                        startDate = new Date(today.getTime() - (12 * 7 * 24 * 60 * 60 * 1000));
                        endDate = today;
                    }

                    if (startDate.getTime() > endDate.getTime()) {
                        const tmp = startDate;
                        startDate = endDate;
                        endDate = tmp;
                    }

                    const monthStart = startOfMonth(startDate);
                    const monthEnd = startOfMonth(endDate);

                    const items = [];
                    let cursor = monthStart;
                    let guard = 0;
                    while (cursor.getTime() <= monthEnd.getTime() && guard < 120) {
                        guard++;

                        const next = addMonths(cursor, 1);
                        const weekStart = diffWeeks(startDate, cursor) + 1;
                        const weekEnd = diffWeeks(startDate, next);

                        items.push({
                            month: new Date(cursor.getTime()),
                            weekStart: Math.max(1, weekStart),
                            weekEnd: Math.max(weekStart, weekEnd),
                        });

                        cursor = next;
                    }

                    return { startDate, endDate, items };
                }

                function renderTimeline(data) {
                    if (!gridEl || !summaryEl) return;

                    renderCompletion(data);

                    const timeline = buildTimeline(data);
                    const notes = data && (data.progress_comment || data.notes) ? String(data.progress_comment || data.notes) : '';

                    summaryEl.innerHTML = [
                        card('MK Number', data && data.mk_number),
                        card('Journey Stage', data && data.journey_stage),
                        card('Range', fmtDate(timeline.startDate.toISOString()) + ' mpaka ' + fmtDate(timeline.endDate.toISOString())),
                    ].join('');

                    gridEl.innerHTML = timeline.items.map(function (it) {
                        const comment = notes ? notes : '-';

                        const reviewed = data && data.reviewed_at ? 'Ndiyo (' + fmtDate(data.reviewed_at) + ')' : 'Hapana';
                        const completed = data && data.completed_at ? 'Ndiyo (' + fmtDate(data.completed_at) + ')' : 'Hapana';

                        return [
                            '<div class="p-6 rounded-2xl border border-slate-200 bg-white">',
                            '<div class="flex items-start justify-between gap-3">',
                            '<div>',
                            '<div class="text-xs font-extrabold text-slate-500 uppercase">' + escapeHtml(monthLabel(it.month)) + '</div>',
                            '<div class="mt-1 text-lg font-extrabold text-slate-900">Wiki ' + escapeHtml(String(it.weekStart)) + ' - ' + escapeHtml(String(it.weekEnd)) + '</div>',
                            '</div>',
                            '<div class="text-xs font-extrabold px-2.5 py-1 rounded-full bg-slate-100 text-slate-700 border border-slate-200">' + escapeHtml(String(data && data.status ? data.status : '')) + '</div>',
                            '</div>',
                            '<div class="mt-4 grid grid-cols-1 gap-2">',
                            '<div class="p-3 rounded-xl border border-slate-200 bg-slate-50">',
                            '<div class="text-[11px] font-extrabold text-slate-500 uppercase">Comment</div>',
                            '<div class="mt-1 text-sm font-semibold text-slate-900 whitespace-pre-line">' + escapeHtml(comment) + '</div>',
                            '</div>',
                            '<div class="grid grid-cols-2 gap-2">',
                            '<div class="p-3 rounded-xl border border-slate-200 bg-white">',
                            '<div class="text-[11px] font-extrabold text-slate-500 uppercase">Reviewed</div>',
                            '<div class="mt-1 text-sm font-semibold text-slate-900">' + escapeHtml(reviewed) + '</div>',
                            '</div>',
                            '<div class="p-3 rounded-xl border border-slate-200 bg-white">',
                            '<div class="text-[11px] font-extrabold text-slate-500 uppercase">Completed</div>',
                            '<div class="mt-1 text-sm font-semibold text-slate-900">' + escapeHtml(completed) + '</div>',
                            '</div>',
                            '</div>',
                            '</div>',
                            '</div>'
                        ].join('');
                    }).join('');
                }

                async function fetchData() {
                    clearError();
                    if (gridEl) gridEl.innerHTML = '<div class="p-6 rounded-2xl border border-slate-200 bg-white text-slate-600">Inapakia...</div>';

                    try {
                        const url = new URL(@json(url('/api/mother-intakes')) + '/' + encodeURIComponent(String(intakeId)));
                        const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) {
                            const text = await res.text().catch(function () { return ''; });
                            throw new Error(text ? (text.slice(0, 220) + (text.length > 220 ? '...' : '')) : 'Imeshindikana kupata taarifa za progress.');
                        }

                        const json = await res.json();
                        current = json && json.data ? json.data : null;
                        renderTimeline(current);
                    } catch (e) {
                        setError((e && e.message) ? e.message : 'Imeshindikana kupata taarifa za progress.');
                        if (gridEl) gridEl.innerHTML = '<div class="p-6 rounded-2xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold">Imeshindikana kupata taarifa.</div>';
                    }
                }

                async function saveProgress(payload) {
                    clearError();

                    try {
                        const res = await fetch(@json(url('/admin/forms/members')) + '/' + encodeURIComponent(String(intakeId)) + '/progress', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: JSON.stringify(payload || {}),
                        });

                        if (!res.ok) {
                            const text = await res.text().catch(function () { return ''; });
                            throw new Error(text ? (text.slice(0, 220) + (text.length > 220 ? '...' : '')) : 'Imeshindikana kuhifadhi progress.');
                        }

                        const json = await res.json();
                        current = json && json.data ? json.data : current;
                        renderTimeline(current);
                    } catch (e) {
                        setError((e && e.message) ? e.message : 'Imeshindikana kuhifadhi progress.');
                    }
                }

                if (refreshBtn) {
                    refreshBtn.addEventListener('click', function () {
                        fetchData();
                    });
                }

                if (reviewedBtn) {
                    reviewedBtn.addEventListener('click', function () {
                        saveProgress({ action: 'reviewed' });
                    });
                }

                if (completedBtn) {
                    completedBtn.addEventListener('click', function () {
                        saveProgress({ action: 'completed' });
                    });
                }

                if (saveCommentBtn) {
                    saveCommentBtn.addEventListener('click', function () {
                        saveProgress({ action: 'comment', comment: commentEl ? commentEl.value : '' });
                    });
                }

                fetchData();
            })();
        </script>
    </div>
</x-adminmodules::layouts.master>
