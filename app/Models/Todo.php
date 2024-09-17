<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    // hubungkan model dengan tabel tb_todos
    protected $table = 'tb_todos';
    // kolom yang bisa diisi data
    protected $fillable = ['task','is_done'];
}
