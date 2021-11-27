<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
class Company extends Model
{
    protected $guarded = [];

    /* relation */
    public function users(): HasMany
    {
        return $this->hasMany('User');
    }

}