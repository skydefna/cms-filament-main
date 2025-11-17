<?php

namespace App\Http\Middleware;

use App\Models\HitVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class IncrementVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $model = Cache::rememberForever('hit_visit', function () {
                return HitVisit::query()->where('name', 'hit_visit')->firstOrCreate([
                    'name' => 'hit_visit',
                ]);
            });
            $model->vzt()->increment();
        } catch (\Exception $exception) {
            Cache::forget('hit_visit');
        }

        return $next($request);
    }
}
