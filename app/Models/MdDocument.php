<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MdDocument extends Model
{
    use HasFactory;
    protected $table="md_documents";
    protected $fillable = [
        'document',
        'created_by',
        'updated_by',
    ];
}
