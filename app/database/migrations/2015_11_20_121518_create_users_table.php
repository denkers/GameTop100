<?php
//==================================
//	Kyle Russell
//	github.com/denkers/GameTop100
//	CreateUsersTable
//==================================

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->string('username', 18);
			$table->string('password', 255);
			$table->string('email');
			$table->string('ip')->default('0.0.0.0');
			$table->boolean('online')->default(false);
			$table->boolean('isAdmin')->default(false);
			$table->timestamps();
			$table->primary('username');	
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
