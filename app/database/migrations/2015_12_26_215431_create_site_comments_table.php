<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('writter_id', 16);
			$table->integer('site_id')->unsigned();
			$table->string('content', 500);
			$table->integer('rating')->default(0);
			$table->timestamps();
			$table->foreign('writter_id')->references('username')->on('users')->onDelete('cascade');
			$table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_comments');
	}

}
