<?php

namespace Nacosvel\RoosterServer;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->headers->has($key = 'tx-server-group') && $request->header($key) === config('rooster-server.tx_server_group_name')) {
            return $next($request);
        }

        throw new \RuntimeException('Server group not match');
    }

}
