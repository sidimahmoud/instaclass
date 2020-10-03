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
            $table->integer('sub_category_id');
            $table->string('name')->nullable();
            $table->string('short_description');
            $table->string('description')->nullable();
            $table->string('image')->nullable()->default('/uploads/logo.png');
            $table->string('slug')->unique()->nullable();
            $table->string('language');
            $table->integer('status')->default(2); // free 1 or paid 2
            $table->integer('type')->default(2);  // recorded 1 or live 2
            $table->string('estimated_duration');
            $table->string('authorized_students')->default('Unlimited');
            $table->string('join_after')->nullable();
            $table->float('price')->nullable();
            $table->string('currency')->default('usd');
            $table->string('available_from')->nullable();
            $table->string('available_to')->nullable();
            $table->boolean('sharable')->default(1);
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
