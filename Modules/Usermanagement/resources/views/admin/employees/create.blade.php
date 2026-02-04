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
                <div class="rounded-2xl border border-slate-200 bg-white p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                        <div>
                            <div class="text-sm font-semibold text-slate-500">Employee Management</div>
                            <h1 class="mt-1 text-2xl font-extrabold text-slate-900">Register Employee</h1>
                            <p class="mt-2 text-slate-600">Create an employee account (role: employee) and link it to an employee record.</p>
                        </div>
                        <a href="{{ route('admin.employees.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Back</a>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.employees.store') }}" class="mt-6 bg-white rounded-2xl border border-slate-200 p-6">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-bold text-slate-700">Employee Code</label>
                            <input name="employee_code" value="{{ old('employee_code') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300" placeholder="EMP-0001" required>
                            @error('employee_code') <div class="mt-1 text-sm text-rose-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">Status</label>
                            <select name="status" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300" required>
                                <option value="active" @selected(old('status', 'active') === 'active')>active</option>
                                <option value="inactive" @selected(old('status') === 'inactive')>inactive</option>
                            </select>
                            @error('status') <div class="mt-1 text-sm text-rose-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">First Name</label>
                            <input name="first_name" value="{{ old('first_name') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300" required>
                            @error('first_name') <div class="mt-1 text-sm text-rose-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">Last Name</label>
                            <input name="last_name" value="{{ old('last_name') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300" required>
                            @error('last_name') <div class="mt-1 text-sm text-rose-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">Email (Login)</label>
                            <input name="email" type="email" value="{{ old('email') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300" required>
                            @error('email') <div class="mt-1 text-sm text-rose-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">Password</label>
                            <input name="password" type="password" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300" required>
                            @error('password') <div class="mt-1 text-sm text-rose-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">Phone</label>
                            <input name="phone" value="{{ old('phone') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300" placeholder="+255...">
                            @error('phone') <div class="mt-1 text-sm text-rose-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">Position</label>
                            <input name="position" value="{{ old('position') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300" placeholder="Accountant / Support / Sales">
                            @error('position') <div class="mt-1 text-sm text-rose-600">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-bold text-slate-700">Hired At</label>
                            <input name="hired_at" type="date" value="{{ old('hired_at') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-4 py-3 focus:ring-2 focus:ring-emerald-200 focus:border-emerald-300">
                            @error('hired_at') <div class="mt-1 text-sm text-rose-600">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-2">
                        <a href="{{ route('admin.employees.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-800 font-semibold transition">Cancel</a>
                        <button class="px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-600 text-white font-semibold transition">Create Employee</button>
                    </div>
                </form>

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
