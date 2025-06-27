<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id'];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function descendants()
    {
        return $this->topics()->with('descendants');
    }
    public function products()
    {
 //       return $this->hasMany(Product::class);
    }
}
