<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryFiles extends Model
{
    use HasFactory;
    
    protected $table = "temporary_files";

    protected $fillable = [
        'folder',
        'filename',
        'cloudflare',
        'video_uuid',
        'user_id'
    ];
}
