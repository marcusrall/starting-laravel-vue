<?php

use Illuminate\Http\Request;
use App\User;
use App\Photo;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('users', 'UserController');

Route::post('submit', function(Request $request){

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
    User::create($input);

    return response()->json([
      'success' => true,
      'menssage' => 'images uploaded'
    ]);

})->name('submit');
