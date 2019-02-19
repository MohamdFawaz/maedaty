<?php

namespace App\Http\Middleware;

use Closure;

class ValidateShop {
    public function handle($request, Closure $next)
    {
        $request_array = $request->all();
        $all_request_array = $request->all();
        if($request_array['data']){
            $request_array =  $request_array['data'];
        }
        $request->replace($request_array);
        $request->merge(['user_image'=> $all_request_array['user_image']]);
        return $next($request);
    }
}