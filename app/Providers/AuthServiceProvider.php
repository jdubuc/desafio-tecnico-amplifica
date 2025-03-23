<?php

use Illuminate\Support\Facades\Gate;
use App\Models\User;

public function boot()
{
    Gate::define('manage-system', function (User $user) {
        return $user->isAdmin();
    });
}