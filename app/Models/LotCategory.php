<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LotCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='lot_categories';
    protected $guarded='id';
    protected $fillable=[
        'lot_id',
        'category_id'
    ];
}
