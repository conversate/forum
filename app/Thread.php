<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model {

	protected $table = "threads";

    protected $fillable = [];

    public function getCreatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->toIso8601String();
    }

    public function getUpdatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->toIso8601String();
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag\Tag', 'taggable');
    }   

    public function comments() {

        return $this->hasMany('App\Comment', 'thread_id', 'id')->orderBy('id', 'DESC');
    }
}
