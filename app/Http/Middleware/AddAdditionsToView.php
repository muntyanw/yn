<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AddsPage;

class AddAdditionsToView
{
    public function handle(Request $request, Closure $next)
    {
        // Получаем данные дополнений
        $addsPages = AddsPage::where('enabled', true)->get();

        $headerAdditions = '';
        $bodyAdditions = '';
        $scriptAdditions = '';

        foreach ($addsPages as $addsPage) {
            $headerAdditions .= $addsPage->header_additions ?? '';
            $bodyAdditions .= $addsPage->body_additions ?? '';
            $scriptAdditions .= $addsPage->script_additions ?? '';
        }

        // Передаем данные во вьюхи
        view()->share('headerAdditions', $headerAdditions);
        view()->share('bodyAdditions', $bodyAdditions);
        view()->share('scriptAdditions', $scriptAdditions);

        return $next($request);
    }
}
