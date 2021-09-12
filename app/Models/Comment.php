<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * アクセッサー
     * 使いたい時は$this->who_what;とで値をリターンしてくれる。
     */

     public function getWhoWhatAttribute()
     {
         return "user {$this->user_id} rating {$this->rating}";
     }
}
