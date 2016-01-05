<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	CreateSiteFollowersTable
//==================================

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteFollowersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_followers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('site_id')->unsigned();
			$table->string('user', 18);
			$table->timestamps();
			$table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
			$table->foreign('user')->references('username')->on('users')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_followers');
	}

}
