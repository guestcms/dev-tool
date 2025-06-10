<?php

namespace Guestcms\DevTool\Providers;

use Guestcms\Base\Supports\ServiceProvider;
use Guestcms\DevTool\Commands\LocaleCreateCommand;
use Guestcms\DevTool\Commands\LocaleRemoveCommand;
use Guestcms\DevTool\Commands\Make\ControllerMakeCommand;
use Guestcms\DevTool\Commands\Make\FormMakeCommand;
use Guestcms\DevTool\Commands\Make\ModelMakeCommand;
use Guestcms\DevTool\Commands\Make\PanelSectionMakeCommand;
use Guestcms\DevTool\Commands\Make\RequestMakeCommand;
use Guestcms\DevTool\Commands\Make\RouteMakeCommand;
use Guestcms\DevTool\Commands\Make\SettingControllerMakeCommand;
use Guestcms\DevTool\Commands\Make\SettingFormMakeCommand;
use Guestcms\DevTool\Commands\Make\SettingMakeCommand;
use Guestcms\DevTool\Commands\Make\SettingRequestMakeCommand;
use Guestcms\DevTool\Commands\Make\TableMakeCommand;
use Guestcms\DevTool\Commands\PackageCreateCommand;
use Guestcms\DevTool\Commands\PackageMakeCrudCommand;
use Guestcms\DevTool\Commands\PackageRemoveCommand;
use Guestcms\DevTool\Commands\PluginCreateCommand;
use Guestcms\DevTool\Commands\PluginMakeCrudCommand;
use Guestcms\DevTool\Commands\RebuildPermissionsCommand;
use Guestcms\DevTool\Commands\TestSendMailCommand;
use Guestcms\DevTool\Commands\ThemeCreateCommand;
use Guestcms\DevTool\Commands\WidgetCreateCommand;
use Guestcms\DevTool\Commands\WidgetRemoveCommand;
use Guestcms\PluginManagement\Providers\PluginManagementServiceProvider;
use Guestcms\Theme\Providers\ThemeServiceProvider;
use Guestcms\Widget\Providers\WidgetServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            TableMakeCommand::class,
            ControllerMakeCommand::class,
            RouteMakeCommand::class,
            RequestMakeCommand::class,
            FormMakeCommand::class,
            ModelMakeCommand::class,
            PackageCreateCommand::class,
            PackageMakeCrudCommand::class,
            PackageRemoveCommand::class,
            TestSendMailCommand::class,
            RebuildPermissionsCommand::class,
            LocaleRemoveCommand::class,
            LocaleCreateCommand::class,
        ]);

        if (version_compare(get_core_version(), '7.0.0', '>=')) {
            $this->commands([
                PanelSectionMakeCommand::class,
                SettingControllerMakeCommand::class,
                SettingRequestMakeCommand::class,
                SettingFormMakeCommand::class,
                SettingMakeCommand::class,
            ]);
        }

        if (class_exists(PluginManagementServiceProvider::class)) {
            $this->commands([
                PluginCreateCommand::class,
                PluginMakeCrudCommand::class,
            ]);
        }

        if (class_exists(ThemeServiceProvider::class)) {
            $this->commands([
                ThemeCreateCommand::class,
            ]);
        }

        if (class_exists(WidgetServiceProvider::class)) {
            $this->commands([
                WidgetCreateCommand::class,
                WidgetRemoveCommand::class,
            ]);
        }
    }
}
