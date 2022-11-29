<?php

namespace Botble\Stream\Providers;

use Botble\Stream\Models\CalenderEconomy;
use Botble\Stream\Models\CategoriesStream;
use Botble\Stream\Models\Country;
use Botble\Stream\Models\StreamModel;
use Botble\Stream\Models\WallStreet;
use Botble\Stream\Models\WallStreetCalender;
use Botble\Stream\Repositories\Caches\CalenderEconomiCacheDecorator;
use Botble\Stream\Repositories\Caches\CategoriesStreamCacheDecorator;
use Botble\Stream\Repositories\Caches\CountryCacheDecorator;
use Botble\Stream\Repositories\Caches\WallStreetCacheDecorator;
use Botble\Stream\Repositories\Caches\WallStreetCalenderCacheDecorator;
use Botble\Stream\Repositories\Eloquent\CalenderEconomiRepository;
use Botble\Stream\Repositories\Eloquent\CategoriesStreamRepository;
use Botble\Stream\Repositories\Eloquent\CountryRepository;
use Botble\Stream\Repositories\Eloquent\WallStreetCalenderRepository;
use Botble\Stream\Repositories\Eloquent\WallStreetRepository;
use Botble\Stream\Repositories\Interfaces\CalenderEconomiInterface;
use Botble\Stream\Repositories\Interfaces\CategoriesStreamInterface;
use Botble\Stream\Repositories\Interfaces\CountryInterface;
use Botble\Stream\Repositories\Interfaces\WallStreetCalenderInterface;
use Botble\Stream\Repositories\Interfaces\WallStreetInterface;
use Illuminate\Support\ServiceProvider;
use Botble\Stream\Repositories\Caches\StreamCacheDecorator;
use Botble\Stream\Repositories\Eloquent\StreamRepository;
use Botble\Stream\Repositories\Interfaces\StreamInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

class StreamServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {


        $this->app->bind(WallStreetInterface::class, function () {
            return new WallStreetCacheDecorator(new WallStreetRepository(new WallStreet));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/stream')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web','api']);

        Event::listen(RouteMatched::class, function () {


            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-stream',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/stream::markets-news.name',
                'icon'        => 'far fa-newspaper',
                'url'         => route('markets-news.index'),
                'permissions' => ['markets-news.index'],
            ]);
        });
    }
}
