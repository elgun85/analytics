<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyseController extends Controller
{
    public function ixa()
    {
        return view('Analyse.ixa');
    }

    public function dp()
    {
        return view('Analyse.dp');
    }

    public function hm()
    {
        return view('Analyse.hm');
    }

    public function ml()
    {
        return view('Analyse.ml');
    }

    public function mld()
    {
        return view('Analyse.mld');
    }
}
