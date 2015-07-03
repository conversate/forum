<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Model {

	protected $table = "taggables";

  protected $fillable = [
  'tag_id',
  'taggable_id',
  'taggable_type',
  ];

}
