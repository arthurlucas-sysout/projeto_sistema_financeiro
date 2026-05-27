<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

#[Fillable(['type'])]
class Category extends Model
{

    use HasFactory;


    public $timestamps = false;


    public function transaction() : BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }
}
