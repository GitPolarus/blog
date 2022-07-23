<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        "message",
        "email",
        "name",
        "article_id"
    ];
    
    /**
     * article recupère l'article d'un commentaire
     *
     * @return Article
     */
    public function article(){
        return $this->belongsTo(Article::class);
    }
}