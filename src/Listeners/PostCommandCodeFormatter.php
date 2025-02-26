<?php

declare(strict_types=1);

namespace ImoTikuwa\LaravelMakeWithFormat\Listeners;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Support\Facades\App;
use ImoTikuwa\LaravelMakeWithFormat\Services\CommandRunner\IdeHelperRunner;
use ImoTikuwa\LaravelMakeWithFormat\Services\CommandRunner\PintRunner;

class PostCommandCodeFormatter
{
    /**
     * サポート対象の make:●● コマンド一覧
     *
     * @var array<string, string>
     */
    protected $supportedMakeCommands = [
        // 'make:cache-table' => '',
        'make:cast' => 'app/Casts',
        'make:channel' => 'app/Broadcasting',
        // 'make:class' => '',
        'make:command' => 'app/Console/Commands',
        'make:component' => 'app/View/Components',
        'make:controller' => 'app/Http/Controllers',
        // 'make:enum' => '',
        'make:event' => 'app/Events',
        'make:exception' => 'app/Exceptions',
        'make:factory' => 'database/factories',
        // 'make:interface' => '',
        'make:job' => 'app/Jobs',
        'make:job-middleware' => 'app/Jobs/Middleware',
        'make:listener' => 'app/Listeners',
        'make:mail' => 'app/Mail',
        'make:middleware' => 'app/Http/Middleware',
        'make:migration' => 'database/migrations',
        'make:model' => 'app/Models',
        'make:notification' => 'app/Notifications',
        // 'make:notifications-table' => '',
        'make:observer' => 'app/Observers',
        'make:policy' => 'app/Policies',
        'make:provider' => 'app/Providers',
        // 'make:queue-batches-table' => '',
        // 'make:queue-failed-tableable' => '',
        // 'make:queue-table' => '',
        'make:request' => 'app/Http/Requests',
        'make:resource' => 'app/Http/Resources',
        'make:rule' => 'app/Rules',
        'make:scope' => 'app/Models/Scopes',
        'make:seeder' => 'database/seeders',
        // 'make:session-table' => '',
        'make:test' => 'tests/Feature',
        // 'make:trait' => '',
        // 'make:view' => '',
    ];

    public function __construct(
        private readonly PintRunner $pintRunner,
        private readonly IdeHelperRunner $ideHelperRunner
    ) {}

    public function handle(CommandFinished $event)
    {
        if (!App::environment('local')) {
            // APP_ENVがローカル以外のとき何もしない
            return;
        } elseif (!config('make-with-format.enabled')) {
            // 設定ファイルによって無効化されているとき何もしない
            return;
        } elseif ($event->exitCode !== 0) {
            // 実行したコマンド自体の終了コードが正常でないときは何もしない
            return;
        } elseif (is_null($event->output)) {
            // イベントのOutputInterfaceがnullのとき何もしない
            return;
        } elseif (!array_key_exists($event->command, $this->supportedMakeCommands)) {
            // サポート中のコマンドでないとき何もしない
            return;
        }

        $target = $this->supportedMakeCommands[$event->command];

        // ide-helper 実行
        if ($event->command === 'make:model') {
            $this->ideHelperRunner->run($target, $event);
        }

        // pint 実行
        $this->pintRunner->run($target, $event);
    }
}
