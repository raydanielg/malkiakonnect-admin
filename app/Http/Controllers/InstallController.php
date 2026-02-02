<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InstallController extends Controller
{
    public function welcome(Request $request): View|RedirectResponse
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        return view('install.welcome', [
            'step' => 'welcome',
        ]);
    }

    public function requirements(Request $request): View|RedirectResponse
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        $requirements = $this->requirementsReport();

        return view('install.requirements', [
            'step' => 'requirements',
            'requirements' => $requirements,
        ]);
    }

    public function database(Request $request): View|RedirectResponse
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        return view('install.database', [
            'step' => 'database',
            'data' => [
                'connection' => old('connection', (string) ($request->session()->get('install.db.connection') ?? env('DB_CONNECTION', 'mysql'))),
                'host' => old('host', (string) ($request->session()->get('install.db.host') ?? env('DB_HOST', '127.0.0.1'))),
                'port' => old('port', (string) ($request->session()->get('install.db.port') ?? env('DB_PORT', '3306'))),
                'database' => old('database', (string) ($request->session()->get('install.db.database') ?? env('DB_DATABASE', ''))),
                'username' => old('username', (string) ($request->session()->get('install.db.username') ?? env('DB_USERNAME', ''))),
                'password' => old('password', (string) ($request->session()->get('install.db.password') ?? env('DB_PASSWORD', ''))),
            ],
        ]);
    }

    public function databaseTest(Request $request): RedirectResponse
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        $validated = $request->validate([
            'connection' => ['required', 'in:mysql,pgsql,sqlsrv,sqlite'],
            'host' => ['nullable', 'string'],
            'port' => ['nullable', 'string'],
            'database' => ['required', 'string'],
            'username' => ['nullable', 'string'],
            'password' => ['nullable', 'string'],
        ]);

        $request->session()->put('install.db', $validated);

        try {
            $this->testDbConnection($validated);
        } catch (\Throwable $e) {
            return back()->withInput()->with('install_error', $e->getMessage());
        }

        return redirect()->route('install.settings')->with('install_success', 'Database connection successful.');
    }

    public function settings(Request $request): View|RedirectResponse
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        return view('install.settings', [
            'step' => 'settings',
            'data' => [
                'app_name' => old('app_name', (string) ($request->session()->get('install.settings.app_name') ?? env('APP_NAME', 'Malkia Konnect'))),
                'app_url' => old('app_url', (string) ($request->session()->get('install.settings.app_url') ?? env('APP_URL', 'http://localhost'))),
                'app_timezone' => old('app_timezone', (string) ($request->session()->get('install.settings.app_timezone') ?? config('app.timezone', 'UTC'))),
            ],
        ]);
    }

    public function settingsSave(Request $request): RedirectResponse
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        $validated = $request->validate([
            'app_name' => ['required', 'string', 'max:120'],
            'app_url' => ['required', 'url'],
            'app_timezone' => ['required', 'string', 'max:80'],
        ]);

        $request->session()->put('install.settings', $validated);

        return redirect()->route('install.admin');
    }

    public function admin(Request $request): View|RedirectResponse
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        return view('install.admin', [
            'step' => 'admin',
            'data' => [
                'name' => old('name', (string) ($request->session()->get('install.admin.name') ?? 'Administrator')),
                'email' => old('email', (string) ($request->session()->get('install.admin.email') ?? 'admin@example.com')),
            ],
        ]);
    }

    public function adminSave(Request $request): RedirectResponse
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request->session()->put('install.admin', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return redirect()->route('install.finish');
    }

    public function finish(Request $request): View|RedirectResponse
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        $requirements = $this->requirementsReport();

        return view('install.finish', [
            'step' => 'finish',
            'requirements' => $requirements,
            'hasDb' => (bool) $request->session()->get('install.db'),
            'hasSettings' => (bool) $request->session()->get('install.settings'),
            'hasAdmin' => (bool) $request->session()->get('install.admin'),
        ]);
    }

    public function finishSave(Request $request): RedirectResponse
    {
        if ($this->isInstalled()) {
            return redirect('/');
        }

        $requirements = $this->requirementsReport();
        if (! $requirements['ok']) {
            return redirect()->route('install.requirements')->with('install_error', 'Please fix the requirements before continuing.');
        }

        $db = $request->session()->get('install.db');
        $settings = $request->session()->get('install.settings');
        $admin = $request->session()->get('install.admin');

        if (! is_array($db) || ! is_array($settings) || ! is_array($admin)) {
            return redirect()->route('install.welcome')->with('install_error', 'Please complete all installation steps.');
        }

        try {
            $this->testDbConnection($db);
        } catch (\Throwable $e) {
            return redirect()->route('install.database')->with('install_error', $e->getMessage());
        }

        try {
            $this->writeEnv([
                'APP_NAME' => $settings['app_name'],
                'APP_URL' => $settings['app_url'],
                'APP_TIMEZONE' => $settings['app_timezone'],

                'DB_CONNECTION' => $db['connection'],
                'DB_HOST' => $db['host'] ?? '',
                'DB_PORT' => $db['port'] ?? '',
                'DB_DATABASE' => $db['database'],
                'DB_USERNAME' => $db['username'] ?? '',
                'DB_PASSWORD' => $db['password'] ?? '',
            ]);

            $driver = $db['connection'];
            Config::set('database.default', $driver);

            $runtimeConnectionConfig = match ($driver) {
                'mysql' => [
                    'driver' => 'mysql',
                    'host' => $db['host'] ?? '127.0.0.1',
                    'port' => $db['port'] ?? '3306',
                    'database' => $db['database'],
                    'username' => $db['username'] ?? '',
                    'password' => $db['password'] ?? '',
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'strict' => true,
                    'engine' => null,
                ],
                'pgsql' => [
                    'driver' => 'pgsql',
                    'host' => $db['host'] ?? '127.0.0.1',
                    'port' => $db['port'] ?? '5432',
                    'database' => $db['database'],
                    'username' => $db['username'] ?? '',
                    'password' => $db['password'] ?? '',
                    'charset' => 'utf8',
                    'prefix' => '',
                    'prefix_indexes' => true,
                    'search_path' => 'public',
                    'sslmode' => 'prefer',
                ],
                'sqlsrv' => [
                    'driver' => 'sqlsrv',
                    'host' => $db['host'] ?? 'localhost',
                    'port' => $db['port'] ?? '1433',
                    'database' => $db['database'],
                    'username' => $db['username'] ?? '',
                    'password' => $db['password'] ?? '',
                    'charset' => 'utf8',
                    'prefix' => '',
                    'prefix_indexes' => true,
                ],
                'sqlite' => [
                    'driver' => 'sqlite',
                    'database' => $db['database'],
                    'prefix' => '',
                    'foreign_key_constraints' => true,
                ],
                default => throw new \InvalidArgumentException('Unsupported database driver.'),
            };

            Config::set("database.connections.{$driver}", array_merge(
                (array) Config::get("database.connections.{$driver}", []),
                $runtimeConnectionConfig
            ));

            DB::purge($driver);

            Artisan::call('migrate', ['--force' => true]);

            $user = User::query()->firstOrCreate(
                ['email' => $admin['email']],
                ['name' => $admin['name']]
            );

            $user->forceFill([
                'name' => $admin['name'],
                'password' => Hash::make($admin['password']),
                'is_admin' => true,
            ])->save();

            Storage::disk('local')->put('installed', now()->toIso8601String());

            $request->session()->forget('install');
        } catch (\Throwable $e) {
            return redirect()->route('install.finish')->with('install_error', $e->getMessage());
        }

        return redirect('/')->with('install_success', 'Installation completed successfully.');
    }

    private function requirementsReport(): array
    {
        $checks = [];

        $checks[] = [
            'label' => 'PHP version >= 8.2',
            'ok' => version_compare(PHP_VERSION, '8.2.0', '>='),
            'hint' => PHP_VERSION,
        ];

        $extensions = ['openssl', 'pdo', 'mbstring', 'tokenizer', 'xml', 'ctype', 'json'];
        foreach ($extensions as $ext) {
            $checks[] = [
                'label' => 'Extension: '.$ext,
                'ok' => extension_loaded($ext),
                'hint' => extension_loaded($ext) ? 'enabled' : 'missing',
            ];
        }

        $paths = [
            storage_path(),
            base_path('bootstrap/cache'),
        ];

        foreach ($paths as $path) {
            $checks[] = [
                'label' => 'Writable: '.$path,
                'ok' => is_writable($path),
                'hint' => is_writable($path) ? 'writable' : 'not writable',
            ];
        }

        $ok = collect($checks)->every(fn ($c) => (bool) $c['ok']);

        return [
            'ok' => $ok,
            'checks' => $checks,
        ];
    }

    private function testDbConnection(array $db): void
    {
        $connectionName = 'installer_test';

        $driver = $db['connection'];

        $config = match ($driver) {
            'mysql' => [
                'driver' => 'mysql',
                'host' => $db['host'] ?? '127.0.0.1',
                'port' => $db['port'] ?? '3306',
                'database' => $db['database'],
                'username' => $db['username'] ?? '',
                'password' => $db['password'] ?? '',
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'strict' => true,
            ],
            'pgsql' => [
                'driver' => 'pgsql',
                'host' => $db['host'] ?? '127.0.0.1',
                'port' => $db['port'] ?? '5432',
                'database' => $db['database'],
                'username' => $db['username'] ?? '',
                'password' => $db['password'] ?? '',
                'charset' => 'utf8',
                'prefix' => '',
            ],
            'sqlsrv' => [
                'driver' => 'sqlsrv',
                'host' => $db['host'] ?? 'localhost',
                'port' => $db['port'] ?? '1433',
                'database' => $db['database'],
                'username' => $db['username'] ?? '',
                'password' => $db['password'] ?? '',
                'charset' => 'utf8',
                'prefix' => '',
            ],
            'sqlite' => [
                'driver' => 'sqlite',
                'database' => $db['database'],
                'prefix' => '',
            ],
            default => throw new \InvalidArgumentException('Unsupported database driver.'),
        };

        Config::set("database.connections.{$connectionName}", $config);

        DB::purge($connectionName);

        $pdo = DB::connection($connectionName)->getPdo();

        if (! $pdo) {
            throw new \RuntimeException('Unable to establish database connection.');
        }
    }

    private function writeEnv(array $pairs): void
    {
        $envPath = base_path('.env');

        if (! is_file($envPath) || ! is_readable($envPath) || ! is_writable($envPath)) {
            throw new \RuntimeException('The .env file is not writable.');
        }

        $contents = file_get_contents($envPath);
        if ($contents === false) {
            throw new \RuntimeException('Unable to read .env file.');
        }

        foreach ($pairs as $key => $value) {
            $value = $this->escapeEnvValue((string) $value);

            $pattern = "/^".preg_quote($key, '/')."=.*/m";
            $replacement = $key."=".$value;

            if (preg_match($pattern, $contents) === 1) {
                $contents = preg_replace($pattern, $replacement, $contents, 1);
            } else {
                $contents .= "\n".$replacement;
            }
        }

        if (file_put_contents($envPath, $contents) === false) {
            throw new \RuntimeException('Unable to write .env file.');
        }
    }

    private function escapeEnvValue(string $value): string
    {
        $needsQuotes = str_contains($value, ' ') || str_contains($value, '#') || str_contains($value, '"');

        if (! $needsQuotes) {
            return $value;
        }

        $value = str_replace('"', '\\"', $value);

        return '"'.$value.'"';
    }

    private function isInstalled(): bool
    {
        return Storage::disk('local')->exists('installed');
    }
}
