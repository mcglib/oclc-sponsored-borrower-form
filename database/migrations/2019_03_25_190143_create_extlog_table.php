<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extlog', function (Blueprint $table) {
	    $table->increments('id');
	    $table->string('email');
	    $table->text('form_data')->nullable();
        $table->longText('post')->nullable();
	    $table->longText('response')->nullable();
	    $table->timestamp('posted_on')->nullable();
	    $table->timestamp('received_on')->nullable();
	    $table->string('status')->nullable();
	    $table->text('error_msg')->nullable();
	    $table->boolean('created')->nullable();
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
        Schema::dropIfExists('extlog');
    }
}
