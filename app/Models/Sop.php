<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Sop extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'sops';

    protected $fillable = [
        'id_sop',
        'user_id',
        'nomor_sk',
        'type',
        'id_unit',
        'sop_name',
        'desc',
        'approval_date',
        'start_date',
        'exp',
        'days_left',
        'file_path',
        'status',
        'revision',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit', 'id_unit');
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        $model->id_sop = 'SOP' . now()->format('YmdHis');
    });
}

}
