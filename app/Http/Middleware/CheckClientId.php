<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Passport\Client;

class CheckClientId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $client = Client::where('password_client', 1)
            ->where('id', $request->client_id)
            ->where('secret', $request->client_secret)
            ->first();

        if (empty($client)) {
            $error = [
                'error' => 'invalid_client',
                'message' => 'Client authentication failed',
            ];
            return response($error, 503);
        }
        return $next($request);
    }
}
