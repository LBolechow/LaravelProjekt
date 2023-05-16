<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{   
    public $table = 'tests';
    protected $fillable = [
        'title',
        'klasa'
    ]; 

    public function pytania()
    {
        return $this->belongsToMany(Pytanie::class, 'test_pytanie');
    }
    public function studenci()
{
    return $this->belongsToMany(User::class, 'test_user');
}



    use HasFactory;
}