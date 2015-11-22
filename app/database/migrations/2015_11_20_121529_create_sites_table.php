<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 30);
			$table->string('description', 200);
			$table->string('address');
			$table->boolean('isPremium');
			$table->string('owner', 18);
			$table->integer('game_id')->unsigned()->nullable();
			$table->timestamps();
			$table->foreign('owner')->references('username')->on('users')->onDelete('cascade');
			$table->foreign('game_id')->references('id')->on('games')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sites');
	}

}
