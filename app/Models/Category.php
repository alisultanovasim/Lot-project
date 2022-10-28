<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='categories';
    protected $fillable=[
        'name'
    ];
    protected $guarded='id';

    public function lots()
    {
        return $this->belongsToMany(Lot::class)->using(LotCategory::class);
    }
}
