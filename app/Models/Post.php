<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    // security stuff

    // these items can't be mass assigned by users
    
    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at'
    // ];

    protected $with = ['user:id,name,image','comments.user'];

    protected $withCount = ['likedByUsers'];


    // these can be mass assigned by user
    protected $fillable = [
        'user_id',
        'content',
    ];

    // table relationships
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'post_like', 'post_id', 'user_id')->withTimestamps();
    }

    public function scopeSearch(Builder $query,$search = ''): void{
       $query->where('content','like','%'.$search.'%'); 
    }

}
