<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'user_detail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['user_detail_id', 'user_id', 'image', 'identity', 'identity_image', 'status', 'address', 'zip_code', 'state', 'phone', 'gender'];

    protected function getStatusInfoAttribute()
    {
        return $this->status ? 'verified' : 'not verified';
    }

    protected function getCompleteAddressAttribute()
    {
        return $this->address . ', ' .$this->state. ', ' . $this->zip_code;
    }

    protected function getImageUrlAttribute()
    {
        return $this->image != null ? asset('assets/images/profile/' . $this->image) : asset('backend/img/avatars/profile.png');
    }

    protected function getImageIdentityUrlAttribute()
    {
        return $this->identity_image ? asset('assets/images/identity/' . $this->identity_image) : 'javascript:void(0)';
    }

    protected static function booted()
    {
        parent::booted();
        static::creating(function ($detail) {
            if (empty($detail->user_detail_id)) {
                $lastId = self::orderBy('user_detail_id', 'desc')->first()?->user_detail_id;
                $num = $lastId ? intval(substr($lastId, 3)) + 1 : 1;
                $detail->user_detail_id = 'UDT' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
