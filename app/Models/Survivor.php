<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survivor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'gender', 'location', 'contaminated_count'];

    public function isContaminated() {
        return 'oi';
    }

}
