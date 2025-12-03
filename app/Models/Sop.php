<?php

namespace App\Models;

use App\Observers\SopObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(SopObserver::class)]
class Sop extends Model
{
    protected static function booted()
{
    static::creating(function ($sop) {
        $sop->status = 'Pending';
        $sop->user_id = auth()->id();
    });
}
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
