<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    const DOING = '0';
    const COMPLETE = '1';
    const DELETE = '2';

    protected $fillable = [
    	'title',
    	'contents',
        'user',
    	'status',
    ];

    public function user() {
    	return belongsTo(User::class, 'user');
    }
}
