<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;


class Client extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'inn',
        'address',
        'licence_expired_at',
        'is_deleted'
    ];

    public function files()
    {
        return $this->morphMany(File::class, 'documentable');
    }
}
