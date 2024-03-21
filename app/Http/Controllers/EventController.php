<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function list(Request $request)
    {
        return view('events');
    }

    public function add(Request $request)
    {
        return view('add-event');
    }

    public function save(Request $request)
    {
        $create = Event::create($request->except('_token'));
        if ($create) {
            return redirect()->intended('event');
        }

        return redirect()->back()->withInput($request->except('_token'));
    }

    public function delete(Request $request)
    {
        $delete = Event::find($request->id)->delete();
        if ($delete) {
            return redirect()->intended('event');
        }

        return redirect()->back();
    }
}
