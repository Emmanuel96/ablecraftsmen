<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtisanDB extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artisans', function(Blueprint $table){
            $table->increments('artisanID'); 
            $table->string('artisan_name');
            $table->string('artisan_phone_no'); 
            $table->string('artisan_address')->nullable();
            $table->string('artisan_job_type')->nullable(); 
            $table->boolean('artisan_confirmed'); 
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
        Schema::drop('artisans'); 
    }
}
