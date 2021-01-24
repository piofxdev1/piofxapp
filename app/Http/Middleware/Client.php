<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Core\Client as Obj;
use Illuminate\Support\Facades\Cache;

class Client
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
        // get the domain name
        $domain = request()->getHttpHost();

        // refresh the cache
        if($request->get('refresh')){
            Cache::forget('client_'.$domain);
            session()->flush();
        }

        // load client from cache
        $client = Cache::remember('client_'.$domain, '3600', function () use($domain){
            return Obj::where('domain',$domain)->first();
        });


        // convert settings to object
        $settings = json_decode($client->settings);
       

        if(!$settings)
            abort('404','Invalid Settings');
        
        if($client){
            if($client->status){
                $theme = $settings->theme;
                session(['name' => $client->name]);
                session(['client' => $client]);
                session(['client_id' => $client->id]);
                session(['settings' => $settings]);
                session(['domain'=>$domain]);
                session(['theme' => $theme]);
                return $next($request);
            }else{
                abort('403','Site inactive');
            }
        }else{
            abort('403','Site not found');
        }
        
    }

   
}
