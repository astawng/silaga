<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Report extends Model
{
    use HasFactory;

    protected $primaryKey = 'report_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['report_id'];

    public function imageReports()
    {
        return $this->hasMany(ImageReport::class, 'report_id', 'report_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(ImageReport::class, 'report_id', 'report_id');
    }

    protected static function booted()
    {
        parent::booted();
        static::creating(function ($report) {
            if (empty($report->report_id)) {
                $lastId = self::orderBy('report_id', 'desc')->first()?->report_id;
                $num = $lastId ? intval(substr($lastId, 3)) + 1 : 1;
                $report->report_id = 'RPT' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
        static::deleting(function ($data) {
            // Hapus semua file dan folder terkait jika ada imageReports
            if ($data->imageReports->count() > 0) {
                if (File::exists(public_path('assets/images/reports/' . $data->title))) {
                    File::deleteDirectory(public_path('assets/images/reports/' . $data->title));
                }
                $data->imageReports()->delete();
            } else {
                // Jika tidak ada imageReports, tetap hapus folder jika ada
                if (File::exists(public_path('assets/images/reports/' . $data->title))) {
                    File::deleteDirectory(public_path('assets/images/reports/' . $data->title));
                }
            }
        });
    }
}
