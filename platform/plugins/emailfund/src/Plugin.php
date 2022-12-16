<?php

namespace Botble\Emailfund;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove()
    {
        Schema::dropIfExists('emailfunds');
        Schema::dropIfExists('emailfunds_translations');
    }
}
