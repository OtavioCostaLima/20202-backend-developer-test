<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;


class Survivor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'gender', 'latitude', 'longitude', 'contaminated_count'];

    public function isContaminated()
    {
        return $this->inventory();
    }

    public function totalPoints($id)
    {
        return $this->find($id)->inventory()->get()->map(function ($item, $key) {
            return $item->point * $item->pivot->quantity;
        })->sum();
    }

    public function inventory()
    {
        return $this->belongsToMany('App\Models\Items', 'inventories', 'survivor_id', 'item_id')->withPivot('quantity');
    }


    public function notifications()
    {
        return $this->belongsToMany('App\Models\InfectedNotification', 'infected_notifications', 'notifier_id', 'infected_id');
    }
}
