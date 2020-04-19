<?php

namespace BigHairEnergy\Preview\Http\Controllers;

use BigHairEnergy\Preview\Http\Requests\PreviewRequest;
use BigHairEnergy\Preview\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PreviewController extends Controller
{
    public function index(Request $request)
    {
        return view('preview::layout', []);
    }

    public function authenticate(PreviewRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('email', data_get($validated, 'email'))->first();
        if (!$user || $user->secret_key !== data_get($validated, 'secret_key')) {
            return redirect()->route('bhe.preview')->withInput()->withErrors(['You are not authorized to preview this site.']);
        }
        $user->ip_address = $request->getClientIp();
        $user->save();
        $return = $request->return ?? '/';
        return redirect($return);
    }
}
