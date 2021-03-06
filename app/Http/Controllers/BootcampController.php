<?php

namespace KetoBootstrap\Http\Controllers;

use Illuminate\Http\Request;

class BootcampController extends Controller
{
    public function index()
    {
    	return view('bootcamp.index');
    }

    public function create()
    {
    	return view('bootcamp.create');
    }

    public function show($id)
    {
    	return view('bootcamp.'.$id);
    }
}
