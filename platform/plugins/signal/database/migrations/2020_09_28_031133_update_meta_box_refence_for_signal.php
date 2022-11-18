<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Botble\Signal\Models\Strategy;

class UpdateMetaBoxRefenceForSignal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::table('meta_boxes')->where('reference_type', 'strategy')->update(['reference_type' => Strategy::class]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        DB::table('meta_boxes')->where('reference_type', Strategy::class)->update(['reference_type' => 'strategy']);
    }
}
