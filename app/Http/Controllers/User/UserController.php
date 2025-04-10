<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public readonly User $user;
    public function __construct()
    {
        $this->user = new User();
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create() : View
    // {
    //     return view('pages.users.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request): RedirectResponse
    // {
    //     $response = Http::post('http://localhost:3030/api/users/', [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone' => $request->phone,
    //         'password' => $request->password
    //        ]);

    //     if ($response->successful()) {
    //         return redirect()->route('login')->with('success', $response->json()['message']);
    //     }

    //     return redirect()->back()->withInput()->withErrors(['error' => $response->json()['errors']]);
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $user = $this->user->find($id);
        return view('pages.users.dashboard', ['user' => $user, 'reservas' => $user->reservas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $token = session('api_token');

        $response = Http::withToken($token)->get("http://localhost:3030/api/users/{$id}");

        if ($response->successful()) {
            $user = $response->json();

            return view('pages.users.edit', ['user' => $user]);
        }

        return view('errors.page404');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id): RedirectResponse
    {
        $user = $this->user->find($id);
        $token = session('api_token');

        $response = Http::withToken($token)->put('http://localhost:3030/api/users/' . $user->id, [
            'name' => $request->name,
            'phone' => $request->phone
        ]);

        if($response->successful()) {
            return redirect()->route('users.show', ['user' => $user->id])->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = $this->user->find($id);
        $token = session('api_token');

        $response = Http::withToken($token)->delete('http://localhost:3030/api/users/' . $user->id);

        if($response->successful()) {
            return redirect()->route('login')->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }
}
