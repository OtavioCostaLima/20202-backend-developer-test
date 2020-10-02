<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;


class Survivor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'gender', 'location', 'contaminated_count'];

    public function isContaminated()
    {
        return 'oi';
    }

    public function inventory()
    {
        return $this->belongsToMany('App\Models\Items', 'inventories', 'survivor_id', 'item_id')->withPivot('quantity');
    }
}
