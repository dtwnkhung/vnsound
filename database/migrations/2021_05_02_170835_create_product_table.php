<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('sub_name')->nullable();
            $table->text('images')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->string('block_1_title')->nullable();
            $table->string('block_2_title')->nullable();
            $table->string('block_3_title')->nullable();
            $table->text('block_1_image')->nullable();
            $table->text('block_2_image')->nullable();
            $table->text('block_3_image')->nullable();
            $table->text('block_1_content')->nullable();
            $table->text('block_2_content')->nullable();
            $table->text('block_3_content')->nullable();
            $table->string('free_price')->nullable();
            $table->string('basic_price')->nullable();
            $table->string('premium_price')->nullable();
            $table->text('free_benefit')->nullable();
            $table->text('basic_benefit')->nullable();
            $table->text('pre_benefit')->nullable();
            $table->text('comments')->nullable();
            $table->integer('status')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
