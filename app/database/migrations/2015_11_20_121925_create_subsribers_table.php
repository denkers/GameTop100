<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubsribersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('subscribers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user', 18);
			$table->date('end_date');
			$table->integer('sub_type');
			$table->timestamps();
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
		Schema::drop('subscribers');	
	}

}
