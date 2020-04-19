<?php

namespace BigHairEnergy\Preview;

use BigHairEnergy\Preview\Key;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class User extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bhe_preview_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['email'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'last_previewed_at' => 'datetime:Y-m-d H:00',
    ];

    /**
     * Get the keys for the user.
     */
    public function keys()
    {
        return $this->hasMany(Key::class);
    }

    public function getSecretKeyAttribute()
    {
        $key = $this->keys()->orderBy('created_at', 'desc')->first();
        return $key ? $key->secret : '';
    }

    public function generateKey()
    {
        $this->keys()->create([
            'secret' => Str::uuid(),
        ]);
        $this->ip_address = null;
        return $this;
    }
}
