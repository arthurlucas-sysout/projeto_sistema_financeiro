<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Category;
use App\Models\User;

#[Fillable(['value', 'description', 'category_id', 'user_id'])]
class Transaction extends Model
{

    use HasFactory;

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category() : HasOne
    {
        return $this->hasOne(Category::class);
    }
}

