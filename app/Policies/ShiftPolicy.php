<?php

namespace App\Policies;

use App\Models\User;

class ShiftPolicy
{
    public function shifts(User $user)
    {
        // ここで権限チェックのロジックを実装
        return $user->hasPermission('shifts');
    }
}
