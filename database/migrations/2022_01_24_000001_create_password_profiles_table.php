<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('password_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('masterpassword')->default('')->nullable();
            $table->integer('password_length');
            $table->boolean('has_lowercase');
            $table->boolean('has_uppercase');
            $table->boolean('has_numbers');
            $table->boolean('has_symbols');
            $table->integer('counter')->default(1);
			$table->string('session_id');
		    $table->dateTime('expires_at');
            $table->bigInteger('claimed_by')->nullable(); //user_id
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
        Schema::dropIfExists('password_profiles');
    }
}
