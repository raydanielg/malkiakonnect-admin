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
                    <div class="text-sm text-slate-500">Approved Members</div>
                    <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Members</h1>
                    <p class="mt-2 text-slate-600">Hapa tunaonyesha walio-approve tu. Wale ambao hawaja-approve hawataonekana.</p>
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
                                    <div class="text-xs font-bold text-slate-500 uppercase">Journey Stage</div>
                                    <select id="filter-journey-stage" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 hover:bg-slate-50">
                                        <option value="">Zote</option>
                                        <option value="pregnant">pregnant</option>
                                        <option value="postpartum">postpartum</option>
                                        <option value="ttc">ttc</option>
                                        <option value="other">other</option>
                                    </select>
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-500 uppercase">Whatsapp Number</div>
                                    <input id="filter-phone" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Mfano: +2557..." />
                                </div>
                                <div>
                                    <div class="text-xs font-bold text-slate-500 uppercase">Full Name</div>
                                    <input id="filter-full-name" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Tafuta jina..." />
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="{{ url('/admin/forms/members/add') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-extrabold transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14m-7-7v14" />
                                    </svg>
                                    <span>Add</span>
                                </a>
                            </div>
                        </div>

                        <div class="mt-3 hidden" id="members-error">
                            <div class="px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold"></div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="text-xs uppercase text-slate-500 bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th class="text-left py-3 px-4">MK Number</th>
                                    <th class="text-left py-3 px-4">Full Name</th>
                                    <th class="text-left py-3 px-4">Whatsapp Number</th>
                                    <th class="text-left py-3 px-4">Progress</th>
                                    <th class="text-left py-3 px-4">Journey Stage</th>
                                    <th class="text-left py-3 px-4">Weeks while joining</th>
                                    <th class="text-left py-3 px-4">Date of Joining</th>
                                    <th class="text-left py-3 px-4">Approved Date</th>
                                    <th class="text-left py-3 px-4">Hospital Planned</th>
                                    <th class="text-right py-3 px-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="members-body" class="divide-y divide-slate-100">
                                <tr>
                                    <td colspan="10" class="py-10 px-4 text-slate-500">Inapakia...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-slate-200 bg-white flex items-center justify-between gap-3">
                        <div class="text-sm text-slate-600" id="members-meta"></div>
                        <div class="flex items-center gap-2">
                            <button id="btn-prev" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Nyuma</button>
                            <button id="btn-next" class="px-4 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Mbele</button>
                        </div>
                    </div>
                </div>

                <div id="member-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                        <div class="relative p-4 bg-white rounded-2xl border border-slate-200 shadow md:p-8">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="text-sm font-semibold text-slate-500">Maelezo ya Member</div>
                                    <h3 class="mt-1 text-2xl font-extrabold text-slate-900" id="member-modal-title">Member</h3>
                                </div>
                                <button id="member-close" type="button" class="py-2 px-4 text-sm font-semibold text-slate-600 bg-white rounded-xl border border-slate-200 hover:bg-slate-50">Funga</button>
                            </div>

                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4" id="member-modal-grid"></div>
                        </div>
                    </div>
                </div>

                <!-- Custom Delete Confirmation Modal -->
                <div id="delete-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-8">
                            <div class="mb-4 text-sm font-light text-gray-500 dark:text-gray-400 text-left">
                                <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Delete Member</h3>
                                <p>
                                    Je, una uhakika unataka kumfuta member <span id="delete-member-name" class="font-extrabold text-slate-900 dark:text-white"></span>? Kitendo hiki hakiwezi kurudishwa na data zake zote zitapotea.
                                </p>
                            </div>
                            <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                                <a href="#" class="font-medium text-emerald-600 dark:text-emerald-500 hover:underline">Learn more about deletion</a>
                                <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                                    <button id="delete-cancel" type="button" class="py-2 px-4 w-full text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 sm:w-auto hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-slate-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Hapana, Ghairi</button>
                                    <button id="delete-confirm" type="button" class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-rose-700 sm:w-auto hover:bg-rose-800 focus:ring-4 focus:outline-none focus:ring-rose-300 dark:bg-rose-600 dark:hover:bg-rose-700 dark:focus:ring-rose-800">Ndiyo, Futa</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="add-member-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
                    <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                        <div class="relative p-4 bg-white rounded-2xl border border-slate-200 shadow md:p-8">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <div class="text-sm font-semibold text-slate-500">New Member</div>
                                    <h3 class="mt-1 text-2xl font-extrabold text-slate-900">Add New Member</h3>
                                </div>
                                <button id="add-member-close" type="button" class="py-2 px-4 text-sm font-semibold text-slate-600 bg-white rounded-xl border border-slate-200 hover:bg-slate-50">Funga</button>
                            </div>

                            <div class="mt-5 hidden" id="add-member-error">
                                <div class="px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold"></div>
                            </div>

                            <div class="mt-6">
                                <div class="flex items-center justify-between">
                                    <div class="text-sm font-extrabold text-slate-900" id="add-member-step-title">Step 1: Basic Info</div>
                                    <div class="text-sm text-slate-500 font-semibold" id="add-member-step-indicator">1 / 3</div>
                                </div>

                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4" id="add-member-step-1">
                                    <div>
                                        <div class="text-xs font-bold text-slate-500 uppercase">Full Name</div>
                                        <input id="am-full-name" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Full name" />
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-500 uppercase">Whatsapp Number</div>
                                        <input id="am-phone" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="+2557..." />
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-500 uppercase">Email</div>
                                        <input id="am-email" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="email@example.com" />
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-500 uppercase">Age</div>
                                        <input id="am-age" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Age" inputmode="numeric" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="text-xs font-bold text-slate-500 uppercase">Location</div>
                                        <input id="am-location" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Location" />
                                    </div>
                                </div>

                                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 hidden" id="add-member-step-2">
                                    <div>
                                        <div class="text-xs font-bold text-slate-500 uppercase">Journey Stage</div>
                                        <select id="am-journey-stage" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 hover:bg-slate-50">
                                            <option value="">-</option>
                                            <option value="pregnant">pregnant</option>
                                            <option value="postpartum">postpartum</option>
                                            <option value="ttc">ttc</option>
                                            <option value="other">other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-500 uppercase">Due Date</div>
                                        <input id="am-due-date" type="date" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" />
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-500 uppercase">Pregnancy Weeks</div>
                                        <input id="am-pregnancy-weeks" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="e.g 12" inputmode="numeric" />
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-slate-500 uppercase">Baby Weeks Old</div>
                                        <input id="am-baby-weeks-old" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="e.g 4" inputmode="numeric" />
                                    </div>
                                    <div class="md:col-span-2">
                                        <div class="text-xs font-bold text-slate-500 uppercase">Hospital Planned</div>
                                        <input id="am-hospital" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Hospital planned" />
                                    </div>
                                </div>

                                <div class="mt-4 hidden" id="add-member-step-3">
                                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                        <div class="text-sm font-extrabold text-slate-900">Confirm</div>
                                        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                                            <div><span class="font-bold text-slate-600">Name:</span> <span id="am-c-name" class="font-extrabold text-slate-900">-</span></div>
                                            <div><span class="font-bold text-slate-600">Phone:</span> <span id="am-c-phone" class="font-extrabold text-slate-900">-</span></div>
                                            <div><span class="font-bold text-slate-600">Journey:</span> <span id="am-c-journey" class="font-extrabold text-slate-900">-</span></div>
                                            <div><span class="font-bold text-slate-600">Hospital:</span> <span id="am-c-hospital" class="font-extrabold text-slate-900">-</span></div>
                                        </div>
                                        <div class="mt-3 text-xs text-slate-500">MK Number itatengenezwa automatically na member atawekwa approved.</div>
                                    </div>

                                    <div class="mt-4">
                                        <div class="text-xs font-bold text-slate-500 uppercase">Notes</div>
                                        <textarea id="am-notes" rows="3" class="mt-1 w-full px-3 py-2.5 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800" placeholder="Notes..."></textarea>
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center justify-between gap-2">
                                    <button id="am-back" type="button" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Back</button>
                                    <div class="flex items-center gap-2">
                                        <button id="am-next" type="button" class="px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-semibold transition">Next</button>
                                        <button id="am-save" type="button" class="hidden px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Save Member</button>
                                    </div>
                                </div>
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
                const tbody = document.getElementById('members-body');
                const metaEl = document.getElementById('members-meta');

                const statusEl = document.getElementById('filter-status');
                const journeyStageEl = document.getElementById('filter-journey-stage');
                const phoneEl = document.getElementById('filter-phone');
                const fullNameEl = document.getElementById('filter-full-name');
                const addMemberBtn = document.getElementById('btn-add-member');
                const prevBtn = document.getElementById('btn-prev');
                const nextBtn = document.getElementById('btn-next');

                const modalEl = document.getElementById('member-modal');
                const modalTitleEl = document.getElementById('member-modal-title');
                const modalGridEl = document.getElementById('member-modal-grid');
                const modalCloseEl = document.getElementById('member-close');

                const errorWrapEl = document.getElementById('members-error');
                const errorTextEl = errorWrapEl ? errorWrapEl.querySelector('div') : null;

                const addModalEl = document.getElementById('add-member-modal');
                const addCloseEl = document.getElementById('add-member-close');
                const addErrorWrapEl = document.getElementById('add-member-error');
                const addErrorTextEl = addErrorWrapEl ? addErrorWrapEl.querySelector('div') : null;
                const stepTitleEl = document.getElementById('add-member-step-title');
                const stepIndicatorEl = document.getElementById('add-member-step-indicator');
                const step1El = document.getElementById('add-member-step-1');
                const step2El = document.getElementById('add-member-step-2');
                const step3El = document.getElementById('add-member-step-3');
                const amBackBtn = document.getElementById('am-back');
                const amNextBtn = document.getElementById('am-next');
                const amSaveBtn = document.getElementById('am-save');

                console.log('Flowbite Modal type check:', typeof Modal !== 'undefined' ? 'Defined' : 'Undefined');

                const addMemberModal = (addModalEl && typeof Modal !== 'undefined')
                    ? new Modal(addModalEl, { placement: 'center' })
                    : (function() { 
                        console.error('Modal class not found during initialization'); 
                        return null; 
                      })();

                if (addMemberModal) {
                    console.log('addMemberModal initialized successfully');
                }

                const amFullName = document.getElementById('am-full-name');
                const amPhone = document.getElementById('am-phone');
                const amEmail = document.getElementById('am-email');
                const amAge = document.getElementById('am-age');
                const amLocation = document.getElementById('am-location');
                const amJourney = document.getElementById('am-journey-stage');
                const amDueDate = document.getElementById('am-due-date');
                const amPregWeeks = document.getElementById('am-pregnancy-weeks');
                const amBabyWeeks = document.getElementById('am-baby-weeks-old');
                const amHospital = document.getElementById('am-hospital');
                const amNotes = document.getElementById('am-notes');
                const cName = document.getElementById('am-c-name');
                const cPhone = document.getElementById('am-c-phone');
                const cJourney = document.getElementById('am-c-journey');
                const cHospital = document.getElementById('am-c-hospital');

                let addStep = 1;

                let currentPage = 1;
                let lastPage = 1;
                let debounceTimer = null;

                const detailsModal = (modalEl && typeof Modal !== 'undefined')
                    ? new Modal(modalEl, { placement: 'center' })
                    : null;

                function setAddError(message) {
                    if (!addErrorWrapEl || !addErrorTextEl) return;
                    addErrorTextEl.textContent = message;
                    addErrorWrapEl.classList.remove('hidden');
                }

                function clearAddError() {
                    if (!addErrorWrapEl) return;
                    addErrorWrapEl.classList.add('hidden');
                }

                function renderAddStep() {
                    if (!stepTitleEl || !stepIndicatorEl || !step1El || !step2El || !step3El || !amBackBtn || !amNextBtn || !amSaveBtn) return;

                    stepIndicatorEl.textContent = String(addStep) + ' / 3';
                    step1El.classList.toggle('hidden', addStep !== 1);
                    step2El.classList.toggle('hidden', addStep !== 2);
                    step3El.classList.toggle('hidden', addStep !== 3);

                    amBackBtn.disabled = addStep === 1;
                    amBackBtn.classList.toggle('opacity-50', amBackBtn.disabled);
                    amBackBtn.classList.toggle('cursor-not-allowed', amBackBtn.disabled);

                    amNextBtn.classList.toggle('hidden', addStep === 3);
                    amSaveBtn.classList.toggle('hidden', addStep !== 3);

                    if (addStep === 1) stepTitleEl.textContent = 'Step 1: Basic Info';
                    if (addStep === 2) stepTitleEl.textContent = 'Step 2: Journey';
                    if (addStep === 3) stepTitleEl.textContent = 'Step 3: Confirm';

                    if (addStep === 3) {
                        if (cName) cName.textContent = (amFullName && amFullName.value) ? amFullName.value : '-';
                        if (cPhone) cPhone.textContent = (amPhone && amPhone.value) ? amPhone.value : '-';
                        if (cJourney) cJourney.textContent = (amJourney && amJourney.value) ? amJourney.value : '-';
                        if (cHospital) cHospital.textContent = (amHospital && amHospital.value) ? amHospital.value : '-';
                    }
                }
