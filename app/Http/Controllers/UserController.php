<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Photo;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('photo')->latest()->orderBy('created_at', 'desc')->get();
        return response()->json([
          'users' => $users
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrfail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);


        if(trim($request->password) == ''){
          $input = $request->except('password');
        }else{
          $input = $request->all();
        }

        if($file = $request->file('image')){
          $name = time() . $file->getClientOriginalName();
          $file->move('images', $name);
          $photo = Photo::create(['file' => $name]);
          $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);

        //dd($input);
        $user->update($request->all());

        return response()->json([
          'success' => true,
          'message' => "User updated",
          'user' => $user,
          'request' => $input
        ]);
    }

    public function edits(Request $request, $id)
    {
        $user = User::findOrfail($id);


        if(trim($request->password) == ''){
          $input = $request->except('password');
        }else{
          $input = $request->all();
        }

        if($file = $request->file('image')){
          $name = time() . $file->getClientOriginalName();
          $file->move('images', $name);
          $photo = Photo::create(['file' => $name]);
          $input['photo_id'] = $photo->id;
        }

        $input['password'] = bcrypt($request->password);

        //dd($input);
        $user->update($input);

        return response()->json([
          'success' => true,
          'message' => "User updated",
          'user' => $user,
          'request' => $input
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id = null)
    {
      if ($request->id){
        foreach ($request->id as $id) {
            User::destroy($id);
        }
      }
    }


}
