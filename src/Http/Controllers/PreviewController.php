<?php

namespace BigHairEnergy\Preview\Http\Controllers;

use Illuminate\Routing\Controller;

class PreviewController extends Controller
{
    public function index()
    {
        return view('preview.layout');
    }
}
