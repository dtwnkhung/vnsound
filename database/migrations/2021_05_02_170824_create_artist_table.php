<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('banner')->nullable();
            $table->text('images')->nullable();
            $table->text('profile')->nullable();
            $table->text('clubs')->nullable();
            $table->text('partners')->nullable();
            $table->string('project_1_title')->nullable();
            $table->string('project_2_title')->nullable();
            $table->text('project_1_image')->nullable();
            $table->text('project_2_image')->nullable();
            $table->text('project_1_text')->nullable();
            $table->text('project_2_text')->nullable();
            $table->text('bts_text')->nullable();
            $table->text('bts_image')->nullable();
            $table->string('bts_link_yt')->nullable();
            $table->string('bts_link_sc')->nullable();
            $table->text('life_style_1')->nullable();
            $table->text('life_style_2')->nullable();
            $table->text('life_style_3')->nullable();
            $table->text('life_style_4')->nullable();
            $table->text('life_style_5')->nullable();
            $table->text('life_style_6')->nullable();
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
        Schema::dropIfExists('artists');
    }
}
