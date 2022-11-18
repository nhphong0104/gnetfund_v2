<?php

namespace Botble\Signal\Providers;

use Botble\Signal\Models\Asset;
use Botble\Signal\Models\Signal;
use Botble\Signal\Models\Strategy;
use Botble\Signal\Repositories\Caches\AssetCacheDecorator;
use Botble\Signal\Repositories\Caches\StrategyCacheDecorator;
use Botble\Signal\Repositories\Eloquent\AssetRepository;
use Botble\Signal\Repositories\Eloquent\StrategyRepository;
use Botble\Signal\Repositories\Interfaces\AssetInterface;
use Botble\Signal\Repositories\Interfaces\StrategyInterface;
use Illuminate\Support\ServiceProvider;
use Botble\Signal\Repositories\Caches\SignalCacheDecorator;
use Botble\Signal\Repositories\Eloquent\SignalRepository;
use Botble\Signal\Repositories\Interfaces\SignalInterface;
use Botble\Base\Supports\Helper;
use Event;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Illuminate\Routing\Events\RouteMatched;

use Language;
use SeoHelper;
use SlugHelper;

class SignalServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    public function register()
    {
        $this->app->bind(SignalInterface::class, function () {
            return new SignalCacheDecorator(new SignalRepository(new Signal));
        });

        $this->app->bind(AssetInterface::class, function () {
            return new AssetCacheDecorator(new AssetRepository(new Asset));
        });

        $this->app->bind(StrategyInterface::class, function () {
            return new StrategyCacheDecorator(new StrategyRepository(new Strategy));
        });

        Helper::autoload(__DIR__ . '/../../helpers');
    }

    public function boot()
    {
        $this->setNamespace('plugins/signal')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadMigrations()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes(['web']);

        Event::listen(RouteMatched::class, function () {
            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                \Language::registerModule([Signal::class]);
            }

            dashboard_menu()->registerItem([
                'id'          => 'cms-plugins-signal',
                'priority'    => 5,
                'parent_id'   => null,
                'name'        => 'plugins/signal::signal.name',
                'icon'        => 'fa fa-signal',
                'url'         => route('signal.index'),
                'permissions' => ['signal.index'],
            ])
            ->registerItem([
                'id'          => 'cms-plugins-signal-signal',
                'priority'    => 1,
                'parent_id'   => 'cms-plugins-signal',
                'name'        => 'plugins/signal::signal.name',
                'icon'        => null,
                'url'         => route('signal.index'),
                'permissions' => ['signal.index'],
            ])
            ->registerItem([
                'id'          => 'cms-plugins-signal-strategy',
                'priority'    => 2,
                'parent_id'   => 'cms-plugins-signal',
                'name'        => 'plugins/signal::strategies.name',
                'icon'        => null,
                'url'         => route('strategies.index'),
                'permissions' => ['strategies.index'],
            ])
            ->registerItem([
                'id'          => 'cms-plugins-signal-asset',
                'priority'    => 3,
                'parent_id'   => 'cms-plugins-signal',
                'name'        => 'plugins/signal::assets.name',
                'icon'        => null,
                'url'         => route('assets.index'),
                'permissions' => ['assets.index'],
            ]);
        });

        $this->app->booted(function () {
            $models = [Signal::class, Strategy::class, Asset::class];

            if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
                Language::registerModule($models);
            }

            SlugHelper::registerModule(Strategy::class);
            SlugHelper::setPrefix(Strategy::class, 'strategy');

            SeoHelper::registerModule(Strategy::class);
        });
    }
}
