<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageReport extends Model
{
    use HasFactory;

    protected $guarded = ['image_report_id'];

    protected $primaryKey = 'image_report_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'report_id');
    }

    protected static function booted()
    {
        parent::booted();
        static::creating(function ($img) {
            if (empty($img->image_report_id)) {
                $lastId = self::orderBy('image_report_id', 'desc')->first()?->image_report_id;
                $num = $lastId ? intval(substr($lastId, 3)) + 1 : 1;
                $img->image_report_id = 'IMR' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }
}
