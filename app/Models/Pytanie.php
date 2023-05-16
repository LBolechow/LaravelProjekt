<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pytanie extends Model
{
    public $table = 'pytania';
    protected $fillable = [
        'pytanie',
        'odp1',
        'odp2',
        'odp3',
        'odp4',
        'dobra_odpowiedz',
    ];

    public function testy()
    {
        return $this->belongsToMany(Test::class, 'test_pytania');
    }

    use HasFactory;
}