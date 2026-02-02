<?php

namespace Database\Seeders;

use App\Models\AdminActivityLog;
use App\Models\AdminTask;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminDashboardSeeder extends Seeder
{
    public function run(): void
    {
        if (AdminTask::query()->exists()) {
            return;
        }

        $admin = User::query()->where('email', 'admin@admin.com')->first();

        AdminTask::query()->create([
            'title' => 'Review new registrations',
            'status' => 'pending',
            'assigned_to' => $admin?->id,
            'due_at' => now()->addDays(1),
        ]);

        AdminTask::query()->create([
            'title' => 'Verify active members list',
            'status' => 'pending',
            'assigned_to' => $admin?->id,
            'due_at' => now()->addDays(3),
        ]);

        AdminTask::query()->create([
            'title' => 'System settings audit',
            'status' => 'completed',
            'assigned_to' => $admin?->id,
            'due_at' => now()->subDays(2),
        ]);

        if (! AdminActivityLog::query()->exists()) {
            AdminActivityLog::query()->create([
                'user_id' => $admin?->id,
                'action' => 'dashboard_seeded',
                'meta' => ['source' => 'seeder'],
                'created_at' => now(),
            ]);
        }
    }
}
