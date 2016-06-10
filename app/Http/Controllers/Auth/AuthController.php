<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $username = 'username';    
    
    
    public function __construct()
    {
        $this->middleware('guest',['except' => ['logout', 'getLogout']]);
    }

    protected function validator(array $data)
    {
    }

    protected function create(array $data)
    {
    }
}
