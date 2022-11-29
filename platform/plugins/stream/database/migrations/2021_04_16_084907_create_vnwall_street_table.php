<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVnwallStreetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vnwallstreet', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->string('country',255)->nullable();
            $table->string('actual',32)->nullable();
            $table->string('influence',32)->nullable();
            $table->string('affect',32)->nullable();
            $table->string('consensus',32)->nullable();
            $table->string('previous',32)->nullable();
            $table->string('revised',32)->nullable();
            $table->string('vn_pub_date',32)->nullable();
            $table->string('is_important',32)->nullable();
            $table->string('is_pub',32)->nullable();
            $table->string('fast_type',32)->nullable();
            $table->string('star',32)->nullable();
            $table->string('tag',32)->nullable();
            $table->string('unit',255)->nullable();
            $table->integer('importance')->default(0);
            $table->integer('id_wall')->default(0);
            $table->integer('jid')->default(0);
            $table->integer('type')->default(0);
            $table->string('status', 60)->default('published');
            $table->dateTime('pub_date');
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
        Schema::dropIfExists('vnwallstreet');
    }
}
