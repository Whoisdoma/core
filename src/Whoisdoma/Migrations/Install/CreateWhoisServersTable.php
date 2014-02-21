<?php

namespace Whoisdoma\Migrations\Install;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhoisserversTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('whois_servers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('tld');
			$table->string('server');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('whois_servers');
	}

}

