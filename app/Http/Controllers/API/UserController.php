<?php

namespace App\Http\Controllers\API;

use App\Notifications\AccountActivation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //        $this->middleware('auth:api');
        //this makes sure that people are authorized before using any of
        //below functions
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::latest()->paginate(5);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'address' => 'required|min:3',
            'phone' => 'required|string|min:10|max:10',
            'image' => 'required| mimes:jpeg,png,jpg'
        ]);

        if($request->photo){

            $name = md5(microtime()) . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
            //laravel intervention to convert base 64 image and save to profile
            \Image::make($request->photo)->save(public_path('/img/profile/') . $name);

            //merge the new value that is name into $request array of photo field
            $request->merge(['photo' => $name]);
        }

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'type' => 'user',
            'phone' => $request['phone'],
            'address' => $request['address'],
            'password' => bcrypt($request['password']),
            'photo' => $request['photo'],
            'remember_token' => Str::random(60)
        ]);

        $user->notify(new AccountActivation($user));

        return response()->json([
            'message' => 'Success',
            'status' => 201
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::where('id',$id)->first();
    }

    //profile section
    public function profile($id)
    {
        return User::where('id',$id)->first();
    }



    public function updateProfile(Request $request)
    {
        $user = User::findOrFail($request->id);
        //grabs the authorized user information

        //validation
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|min:6',
            'phone' => 'required|string|min:10|max:50'

        ]);

        //checking same photo or not
        $currentPhoto = $user->photo;
        if ($request->photo != $currentPhoto) {
            //$name is for naming convention of image
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            //laravel intervention to convert base 64 image and save to profile
            \Image::make($request->photo)->save(public_path('img/profile/') . $name);

            //merge the new value that is name into $request array of photo field
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/') . $currentPhoto;
            //deletes the photo
            if (file_exists($userPhoto)) {
                @unlink($userPhoto);
            }
        }
        if (!empty($request->password)) {
            $request->merge(['password' => Hash::make($request['password'])]);
        }
        $user->update($request->all());
        return [$user->photo];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
        //in email validation we check whether we have same email
        //if same email,then fine check unique email in the database
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:6'
        ]);
        //sometimes only validate the field if the field is present
        $user->update($request->all());
        return ['message' => 'Updated the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

//        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'User Deleted'];

    }

    public function search(){
        if ($search = \Request::get('q')) {
            $users = User::where(function($query) use ($search){
                $query->where('name','LIKE',"%$search%")
                    ->orWhere('email','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $users = User::latest()->paginate(5);
        }
        return $users;
    }
}
