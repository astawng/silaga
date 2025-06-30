<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = ['feedback_id'];
    protected $primaryKey = 'feedback_id';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->feedback_id)) {
                $last = self::orderBy('feedback_id', 'desc')->first();
                if ($last && preg_match('/^FDB(\d{3})$/', $last->feedback_id, $matches)) {
                    $num = (int)$matches[1] + 1;
                } else {
                    $num = 1;
                }
                $model->feedback_id = 'FDB' . str_pad($num, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function report()
    {
        return $this->belongsTo(Report::class, 'report_id', 'report_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
