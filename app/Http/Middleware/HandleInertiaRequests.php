<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    //protected $rootView = 'app';


    public function rootView(Request $request)
    {
        // Check if the request path starts with 'admin'
        if ($request->is('admin*')) {
            return 'app'; // View for admin
        }   else{
            return 'frontend'; // View for non-admin
        }


       }//end method

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'flash' => [
                //'message' => $request->session()->get('message')
                'message' => session('message')
            ],//end flash

            'user'=>[
                'name'=>Auth::user()->name ?? '',
                'role'=>Auth::user()->role ?? '',
            ],
        ]);
    }//end method


}//end class
