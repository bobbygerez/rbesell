<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next, ...$params)
    {

        $roles = $request->user()->roles()->get();

        $roles = $roles->map(function($item){

            return $item->name;
        });



        foreach ($params as $value) {
            
            if( ! in_array($value, $roles->toArray()) ){

                return response()->json([

                        'message' => 'Access Denied!'
                    ]);
            }
        }


        return $next($request);
    }
}
