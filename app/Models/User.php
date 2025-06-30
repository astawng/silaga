<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that 1:1 Roles Class.
     *
     * @return array<string, string>
     */
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    /**
     * The attributes that 1:1 UserDetail Class.
     *
     * @return array<string, string>
     */
    public function details()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['user_id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The password attribute default values.
     *
     * @return password<string, string>
     */
    protected static function booted()
    {
        parent::booted();
        static::creating(function ($user) {
            if (empty($user->user_id)) {
                $lastId = self::orderBy('user_id', 'desc')->first()?->user_id;
                $num = $lastId ? intval(substr($lastId, 3)) + 1 : 1;
                $user->user_id = 'USR' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });

        static::deleting(function ($user) {
            if ($user->details) {
                if ($user->details->image && File::exists(public_path('assets/images/profile/' . $user->details->image))) {
                    File::delete(public_path('assets/images/profile/' . $user->details->image));
                }
                if ($user->details->identity_image && File::exists(public_path('assets/images/identity/' . $user->details->identity_image))) {
                    File::delete(public_path('assets/images/identity/' . $user->details->identity_image));
                }
                $user->details()->delete();
            }
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
