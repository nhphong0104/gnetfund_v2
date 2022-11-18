<?php

use Botble\ACL\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SignalCreateSignalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->string('description', 400)->nullable();
            $table->integer('author_id')->default(0);
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->tinyInteger('order')->default(0);
            $table->tinyInteger('is_featured')->default(0);
            $table->tinyInteger('is_default')->unsigned()->default(0);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });

        Schema::create('strategies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120);
            $table->string('description', 400)->nullable();
            $table->text('content');
            $table->integer('author_id')->default(0);
            $table->string('author_type', 255)->default(addslashes(User::class));
            $table->tinyInteger('is_featured')->default(0);
            $table->string('status', 60)->default('published');
            $table->timestamps();
        });


        Schema::create('signals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 120)->nullable();
            $table->string('status', 60)->default('published');
            $table->integer('asset_id')->default(0);
            $table->integer('strategy_id')->default(0);
            $table->string('side',100)->nullable();
            $table->string('price_open',30)->default(0);
            $table->string('price_close',30)->default(0);
            $table->string('sl',30)->default(0);
            $table->string('tp',30)->default(0);
            $table->integer('status_loss')->default(0);
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
        Schema::dropIfExists('signals');
        Schema::dropIfExists('assets');
        Schema::dropIfExists('strategies');
    }
}
