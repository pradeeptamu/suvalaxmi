<?php

namespace App\Http\Controllers\frontend;

use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Newsletter\NewsletterFacade as Newsletter;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = User::whereEmail(request('email'))->first();

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid credentials',
                'status' => 421]);
        }

        if (auth()->user()->type != 'user') {
            return response(['message' => 'Invalid authority',
                'status' => 420]);
        }

        if (!$user->active) {
            return response()->json([
                'message' => 'Your account is not active yet. Please activate your account.',
                'status' => 422
            ]);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);

    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function logout(Request $request)
    {
        try {
            $result = $request->user()->token()->revoke();
            if (!$result) {
                throw new \Exception('Try again', 500);
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Logged Out Successfully'
            ]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    //account activate
    public function accountActivation($token)
    {
        $user = User::where('remember_token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'This activation token is either invalid or the account has already been activated.'], 401);
        }
        $user->active = true;
        $user->email_verified_at = Carbon::now();
        $user->remember_token = '';
        $user->save();

        return response()->json(['message' => 'Confirmation Success. Now you can login.'], 200);
    }

    //subscription
    public function subscribe(Request $request)
    {
        if (!Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribe($request->email);
            return 'success';
        }
        return 'failure';
    }

    //password reset
    public function create(Request $request)
    {

        $request->validate([
            'email' => 'required|string|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response('Invalid Email', 401);
        }

        $passwordReset = PasswordReset::updateOrCreate(

            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60),
                'created_at' => Carbon::now()
            ]
        );

        if ($user && $passwordReset) {
            $user->notify(
                new PasswordResetRequest($user, $passwordReset->token)
            );
        }
        return response('Success', 200);

    }

    public function reset(Request $request)
    {

        $request->validate([
            'password' => 'required|string|confirmed',
            'token' => 'required|string'
        ]);

        $passwordReset = PasswordReset::where('token', '=' , $request->token)->first();

        if (!$passwordReset) {
            return response('Invalid token', 401);
        }

        $user = User::where('email', '=', $passwordReset->email)->first();

        if (!$user) {
            return response('Invalid token', 401);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        PasswordReset::where('email', '=', $passwordReset->email)->delete();

        $user->notify(new PasswordResetSuccess($user));

        return response('Success', 200);
    }

    //sociallite
    public function SocialSignUp($provider)
    {
        // Socialite will pick response data automatic
        $user = Socialite::driver($provider)->stateless()->user();

        $existingUser = User::where('email', $user->email)->first();

        if($existingUser){
            $access_token = $this->socialLogin($user, $provider);
        } else{
            User::create([
                'name' => $user->name,
                'email' => $user->email,
                'active' => true
            ]);
            $access_token = $this->socialLogin($user, $provider);
        }

        $newUser = User::where('email', $user->email)->first();

        // Format the final response in a desirable format
        return response()->json([
            'token' => $access_token,
            'user' => $newUser,
            'status' => 200
        ]);
    }

    public function socialLogin($user, $provider){
        // Send an internal API request to get an access token
        $client = DB::table('oauth_clients')
            ->where('password_client', true)
            ->first();

        // Make sure a Password Client exists in the DB
        if (!$client) {
            return response()->json([
                'message' => 'Laravel Passport is not setup properly.',
                'status' => 500
            ], 500);
        }

        $data = [
            'grant_type' => 'social',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'provider' => $provider,
            'access_token' => $user->token
        ];

        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);

        // Check if the request was successful
        if ($response->getStatusCode() != 200) {
            return response()->json([
                'message' => 'Something went wrong. Please, try again',
                'status' => 422
            ], 422);
        }

        // Get the data from the response
        $data = json_decode($response->getContent());

        return $data->access_token;
    }

}
