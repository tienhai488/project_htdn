<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    protected $failLoginResponse = 'Thông tin xác thực này không khớp.';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $request->validate(
            [
                $this->username() => 'required|email',
                'password' => 'required',
            ],
            $this->getMessages(),
            $this->getAttributes(),
        );
    }

    public function getMessages()
    {
        return [
            'required' => 'Trường :attribute không được để trống.',
            'email' => 'Trường :attribute không hợp lệ.',
        ];
    }

    public function getAttributes()
    {
        return [
            'email' => 'email',
            'password' => 'mật khẩu',
        ];
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [$this->failLoginResponse],
        ]);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : to_route('login');
    }

    protected function attemptLogin(Request $request)
    {
        if (auth()->attempt($this->credentials($request), $request->boolean('remember'))) {
            if (auth()->user()->status == UserStatus::ACTIVATED) {
                return true;
            } else {
                $this->failLoginResponse = 'Tài khoản của bạn chưa được kích hoạt hoặc bị khóa.';
                $this->logout($request);
            }
        } else {
            $this->failLoginResponse = 'Thông tin xác thực không khớp.';
        }

        return false;
    }
}
