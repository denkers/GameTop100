<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	SiteVotesTable
//==================================


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SiteVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_votes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('site_id')->unsigned();
			$table->timestamps();
			$table->string('ip');
			$table->boolean('isOut')->default(false);
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
		Schema::drop('site_votes');
	}

}
