<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;

class CustomDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $domain = $request->getHost();
        $tenant = Tenant::where('domain', $domain)->firstOrFail();

        // Append domain and tenant to the Request object
        // for easy retrieval in the application.
        $request->merge([
            'domain' => $domain,
            'tenant' => $tenant
        ]);

        return $next($request);
    }
}
