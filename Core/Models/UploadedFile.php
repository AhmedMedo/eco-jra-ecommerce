<?php

namespace Core\Models;

use Illuminate\Database\Eloquent\Model;

class UploadedFile extends Model
{
    protected $table = "tl_uploaded_files";

    protected $fillable = [
        'name',
        'disk',
        'title',
        'alt',
        'caption',
        'description',
        'path',
        'size',
        'variant',
        'file_type',
        'extension',
        'folder_name',
        'uploaded_by',
        'user_id'
    ];
}
