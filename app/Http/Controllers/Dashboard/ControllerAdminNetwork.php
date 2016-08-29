<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Network;

class ControllerAdminNetwork extends Controller
{
    public function index()
    {
        $data = Network::all();
        return view('admin.network.index', compact('data'));
    }

    public function edit($id)
    {
        $data = Network::FindOrFail($id);
        return view('admin.network.edit', compact('data'));
    }
    public function update($id, Request $request)
    {
        $data = Network::FindOrFail($id);
        if (!$request['href'])
            $data['href'] = NULL;
        else
            $data['href'] = $request['href'];
        $data->save();
    }



}
