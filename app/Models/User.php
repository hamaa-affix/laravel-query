<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Str;

class User extends Authenticatable implements JWTSubject {
    use Notifiable;
    use SoftDeletes;
    use HasFactory;

    // プライマリーキーのカラム名
    protected $primaryKey = 'id';

    // プライマリーキーの型
    protected $keyType = 'string';

    // プライマリーキーは自動連番か？
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();
        // レコード作成時にprimary keyに自動的にuuidを入れてくれるようにする
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::orderedUuid();
        });
    }

    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token', ];
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        // JWT トークンに保存する ID を返す
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        // JWT トークンに埋め込む追加の情報を返す
        return [];
    }
}
