<?php

namespace App\Models\API\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        "comment",
        "blog_id",
        "user_id"
    ];
    public function user() {
        return $this->belongsTo(User::class, "user_id", "id")->select(['id', 'name', 'img']);
    }
}

