<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */

     protected $fillable = [
        'content', 'image', 'tags', 'user_id'
     ];

    //  je charge automatiquement l'utilisateur à chaque fois que
    //  EAGER LOADING automatique
    protected $with = ['user'];

    // nom de la fonction au singulier car 1 seul user en relation avec un  post
    // je charge automatiquement l'utilisateur à chaque fois que je recupère un message
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // nom au pluriel car un message peut regroupper plussieurs commentaires
    // cardinalité 0,n
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
