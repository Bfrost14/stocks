<?php

namespace App\Http\Controllers\Back;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function detail(User $user)
    {
        $user = User::findOrFail($user->id);
        return view('back.sharedUser.detail', compact('user'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render("back.sharedUser.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("back.sharedUser.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_responsable_RESPONSABLES' => 'required',
            'prenom_responsable_RESPONSABLES' => 'required',
            'date_naissance_RESPONSABLES' => 'required',
            'adresse_responsable_RESPONSABLES' => 'required',
            'role' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
        $request["password"] = Hash::make($request['password']);
        User::create($request->all());
        return back()->with(['ok' => __('Ajouté avec success.')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $users = User::findOrFail($user->id);
        return view('back.sharedUser.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("back.sharedUser.edit",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([

        ]);

        $request["password"] = Hash::make($request['password']);
        $user::where('id', $user->id)->update($request->except(['_token', '_method' ]));

        return back()->with(['ok' => __('Modification success.')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::find($user->id)->delete();
        return response()->json();
    }
}
