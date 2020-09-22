<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDirectorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('directors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('fullname');
            $table->string('position');
            $table->string('title');
            $table->string('picture');
            $table->string('citizen');
            $table->string('age');
            $table->text('education')->nullable();
            $table->text('legal')->nullable();
            $table->text('experience')->nullable();
            $table->text('concurrent')->nullable();
            $table->text('affiliate')->nullable();
            $table->text('desciption')->nullable();
            $table->integer('status')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('directors');
    }
}
