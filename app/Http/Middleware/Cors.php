<?php

namespace App\Http\Middleware;

use Closure;

class Cors {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next) {

    //     return $next($request)
    //       ->header('Access-Control-Allow-Origin', '*')
    //       ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
    //       ->header('Access-Control-Allow-Headers',' Origin, Content-Type, Accept, Authorization, X-Request-With')
    //       ->header('Access-Control-Allow-Credentials',' true');
    // }

    public function handle($request, Closure $next)  {
        $headers = [
            'Access-Control-Allow-Origin'      => '*',
            'Access-Control-Allow-Methods'     => 'GET, POST, PUT, PATCH, DELETE, OPTIONS',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'Origin, Content-Type, Accept, Authorization, X-Request-With'
        ];
    
        if ($request->isMethod('OPTIONS')) {
            return response()->json('{"method":"OPTIONS"}', 200, $headers);
        }
    
        $response = $next($request);
        foreach($headers as $key => $value) {
            $response->headers->set($key, $value);
        }
    
        return $response;
    }
}