console.log('openAddMember called');
                     {
                       console.error('addMemberModal is not initialized');
                        
                    }
                function openAddMember() {
                    if (!addMemberModal) return;
                    clearAddError();
                    addStep = 1;
                    if (amFullName) amFullName.value = '';
                    if (amPhone) amPhone.value = '';
                    if (amEmail) amEmail.value = '';
                    if (amAge) amAge.value = '';
                    if (amLocation) amLocation.value = '';
                    if (amJourney) amJourney.value = '';
                    if (amDueDate) amDueDate.value = '';
                    if (amPregWeeks) amPregWeeks.value = '';
                    if (amBabyWeeks) amBabyWeeks.value = '';
                    if (amHospital) amHospital.value = '';
                    if (amNotes) amNotes.value = '';
                    renderAddStep();
                    addMemberModal.show();
                }

                async function saveNewMember() {
                    clearAddError();
                    const fullName = (amFullName && amFullName.value) ? String(amFullName.value).trim() : '';
                    const phone = (amPhone && amPhone.value) ? String(amPhone.value).trim() : '';

                    if (fullName === '') {
                        setAddError('Weka Full Name.');
                        return;
                    }
                    if (phone === '') {
                        setAddError('Weka Whatsapp Number.');
                        return;
                    }

                    const payload = {
                        full_name: fullName,
                        phone: phone,
                        email: amEmail ? String(amEmail.value || '').trim() : '',
                        age: amAge && String(amAge.value || '').trim() !== '' ? Number(amAge.value) : null,
                        location: amLocation ? String(amLocation.value || '').trim() : '',
                        journey_stage: amJourney ? String(amJourney.value || '').trim() : '',
                        pregnancy_weeks: amPregWeeks && String(amPregWeeks.value || '').trim() !== '' ? Number(amPregWeeks.value) : null,
                        baby_weeks_old: amBabyWeeks && String(amBabyWeeks.value || '').trim() !== '' ? Number(amBabyWeeks.value) : null,
                        due_date: amDueDate ? (amDueDate.value || null) : null,
                        hospital_planned: amHospital ? String(amHospital.value || '').trim() : '',
                        notes: amNotes ? String(amNotes.value || '').trim() : '',
                    };

                    if (amSaveBtn) {
                        amSaveBtn.disabled = true;
                        amSaveBtn.textContent = 'Inahifadhi...';
                    }

                    try {
                        const res = await fetch(@json(url('/admin/forms/members/manual')), {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': @json(csrf_token()),
                            },
                            body: JSON.stringify(payload),
                        });

                        const json = await res.json().catch(function () { return null; });
                        if (!res.ok) {
                            const msg = (json && json.message) ? json.message : 'Imeshindikana kuhifadhi member.';
                            setAddError(msg);
                            return;
                        }

                        if (addMemberModal) addMemberModal.hide();
                        await fetchList();
                    } catch (e) {
                        setAddError('Imeshindikana kuhifadhi member.');
                    } finally {
                        if (amSaveBtn) {
                            amSaveBtn.disabled = false;
                            amSaveBtn.textContent = 'Save Member';
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
                    const url = new URL(@json(url('/api/members')));
                    url.searchParams.set('per_page', '25');
                    url.searchParams.set('page', String(currentPage));
                    if (statusEl && statusEl.value) url.searchParams.set('status', statusEl.value);
                    if (journeyStageEl && journeyStageEl.value) url.searchParams.set('journey_stage', journeyStageEl.value);
                    if (phoneEl && phoneEl.value) url.searchParams.set('phone', phoneEl.value);
                    if (fullNameEl && fullNameEl.value) url.searchParams.set('full_name', fullNameEl.value);
                    return url.toString();
                }

                function setLoading() {
                    if (!tbody) return;
                    tbody.innerHTML = [
                        '<tr class="animate-pulse">',
                        '<td colspan="10" class="py-6 px-4">',
                        '<div class="h-3 bg-slate-100 rounded w-1/4"></div>',
                        '<div class="mt-3 h-3 bg-slate-100 rounded w-1/2"></div>',
                        '<div class="mt-3 h-3 bg-slate-100 rounded w-1/3"></div>',
                        '</td>',
                        '</tr>'
                    ].join('');
                }

                const deleteModalEl = document.getElementById('delete-modal');
                const btnDeleteConfirm = document.getElementById('delete-confirm');
                const btnDeleteCancel = document.getElementById('delete-cancel');
                const deleteMemberNameEl = document.getElementById('delete-member-name');

                const deleteModalInstance = (deleteModalEl && typeof Modal !== 'undefined')
                    ? new Modal(deleteModalEl, { placement: 'center' })
                    : null;

                let memberIdToDelete = null;

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
                    if (s === 'pending') {
                        return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">pending</span>';
                    }
                    return '<span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">' + escapeHtml(status || '-') + '</span>';
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
                        cardItem('mk_number', data && data.mk_number),
                        cardItem('approved_at', data && data.approved_at),
                        cardItem('approved_by', data && data.approved_by),
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

                function renderRows(rows) {
                    if (!tbody) return;
                    if (!rows || rows.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="10" class="py-10 px-4 text-slate-500">Hakuna members kwa sasa.</td></tr>';
                        return;
                    }

                    tbody.innerHTML = rows.map(function (r) {
                        const editUrl = @json(url('/admin/forms/intakes')) + '/' + encodeURIComponent(String(r.source_id || r.id)) + '/edit';
                        const progressUrl = @json(url('/admin/forms/members')) + '/' + encodeURIComponent(String(r.id)) + '/progress';
                        return (
                            '<tr class="hover:bg-slate-50">'
                            + '<td class="py-3 px-4 font-semibold text-slate-900">' + escapeHtml(r.mk_number || '-') + '</td>'
                            + '<td class="py-3 px-4 text-slate-900 font-semibold">' + escapeHtml(r.full_name || '-') + '</td>'
                            + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(r.phone || '-') + '</td>'
                            + '<td class="py-3 px-4">' + statusBadge(r.status) + '</td>'
                            + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(r.journey_stage || '-') + '</td>'
                            + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(weeksWhileJoining(r)) + '</td>'
                            + '<td class="py-3 px-4 text-slate-600">' + escapeHtml(fmtDate(r.created_at)) + '</td>'
                            + '<td class="py-3 px-4 text-slate-600">' + escapeHtml(fmtDate(r.approved_at)) + '</td>'
                            + '<td class="py-3 px-4 text-slate-700">' + escapeHtml(r.hospital_planned || '-') + '</td>'
                            + '<td class="py-3 px-4">'
                                + '<div class="flex items-center justify-end gap-2">'
                                    + '<button type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 transition" data-view-member="' + escapeHtml(r.id) + '" title="View">'
                                        + '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                            + '<path d="M2.062 12.348a1 1 0 0 1 0-.696C3.423 8.02 7.36 5 12 5c4.64 0 8.577 3.02 9.938 6.652a1 1 0 0 1 0 .696C20.577 15.98 16.64 19 12 19c-4.64 0-8.577-3.02-9.938-6.652" />'
                                            + '<circle cx="12" cy="12" r="3" />'
                                        + '</svg>'
                                    + '</button>'
                                    + '<a href="' + escapeHtml(progressUrl) + '" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 transition" title="Progress">'
                                        + '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                            + '<path d="M3 3v18h18" />'
                                            + '<path d="M7 14l4-4 4 4 6-6" />'
                                        + '</svg>'
                                    + '</a>'
                                    + '<a href="' + escapeHtml(editUrl) + '" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 transition" title="Edit">'
                                        + '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                            + '<path d="M12 20h9" />'
                                            + '<path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4Z" />'
                                        + '</svg>'
                                    + '</a>'
                                    + '<button type="button" class="inline-flex items-center justify-center w-10 h-10 rounded-xl border border-rose-100 bg-rose-50 hover:bg-rose-100 text-rose-600 transition" data-delete-member="' + escapeHtml(r.id) + '" data-delete-name="' + escapeHtml(r.full_name || '') + '" title="Delete">'
                                        + '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">'
                                            + '<path d="M3 6h18" /><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" /><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />'
                                        + '</svg>'
                                    + '</button>'
                                + '</div>'
                            + '</td>'
                            + '</tr>'
                        );
                    }).join('');
                }

                async function fetchList() {
                    clearError();
                    setLoading();
                    try {
                        const res = await fetch(buildUrl(), { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) {
                            const text = await res.text().catch(function () { return ''; });
                            throw new Error(text ? (text.slice(0, 220) + (text.length > 220 ? '...' : '')) : 'Imeshindikana kupata members. Jaribu tena.');
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
                            tbody.innerHTML = '<tr><td colspan="10" class="py-10 px-4 text-slate-500">Hakuna data kwa sasa.</td></tr>';
                        }
                        setError((err && err.message) ? err.message : 'Imeshindikana kupata members.');
                    }
                }

                async function openDetails(id) {
                    if (!detailsModal || !modalGridEl) return;
                    modalTitleEl.textContent = 'Member #' + id;
                    modalGridEl.innerHTML = '<div class="md:col-span-2 px-4 py-3 rounded-xl border border-slate-200 bg-slate-50 text-slate-700 text-sm font-semibold">Inapakia...</div>';
                    detailsModal.show();

                    try {
                        const url = new URL(@json(url('/api/mother-intakes')) + '/' + encodeURIComponent(String(id)));
                        const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
                        if (!res.ok) {
                            throw new Error('Imeshindikana kupata maelezo ya member.');
                        }
                        const json = await res.json();
                        renderDetails(json && json.data ? json.data : null);
                    } catch (err) {
                        modalGridEl.innerHTML = '<div class="md:col-span-2 px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold">Imeshindikana kupata maelezo ya member.</div>';
                    }
                }

                function scheduleFetch() {
                    if (debounceTimer) clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(function () {
                        currentPage = 1;
                        fetchList();
                    }, 350);
                }

                if (addMemberBtn) {
                    console.log('Attaching click listener to addMemberBtn');
                    addMemberBtn.addEventListener('click', function (e) {
                        console.log('Add button clicked');
                        e.preventDefault();
                        openAddMember();
                    });
                } else {
                    console.error('addMemberBtn element not found in JS');
                }

                if (statusEl) {
                    statusEl.addEventListener('change', scheduleFetch);
                }

                if (phoneEl) {
                    phoneEl.addEventListener('input', scheduleFetch);
                }

                if (fullNameEl) {
                    fullNameEl.addEventListener('input', scheduleFetch);
                }

                if (journeyStageEl) {
                    journeyStageEl.addEventListener('change', function () {
                        currentPage = 1;
                        fetchList();
                    });
                }

                if (amBackBtn) {
                    amBackBtn.addEventListener('click', function () {
                        if (addStep <= 1) return;
                        addStep -= 1;
                        renderAddStep();
                    });
                }

                if (amNextBtn) {
                    amNextBtn.addEventListener('click', function () {
                        if (addStep >= 3) return;
                        addStep += 1;
                        renderAddStep();
                    });
                }

                if (amSaveBtn) {
                    amSaveBtn.addEventListener('click', function () {
                        saveNewMember();
                    });
                }

                if (addCloseEl) {
                    addCloseEl.addEventListener('click', function () {
                        if (!addMemberModal) return;
                        addMemberModal.hide();
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
                    const btn = e.target.closest && e.target.closest('[data-view-member]');
                    if (!btn) return;
                    openDetails(btn.getAttribute('data-view-member'));
                });

                document.addEventListener('click', function (e) {
                    const btn = e.target.closest && e.target.closest('[data-assess-member]');
                    if (!btn) return;
                    openDetails(btn.getAttribute('data-assess-member'));
                });

                document.addEventListener('click', function (e) {
                    const btn = e.target.closest && e.target.closest('[data-delete-member]');
                    if (!btn) return;
                    
                    console.log('Delete button clicked');
                    memberIdToDelete = btn.getAttribute('data-delete-member');
                    const name = btn.getAttribute('data-delete-name');
                    
                    if (deleteMemberNameEl) deleteMemberNameEl.textContent = name || 'huyu';
                    if (deleteModalInstance) {
                        deleteModalInstance.show();
                    } else {
                        console.error('deleteModalInstance not initialized');
                        // Fallback to browser confirm if modal fails
                        if (confirm(`Futa ${name}?`)) deleteMember(memberIdToDelete);
                    }
                });

                if (btnDeleteConfirm) {
                    btnDeleteConfirm.addEventListener('click', function () {
                        console.log('Confirm delete clicked');
                        if (memberIdToDelete) {
                            deleteMember(memberIdToDelete);
                        }
                        if (deleteModalInstance) deleteModalInstance.hide();
                    });
                }

                if (btnDeleteCancel) {
                    btnDeleteCancel.addEventListener('click', function () {
                        if (deleteModalInstance) deleteModalInstance.hide();
                        memberIdToDelete = null;
                    });
                }

                async function deleteMember(id) {
                    try {
                        const res = await fetch(@json(url('/admin/forms/members')) + '/' + encodeURIComponent(id), {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': @json(csrf_token()),
                            }
                        });

                        if (!res.ok) {
                            const json = await res.json().catch(() => ({}));
                            throw new Error(json.message || 'Imeshindikana kumfuta member.');
                        }

                        // Refresh the list
                        fetchList();
                    } catch (e) {
                        setError(e.message);
                    }
                }

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
