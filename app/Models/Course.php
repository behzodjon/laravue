<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected $table = 'courses';

    protected $guarded = [];
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
