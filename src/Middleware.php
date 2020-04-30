<?php

namespace BigHairEnergy\Preview;

use Carbon\Carbon;
use Closure;

class Middleware
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
        $path = $request->path();
        $preview = config('preview.path');
        if (!config('preview.enabled') || $path === $preview) {
            return $next($request);
        }

        $user = User::where('ip_address', $request->getClientIp())->first();
        if ($user) {
            $user->last_previewed_at = Carbon::now();
            $user->save();
            return $next($request);
        }
        $params = ['return' => $path];
        if ($request->has('email')) {
            $params['email'] = $request->get('email');
        }
        if ($request->has('secret_key')) {
            $params['secret_key'] = $request->get('secret_key');
        }
        return redirect(route('bhe.preview', $params));
    }
}
