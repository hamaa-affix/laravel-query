<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;

class Comment extends Model
{
    protected $guarded = [];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
