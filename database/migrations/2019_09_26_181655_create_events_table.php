<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEventsTable.
 */
class CreateEventsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('title', 80);
			$table->string('description', 254);
			$table->dateTime('start_datetime');
			$table->datetime('end_datetime');
			$table->timestamps();

			$table->integer('user_id')->unsigned();

			$table->unique(["id"], 'id_UNIQUE');
			$table->index(["user_id"], 'fk_events_users_idx');
			$table->foreign('user_id', 'fk_events_users_idx')
				->references('id')->on('users')
				->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema:table('events', function (Blueprint $table){
			$table->dropForeign('user_id');
		});

		Schema::dropIfExists('events');
	}
}
