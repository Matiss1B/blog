<?php

namespace App\Models\API\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "token",
        "updated_at",
        "created_at"
    ];
}
