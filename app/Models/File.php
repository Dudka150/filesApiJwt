<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class File extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
        'documentable_type',
        'documentable_id',
        'name',
        'number_document',
        'register_number',
        'date_register',
        'date_document',
        'list_item',
        'path_file',
        'check_sum',
        'user_id',
        'file_name'
    ];

    public function documentable()
    {
        return $this->morphTo();
    }
}
