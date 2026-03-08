<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "title",
        "slug",
        "thumbnail",
        "content",
        "status",
        "tanggal",
        "user_name",
    ];

    // public function tags(){
    //     return $this->belongsToMany(Tag::class)->withTimestamps();
    // }

    // public function categories(){
    //     return $this->belongsToMany(Category::class)->withTimestamps();
    // }

    public function scopeSearch($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    public function scopePublish($query)
    {
        return $query->where('status',"Publish");
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
