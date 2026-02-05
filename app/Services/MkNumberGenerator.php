<?php

namespace App\Services;

use App\Models\MotherIntake;

class MkNumberGenerator
{
    public function next(): string
    {
        $latest = MotherIntake::query()
            ->whereNotNull('mk_number')
            ->orderByDesc('id')
            ->value('mk_number');

        $next = 1;

        if (is_string($latest) && $latest !== '') {
            $digits = preg_replace('/\D+/', '', $latest);
            if ($digits !== null && $digits !== '') {
                $next = ((int) $digits) + 1;
            }
        }

        return 'MK-'.str_pad((string) $next, 4, '0', STR_PAD_LEFT);
    }
}
