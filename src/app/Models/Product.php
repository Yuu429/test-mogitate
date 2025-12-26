<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Season;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'price', 'image', 'description',
    ];

    use Sortable;

    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($query) use($keyword) {
            $query->orWhere('name', 'like', "%{$keyword}%")
                ->orWhere('price', 'like', "%{$keyword}%")
                ->orWhere('image', 'like', "%{$keyword}%");
        });
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id')
            ->withPivot('product_id');
    }
}
