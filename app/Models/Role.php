<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function show(Role $role) { // ✅ uppercase 'R'
        // now Laravel can resolve it
    }
}
