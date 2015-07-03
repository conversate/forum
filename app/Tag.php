<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {


  protected $table = "tags";

  protected $fillable = ['name'];

  public function threads() {

      return $this->morphedByMany('App\Thread', 'taggable');
  }

}
