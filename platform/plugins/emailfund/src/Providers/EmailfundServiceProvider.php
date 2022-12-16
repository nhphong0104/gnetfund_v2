<?php

namespace Botble\Emailfund\Providers;

use Botble\Emailfund\Models\Emailfund;
use Illuminate\Support\ServiceProvider;
use Botble\Emailfund\Repositories\Caches\EmailfundCacheDecorator;
use Botble\Emailfund\Repositories\Eloquent\EmailfundRepository;
use Botble\Emailfund\Repositories\Interfaces\EmailfundInterface;
use Illuminate\Support\Facades\Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class EmailfundServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register()
    {
        $this->app->bind(EmailfundInterface::class, function () {
            return new EmailfundCacheDecorator(new EmailfundRepository(new Emailfund));
        });

        $this->setNamespace('plugins/emailfund')->loadHelpers();
    }

    public function boot()
    {
        $this
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadRoutes(['web']);

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
            if (defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
                // Use language v2
                \Botble\LanguageAdvanced\Supports\LanguageAdvancedManager::registerModule(Emailfund::class, [
                    'name',
                ]);
            } else {
                // Use language v1
                $this->app->booted(function () {
                    \Language::registerModule([Emailfund::class]);
                });
            }
        }

        Event::listen(RouteMatched::class, function () {
            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-emailfund',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/emailfund::emailfund.name',
                'icon'        => 'fa fa-list',
                'url'         => route('emailfund.index'),
                'permissions' => ['emailfund.index'],
            ]);
        });
    }
}
