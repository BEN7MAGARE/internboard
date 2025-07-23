<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\College;
use App\Models\Corporate;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function __construct()
    {
        $this->college = new College();
    }

    public function getstarted()
    {
        if (auth()->user()) {
            if (auth()->user()->role === 'corporate') {
                return redirect()->route('jobs.create');
            } else {
                return redirect()->route('jobs.index');
            }
        } else {
            return view('auth.getstarted');
        }
    }

    /**
     * Display the registration view.
     */
    public function create($role)
    {
        return view('auth.register', compact('role'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'college_id' => ['nullable', 'exists:colleges,id'],
            'first_name' => ['required', 'string', 'max:60'],
            'last_name' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:' . User::class],
            'phone' => ['required', 'string', 'regex:/^(\+254|254|0)?7\d{8}$/', 'max:60', 'unique:' . User::class],
            'role' => ['nullable', 'string', ''],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            // 'college_id' => $validated["college_id"],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);
        $url = '';
        switch ($validated['role']) {
            case 'corporate':
                $url = '/employer/create';
                break;
            case 'college':
                $url = '/colleges/create';
                break;
            default:
                $url = '/profile';
                break;
        }
        return json_encode(['status' => 'success', 'message' => 'Account created succcessfully and email verification has been sent to your email. Please click on the email to verify your account. ', 'url' => $url]);
    }

}
