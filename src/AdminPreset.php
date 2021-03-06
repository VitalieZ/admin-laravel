<?php

namespace Viropanel\Admin;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Laravel\Ui\Presets\Preset;
use Symfony\Component\Finder\SplFileInfo;
use Illuminate\Support\Facades\File;

class AdminPreset extends Preset
{
    /** @var Command */
    protected $command;

    public $isFortify = false;



    public static function getViewPath($path = '')
    {
        return implode(DIRECTORY_SEPARATOR, [
            config('view.paths')[0] ?? resource_path('views'), $path,
        ]);
    }

    public function installAuth()
    {
        $viewsPath = $this->getViewPath();

        $this->ensureDirectoriesExist($viewsPath);

        $this->scaffoldAuth();

        if (!$this->isFortify) {
            $this->scaffoldController();
        }
    }

    protected function ensureDirectoriesExist($viewsPath)
    {
        if (!file_exists($viewsPath . 'layouts')) {
            mkdir($viewsPath . 'layouts', 0755, true);
        }

        if (!file_exists($viewsPath . 'auth')) {
            mkdir($viewsPath . 'auth', 0755, true);
        }

        if (!file_exists($viewsPath . 'auth/passwords')) {
            mkdir($viewsPath . 'auth/passwords', 0755, true);
        }
    }

    private function addAuthRoutes()
    {
        file_put_contents(
            base_path('routes/web.php'),
            "\nAuth::routes();\n",
            FILE_APPEND
        );
    }

    protected function scaffoldAuth()
    {

        if (!$this->isFortify) {
            $this->addAuthRoutes();
        }

        tap(new Filesystem(), function ($filesystem) {
            $filesystem->copyDirectory(__DIR__ . '/resources/views/auth', resource_path('views/auth'));
            File::copy(__DIR__ . '/resources/views/layouts/auth.blade.php', resource_path('views/layouts/auth.blade.php'));
            File::copy(__DIR__ . '/routes/admin.php', base_path('/routes/admin.php'));

            collect($filesystem->allFiles(base_path('vendor/laravel/ui/stubs/migrations')))
                ->each(function (SplFileInfo $file) use ($filesystem) {
                    $filesystem->copy(
                        $file->getPathname(),
                        database_path('migrations/' . $file->getFilename())
                    );
                });
        });
    }

    protected function scaffoldController()
    {
        if (!is_dir($directory = app_path('Http/Controllers/Auth'))) {
            mkdir($directory, 0755, true);
        }

        $filesystem = new Filesystem();

        collect($filesystem->allFiles(base_path('vendor/laravel/ui/stubs/Auth')))
            ->each(function (SplFileInfo $file) use ($filesystem) {
                $filesystem->copy(
                    $file->getPathname(),
                    app_path('Http/Controllers/Auth/' . Str::replaceLast('.stub', '.php', $file->getFilename()))
                );
            });
    }
}
