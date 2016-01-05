<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteCommentVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comment_votes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('comment_id')->unsigned();
			$table->string('user_id', 16);
			$table->boolean('isUpvote')->default(true);
			$table->timestamps();
			$table->foreign('comment_id')->references('id')->on('site_comments')->onDelete('cascade');
			$table->foreign('user_id')->references('username')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comment_votes');	
	}

}
