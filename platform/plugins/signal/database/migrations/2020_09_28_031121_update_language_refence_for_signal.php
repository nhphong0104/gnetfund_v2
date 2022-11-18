<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Botble\Signal\Models\Strategy;

class UpdateLanguageRefenceForSignal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasTable('language_meta')) {
            DB::table('language_meta')->where('reference_type', 'strategy')->update(['reference_type' => Strategy::class]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        if (Schema::hasTable('language_meta')) {
            DB::table('language_meta')->where('reference_type', Strategy::class)->update(['reference_type' => 'strategy']);
        }
    }
}
