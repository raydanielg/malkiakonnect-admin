<?php

namespace App\Services;

use App\Models\MotherIntake;

class MkNumberGenerator
{
    public function next(): string
    {
        $max = MotherIntake::query()
            ->whereNotNull('mk_number')
            ->selectRaw('MAX(CAST(SUBSTRING(mk_number, 4) AS UNSIGNED)) as max_num')
            ->value('max_num');

        $next = 1000;
        if ($max !== null) {
            $next = max(1000, ((int) $max) + 1);
        }

        return 'MK-'.str_pad((string) $next, 4, '0', STR_PAD_LEFT);
    }
}
