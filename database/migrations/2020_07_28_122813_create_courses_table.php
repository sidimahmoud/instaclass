<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('short_description');
            $table->string('description');
            $table->string('image')->default('https://instantclass.herokuapp.com/uploads/logo.png');
            $table->string('slug')->unique();
            $table->string('language');
            $table->string('duration');
            $table->string('status'); // free 1 or paid 2
            $table->integer('type');  // recorded 1 or live 2
            $table->float('price')->nullable();
            $table->boolean('published')->default(1);
            $table->boolean('paid')->default(0);
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
        Schema::dropIfExists('courses');
    }
}
