<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class EnsureInstalled
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isInstalled()) {
            return $next($request);
        }

        if (
            $request->is('install') ||
            $request->is('install/*') ||
            $request->is('up') ||
            $request->is('build/*') ||
            $request->is('storage/*') ||
            $request->is('favicon.ico') ||
            $request->is('robots.txt')
        ) {
            return $next($request);
        }

        return redirect()->route('install.welcome');
    }

    private function isInstalled(): bool
    {
        return Storage::disk('local')->exists('installed');
    }
}
