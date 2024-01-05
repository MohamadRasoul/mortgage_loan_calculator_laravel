<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Throwable;

// class TransactionMiddleware extends Middleware
class TransactionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response|RedirectResponse) $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        DB::beginTransaction();


        $response = $next($request);
        // DB::rollBack();
        if (property_exists($response, 'exception')) {
            $response->exception instanceof Throwable ? DB::rollBack() : DB::commit();
        }
        return $response;
    }
}
