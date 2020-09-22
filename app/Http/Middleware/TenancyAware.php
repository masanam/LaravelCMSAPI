<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\DB;

class TenancyAware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd($request->route()->parameters());
        $tenancy = \App\Models\Tenancy::where('db', $request->route('db'))->first();

        if($tenancy) {
            // session([
            //     'db' => $request->route('db'),
            //     'owner_id' => $tenancy->created_by
            // ]);
            $request->attributes->set('owner_id', $tenancy->created_by);

            // config(['database.connections.mysql.database' => $tenancy->db]);
            // // config(['database.connections.mysql.database' => 'webcore']);
            // DB::purge('mysql');
            // DB::reconnect('mysql');

            // $newCon = 'new';
            // config(['database.connections.'.$newCon => [
            //     'driver' => 'mysql',
            //     'host' => env('DB_HOST'),
            //     'port' => env('DB_PORT'),
            //     'database' => $tenancy->db,
            //     'username' => env('DB_USERNAME'),
            //     'password' => env('DB_PASSWORD')
            // ]]);

            // DB::setDefaultConnection($newCon);
        } else {
            return abort(404);
        }

        return $next($request);
    }
}
