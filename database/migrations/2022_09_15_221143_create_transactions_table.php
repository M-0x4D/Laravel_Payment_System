<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('sender_id');
			$table->integer('receiver_id');
			$table->decimal('amount');
			$table->string('currency');
			$table->decimal('service');
		});
	}

	public function down()
	{
		Schema::drop('transactions');
	}
}