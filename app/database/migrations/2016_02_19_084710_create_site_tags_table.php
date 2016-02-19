<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 18);
			$table->string('description', 50);
			$table->integer('site_id')->unsigned();
			$table->timestamps();
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
		Schema::drop('site_tags');
	}

}
