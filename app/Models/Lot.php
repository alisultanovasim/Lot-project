<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lot extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='lots';
    protected $fillable=[
        'name',
        'description'
    ];
    protected $guarded='id';

    public function categories()
    {
        return $this->belongsToMany(Category::class,'lot_categories','lot_id','category_id');
    }
}
