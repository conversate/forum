<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{

			$table->increments('id');
			$table->string('type');
			$table->boolean('is_parent');
			$table->bigInteger('pid')->unsigned();
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('thread_id')->unsigned();
			$table->text('body');
			$table->string('hash');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
