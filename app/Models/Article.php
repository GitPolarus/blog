<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "author_id",
        "publication_date",
        "published",
        "photo"
    ];
    
    /**
     * comments : recupère les commentaires d'un article
     *
     * @return Comment
     */
    public function comments(){
       return $this->hasMany(Comment::class);
    }
    
    /**
     * author : recupère l'auteur d'un article
     *
     * @return User
     */
    public function author(){
        return $this->belongsTo(User::class);
    }
}