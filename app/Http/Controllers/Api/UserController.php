<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use mysql_xdevapi\Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->api('users fetched successfully', STATUS_OK, $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $userData = $request->all();
        // encrypt the passport
        $userData['password'] = Hash::make($request->input('password'));
        $user = User::create($userData); // save data
        return response()->api('user registered successfully', STATUS_OK, $user);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->api('user data fetched successfully', STATUS_OK, $user);
        } catch (ModelNotFoundException $exception) {
            return response()->api('user not found', STATUS_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id = '')
    {
        try {
            $user = User::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw new \Exception('user not found');
        }
        $user->fill($request->all());
        $user->update();
        return response()->api("user's data updated successfully", STATUS_OK , $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
