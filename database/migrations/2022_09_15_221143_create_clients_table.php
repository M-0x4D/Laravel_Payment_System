<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->decimal('balance');
			$table->string('email');
			$table->string('password');
			$table->string('api_token');
			$table->boolean('status');
			$table->string('phone');
			$table->integer('pin_code');
			$table->integer('city_id')->unsigned();
			$table->date('date_of_birth');
			$table->integer('country_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}