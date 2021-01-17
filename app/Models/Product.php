<?php

namespace App\Models;

use App\Concerns\OwnedByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use OwnedByTenant;

    protected $guarded =[

    ];


    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
