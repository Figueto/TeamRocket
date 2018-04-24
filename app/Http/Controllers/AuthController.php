<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Utilisateur;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;


class AuthController extends Controller
{
   /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Create a new token.
     * 
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt(Utilisateur $user) {
        $exp_time = 60*60*48; //48h
        $payload = [
            'iss' => "lumen-jwt",
            'sub' => $user->idUtilisateur, // Subject
            'iat' => time(), // Time created 
            'exp' => time() + $exp_time // Expiration
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    } 

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     * 
     * @param  \App\User   $user 
     * @return mixed
     */
    public function authenticate(Utilisateur $user) {
        $this->validate($this->request, [
            'pseudo'     => 'required',
            'pass'  => 'required'
        ]);

        // Find the user by email
        $user = Utilisateur::where('pseudo', $this->request->input('pseudo'))
        ->where('actif', '=', '1')
        ->first();

        if (!$user) {
            return response()->json([
                'error' => 'This user does not exist or was disabled by an admin.'
            ], 400);
        }

        // Verify the password and generate the token
        if (Hash::check($this->request->input('pass'), $user->pass)) {
            return response()->json([
                'token' => $this->jwt($user),
                'user' => $user
            ], 200);
        }

        // Bad Request response
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);
    }
}
