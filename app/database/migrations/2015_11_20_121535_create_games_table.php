<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->string('disp_image')->default('http://dpcpa.com/wp-content/uploads/2015/01/thumbnail-default.jpg');
			$table->integer('category_id')->unsigned()->nullable();
			$table->timestamps();
			$table->foreign('category_id')
				->references('id')->on('game_categories')
				->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('games');
	}

}
