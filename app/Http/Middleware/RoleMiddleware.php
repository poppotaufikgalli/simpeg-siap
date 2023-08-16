<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $menu = $request->session()->get('menu');
        $nakses = $request->session()->get('nakses');
        $dokakses = $request->session()->get('dokakses');
        $dakses = $request->session()->get('dakses');
        $konakses = $request->session()->get('konakses');
        $kakses = $request->session()->get('kakses');
        //dd($kakses);
        /*if(2 == 1){
            return redirect('/dashboard')->withErrors('Halaman yang anda tuju tidak sesuai dengan hak akses anda');
            //return route('dashboard');
        }
        return $next($request);*/
        $currentPath = explode('.', Route::currentRouteName());

        if (in_array($currentPath[0], $menu)) {
            if(isset($currentPath[1])){
                $subAction = $nakses[$currentPath[0]];
                $scr = "_".$currentPath[1];
                if(in_array($scr, $subAction) == false){
                    $subAction[] = $scr;
                    return redirect('/unauthorized')->withErrors($subAction);
                }
            }
            return $next($request);
        }else{
            /*if(isset($currentPath[1])){
                $subAction = $dokakses[$currentPath[0]];
                $scr = "_".$currentPath[1];
                if(in_array($scr, $subAction) == false){
                    $subAction[] = $scr;
                    return redirect('/unauthorized')->withErrors($subAction);
                }
            }*/
            //dd($currentPath);
            if(in_array($currentPath[0], $dokakses)){
                if(isset($currentPath[1])){
                    if(isset($currentPath[2])){
                        $subAction = $dakses[$currentPath[0]];
                        $scr = "_".$currentPath[2];
                        if(in_array($scr, $subAction) == false){
                            $subAction[] = $scr;
                            return redirect('/unauthorized')->withErrors($subAction);
                        }    
                    }
                    
                }
            }elseif(in_array($currentPath[0], $konakses)){
                if(isset($currentPath[1])){
                    if(isset($currentPath[2])){
                        $subAction = $kakses[$currentPath[0]];
                        $scr = "_".$currentPath[2];
                        if(in_array($scr, $subAction) == false){
                            $subAction[] = $scr;
                            return redirect('/unauthorized')->withErrors($subAction);
                        }    
                    }
                    
                }
            }else{
                return redirect('/unauthorized')->withErrors("Undefined Root. ".$currentPath[0]. ($currentPath[1] ?? ''));                
            }
            return $next($request);
        }

        return redirect('/unauthorized');
    }
}
