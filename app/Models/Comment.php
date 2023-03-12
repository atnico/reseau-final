<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable =  ['content', 'tags', 'image', 'user_id', 'post_id'];

    // je charge automatiquement l'utilisateur à chaque fois que je recupère un commentaire
    // EAGER LOADING automatique
    protected $with = ['user'];

    // nom de la fonction au singulier car 1 seul message en relation
    // cardinalité 1,1
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // idem
    public function user()
    {
        return $this->belongsTo(User::class);
    }
        
    
}
