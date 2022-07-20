<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add([
                'text' => 'Dashboard',
                'url' => route('home'),
                'icon' => 'fas fa-home',
                'active' => ['home'],
                'permission' => 'dashboard',
            ]);

            $event->menu->add([
                'text' => 'Form',
                'icon' => 'fas fa-layer-group',
                'permission' => 'form',
                'submenu' => [
                    [
                        'text' => 'Pembuatan ID',
                        'url' => route('form_pembuatan.index'),
                        'icon' => 'fas fa-file-alt',
                        'active' => ['form_pembuatan*'],
                        'permission' => 'form-pembuatan',
                    ],
                    [
                        'text' => 'Penghapusan ID',
                        'url' => route('form_penghapusan.index'),
                        'icon' => 'fas fa-file-alt',
                        'active' => ['form_penghapusan*'],
                        'permission' => 'form-penghapusan',
                    ],
                    [
                        'text' => 'Pemindahan ID',
                        'url' => route('form_pemindahan.index'),
                        'icon' => 'fas fa-file-alt',
                        'active' => ['form_pemindahan*'],
                        'permission' => 'form-pemindahan',
                    ],

                ],
            ]);

            $event->menu->add([
                'text' => 'Approval',
                'icon' => '	fas fa-file-signature',
                'permission' => 'approval',
                'submenu' => [
                    [
                        'text' => 'Pembuatan ID',
                        'url' => route('approval_pembuatan.index'),
                        'icon' => 'fas fa-file-signature',
                        'active' => ['approval_pembuatan*'],
                        'permission' => 'approval-pembuatan',
                    ],
                    [
                        'text' => 'Penghapusan ID',
                        'url' => route('approval_penghapusan.index'),
                        'icon' => 'fas fa-file-signature',
                        'active' => ['approval_penghapusan*'],
                        'permission' => 'approval-penghapusan',
                    ],
                ],
            ]);
        });
    }
}
