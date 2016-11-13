<?php

/**
 * Criado por Maizer Aly de O. Gomes para iget.
 * Email: maizer.gomes@gmail.com / maizer.gomes@ekutivasolutions / maizer.gomes@outlook.com
 * Usuário: Maizer
 * Data: 13/11/2016
 * Hora: 20:09
 */
namespace eKutivaSolutions\Payments\Providers;

use eKutivaSolutions\SymLinker\Console\Commands\SymlinkCommand;
use Illuminate\Support\ServiceProvider;

class PaymentsServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }

    public function registerCommands()
    {
        $this->app->bind('command.storage:symlink', SymlinkCommand::class);

        $this->commands('command.storage:symlink');
    }
}