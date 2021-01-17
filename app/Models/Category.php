<?php

namespace App\Models;

use App\Concerns\OwnedByTenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use OwnedByTenant;
    protected $guarded =[

    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
