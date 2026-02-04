<?php

namespace Modules\Usermanagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminActivityLog;
use App\Models\AdminLoginLog;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Modules\Usermanagement\Models\Employee;

class EmployeesController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->get('q', ''));

        $employees = Employee::query()
            ->with('user')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($inner) use ($q) {
                    $inner
                        ->where('first_name', 'like', "%{$q}%")
                        ->orWhere('last_name', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%")
                        ->orWhere('employee_code', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('usermanagement::admin.employees.index', [
            'employees' => $employees,
            'q' => $q,
        ]);
    }

    public function create(): View
    {
        return view('usermanagement::admin.employees.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'employee_code' => ['required', 'string', 'max:50', 'unique:employees,employee_code'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:50'],
            'position' => ['nullable', 'string', 'max:100'],
            'hired_at' => ['nullable', 'date'],
            'password' => ['required', 'string', 'min:8'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $employee = DB::transaction(function () use ($validated) {
            $user = User::query()->create([
                'name' => trim($validated['first_name'].' '.$validated['last_name']),
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'employee',
            ]);

            return Employee::query()->create([
                'user_id' => $user->id,
                'employee_code' => $validated['employee_code'],
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'position' => $validated['position'] ?? null,
                'status' => $validated['status'],
                'hired_at' => $validated['hired_at'] ?? null,
            ]);
        });

        return redirect()->route('admin.employees.show', $employee);
    }

    public function show(Employee $employee): View
    {
        $employee->load('user');

        return view('usermanagement::admin.employees.show', [
            'employee' => $employee,
        ]);
    }

    public function logs(Employee $employee): View
    {
        $employee->load('user');

        $loginLogs = AdminLoginLog::query()
            ->when($employee->user_id, fn ($q) => $q->where('user_id', $employee->user_id))
            ->when(! $employee->user_id, fn ($q) => $q->whereRaw('1=0'))
            ->orderByDesc('logged_in_at')
            ->paginate(15);

        $activityLogs = AdminActivityLog::query()
            ->when($employee->user_id, fn ($q) => $q->where('user_id', $employee->user_id))
            ->when(! $employee->user_id, fn ($q) => $q->whereRaw('1=0'))
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('usermanagement::admin.employees.logs', [
            'employee' => $employee,
            'loginLogs' => $loginLogs,
            'activityLogs' => $activityLogs,
        ]);
    }

    public function destroy(Employee $employee): RedirectResponse
    {
        $employee->delete();

        return redirect()->route('admin.employees.index');
    }
}
