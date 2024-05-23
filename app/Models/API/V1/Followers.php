<?php

namespace App\Models\API\V1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followers extends Model
{
    use HasFactory;
    protected $fillable = [
        "account_id",
        "user_id",
    ];
    public function account() {
        return $this->belongsTo(User::class, "account_id", "id")->select(['id', 'name', 'img', 'surname']);
    }
    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id")->select(['id', 'name', 'img', 'surname']);

    }
}
