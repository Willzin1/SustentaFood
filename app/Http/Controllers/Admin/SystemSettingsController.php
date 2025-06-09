<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SystemSettingsController extends Controller
{
    public function getSettings()
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get(env('API_URL') . 'settings');

        return view('pages.admin.settings.index', ['settings' => $response]);
    }

    public function changeCapacity(Request $request)
    {
        $token = session('api_token');

        $response = Http::withToken($token)->put(env('API_URL') . 'settings/update-max-capacity', [
            'capacidade_maxima' => $request->capacidade_maxima
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', $response['message']);
        }

        return redirect()->back()->with('error', 'Ocorreu um erro alterar capacidade');
    }
}
