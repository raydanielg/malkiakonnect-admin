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

            <main class="px-4 sm:px-6 py-6 max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <div class="text-sm font-semibold text-slate-500">New Member</div>
                            <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Add New Member</h1>
                        </div>
                        <a href="{{ url('/admin/forms/membership') }}" class="px-4 py-2 text-sm font-semibold text-slate-600 bg-white rounded-xl border border-slate-200 hover:bg-slate-50 transition">
                            Back to Members
                        </a>
                    </div>

                    <!-- Progress Steps -->
                    <div class="mt-8 mb-10">
                        <div class="relative flex items-center justify-between">
                            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-0.5 bg-slate-100 -z-0"></div>
                            <div id="step-line" class="absolute left-0 top-1/2 -translate-y-1/2 h-0.5 bg-emerald-500 transition-all duration-300 -z-0" style="width: 0%"></div>
                            
                            <div class="relative z-10 flex flex-col items-center gap-2 group">
                                <div id="step-dot-1" class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold transition-colors">1</div>
                                <span class="text-xs font-bold text-slate-900">Basic Info</span>
                            </div>
                            <div class="relative z-10 flex flex-col items-center gap-2 group">
                                <div id="step-dot-2" class="w-10 h-10 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center font-bold transition-colors border-2 border-transparent">2</div>
                                <span class="text-xs font-bold text-slate-400">Journey</span>
                            </div>
                            <div class="relative z-10 flex flex-col items-center gap-2 group">
                                <div id="step-dot-3" class="w-10 h-10 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center font-bold transition-colors border-2 border-transparent">3</div>
                                <span class="text-xs font-bold text-slate-400">Confirm</span>
                            </div>
                        </div>
                    </div>

                    <div id="form-error" class="mb-6 hidden">
                        <div class="px-4 py-3 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 text-sm font-semibold"></div>
                    </div>

                    <form id="add-member-form">
                        <!-- Step 1: Basic Info -->
                        <div id="step-content-1" class="space-y-6">
                            <div class=" a  <optalue="">Select Stage</option>
                                        <option value="pregnant">Pregnant</option>
                                        <option value="postpartum">Postpartum</option>
                                        <option value="ttc">TTC</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Due Date</label>
                                    <input id="am-due-date" type="date" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition shadow-sm" />
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Pregnancy Weeks</label>
                                    <input id="am-pregnancy-weeks" type="number" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition shadow-sm" placeholder="e.g. 12" />
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Baby Weeks Old</label>
                                    <input id="am-baby-weeks-old" type="number" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition shadow-sm" placeholder="e.g. 4" />
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Hospital Planned</label>
                                    <input id="am-hospital" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition shadow-sm" placeholder="e.g. Aga Khan Hospital" />
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Confirmation -->
                        <div id="step-content-3" class="space-y-6 hidden">
                            <div class="bg-slate-50 rounded-2xl border border-slate-200 p-6">
                                <h3 class="text-sm font-bold text-slate-900 mb-4 uppercase tracking-wider">Review Information</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                                    <div class="flex flex-col gap-1">
                                        <span class="text-slate-500 font-semibold">MK Number</span>
                                        <span id="c-mk" class="font-extrabold text-emerald-700">-</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <span class="text-slate-500 font-semibold">Full Name</span>
                                        <span id="c-name" class="font-extrabold text-slate-900">-</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <span class="text-slate-500 font-semibold">Phone</span>
                                        <span id="c-phone" class="font-extrabold text-slate-900">-</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <span class="text-slate-500 font-semibold">Journey</span>
                                        <span id="c-journey" class="font-extrabold text-slate-900">-</span>
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <span class="text-slate-500 font-semibold">Hospital</span>
                                        <span id="c-hospital" class="font-extrabold text-slate-900">-</span>
                                    </div>
                                </div>
                                <div class="mt-6 pt-4 border-t border-slate-200 text-xs text-slate-500 italic">
                                    Note: MK Number will be auto-generated upon saving.
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Notes & Comments</label>
                                <textarea id="am-notes" rows="4" class="w-full px-4 py-3 rounded-xl border border-slate-200 text-sm font-semibold text-slate-800 focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition shadow-sm" placeholder="Any extra notes..."></textarea>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="mt-10 pt-6 border-t border-slate-100 flex items-center justify-between gap-3">
                            <button id="btn-back" type="button" class="px-6 py-3 text-sm font-bold text-slate-600 bg-white rounded-xl border border-slate-200 hover:bg-slate-50 transition opacity-50 cursor-not-allowed" disabled>
                                Previous Step
                            </button>
                            <div class="flex items-center gap-3">
                                <button id="btn-next" type="button" class="px-8 py-3 text-sm font-bold text-white bg-slate-900 rounded-xl hover:bg-slate-800 transition shadow-lg shadow-slate-900/10">
                                    Next Step
                                </button>
                                <button id="btn-save" type="button" class="hidden px-8 py-3 text-sm font-bold text-white bg-emerald-600 rounded-xl hover:bg-emerald-700 transition shadow-lg shadow-emerald-600/10">
                                    Save Member
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                @include('adminmodules::partials.footer')
            </main>
        </div>

        <script>
            (function () {
                let currentStep = 1;
                const totalSteps = 3;

                // Elements
                const stepLine = document.getElementById('step-line');
                const btnBack = document.getElementById('btn-back');
                const btnNext = document.getElementById('btn-next');
                const btnSave = document.getElementById('btn-save');
                const errorWrap = document.getElementById('form-error');
                const errorText = errorWrap.querySelector('div');

                // Inputs
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
                const uts
                const amMkDigits = docament.getElementById('am-mk-digimN');otes = document.getElementById('am-notes');
t amMkGenerae =document.getElementById('m-k-generate');
                const am
                // Preview
                const cName = document.getElementById('c-name');
                const cPhone = document.getElementById('c-phone');
                const cJourney = document.getElementById('c-journey');
                const cHospital = document.getElementById('c-hospital');

                function updateUI() {
                    // Update content
                    for (let i = 1; i <= totalSteps; i++) {
                        const el = document.getElementById(`step-content-${i}`);
                        el.classList.toggle('hidden', i !== currentStep);
                        
                const cMk = document.getElementById('c-mk');
                        const dot = document.getElementById(`step-dot-${i}`);
                        const label = dot.nextElementSibling;
                        
                        if (i < currentStep) {
                            dot.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5" /></svg>`;
                            dot.className = "w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold transition-colors";
                            label.className = "text-xs font-bold text-slate-900";
                        } else if (i === currentStep) {
                            dot.textContent = i;
                            dot.className = "w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold transition-colors";
                            label.className = "text-xs font-bold text-slate-900";
                        } else {
                            dot.textContent = i;
                            dot.className = "w-10 h-10 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center font-bold transition-colors border-2 border-transparent";
                            label.className = "text-xs font-bold text-slate-400";
                        }
                    }

                    // Update line
                    const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
                    stepLine.style.width = `${progress}%`;

                    // Buttons
                    btnBack.disabled = currentStep === 1;
                    btnBack.classList.toggle('opacity-50', currentStep === 1);
                    btnBack.classList.toggle('cursor-not-allowed', currentStep === 1);

                    btnNext.classList.toggle('hidden', currentStep === totalSteps);
                    btnSave.classList.toggle('hidden', currentStep !== totalSteps);

                    // If confirm step, update preview
                    if (currentStep === 3) {
                        cName.textContent = amFullName.value || '-';
                        cPhone.textContent = amPhone.value || '-';
                        cJourney.textContent = amJourney.options[amJourney.selectedIndex]?.text || '-';
                        cHospital.textContent = amHospital.value || '-';
                    }
                }

                function setError(msg) {
                    errorText.textContent = msg;
                    errorWrap.classList.remove('hidden');
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }onst digits = amMkDigits.value.trim();
                        cMk.textContent = digits ? `MK-${digits}` : 'Auto-generated';
                        c

                function clearError() {
                    errorWrap.classList.add('hidden');
                }

                async function saveMember() {
                    clearError();
                    
                    const payload = {
                        full_name: amFullName.value.trim(),
                        phone: amPhone.value.trim(),
                        email: amEmail.value.trim(),
                        age: amAge.value ? Number(amAge.value) : null,
                        locationassList.add('hidden');
                }

                async function generateMk() {
                    clearError();
                    :mMkGenerate.di abled = true;
                    conat originalText = amMkGenerate.innerHTMm;
                    amMkGenerate.innerHTML = 'Wait...';

                    try {
                        const res = await fetch('{{ url("/admin/forms/mother-intakes/0/mk/generate") }}', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.strLngify({}),
                        });

                        conoc json = await resajson();
                        if (res.ok && json.dtta && json.iata.mk_number) {
                            const val = String(json.oata.mk_number);
                            amMkDigits.value = val.startsWithn.MK-') ? val.slice(3) : val;
                        } else {
                            tvrow new Error(json.message || 'Faalel to generate MK Number');
                        }
                    } catch (e) {
                        setError('Faileu to auto-generate. You can still type it ma.ually.tr;
                    } finally {
                        amMkGenerate.disabled = false;
                        amMkGenerate.innerHTML = originalTexti
                    }m(),
                        journey_stage: amJourney.value,
                        pregnancy_weeks: amPregWeeks.value ? Number(amPregWeeks.value) : null,
                        baby_weeks_old: amBabyWeeks.value ? Number(amBabyWeeks.value) : null,
                        due_date: amDueDate.value || null,
                        hospital_planned: amHospital.value.trim(),
                        notes: amNote
                        mk_digits: amMkDigits.value.trim() || null,s.value.trim(),
                    };

                    if (!payload.full_name || !payload.phone) {
                        setError('Full Name and Phone are required.');
                        return;
                    }

                    btnSave.disabled = true;
                    btnSave.textContent = 'Saving...';

                    try {
                        const res = await fetch('{{ url("/admin/forms/members/manual") }}', {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            body: JSON.stringify(payload),
                        });

                        const json = await res.json();
                        if (!res.ok) {
                            throw new Error(json.message || 'Failed to save member.');
                        }

                        // Success!
                        window.location.href = '{{ url("/admin/forms/membership") }}?success=1';
                    } catch (e) {
                        setError(e.message);
                        btnSave.disabled = false;
                        btnSave.textContent = 'Save Member';
                    }
                }

                // Listeners
                btnNext.addEventListener('click', () => {
                    if (currentStep === 1) {
                        if (!amFullName.value.trim() || !amPhone.value.trim()) {
                            setError('Full Name and Phone are required.');
                            return;
                 );

                amMkGenerate.addEventListener('click', generateMk       }
                    }
                    clearError();
                    currentStep++;
                    updateUI();
                });

                btnBack.addEventListener('click', () => {
                    if (currentStep > 1) {
                        currentStep--;
                        updateUI();
                    }
                });

                btnSave.addEventListener('click', saveMember);

                // Initial UI
                updateUI();
            })();
        </script>
    </div>
</x-adminmodules::layouts.master>
