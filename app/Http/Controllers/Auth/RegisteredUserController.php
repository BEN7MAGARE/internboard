<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function __construct(){
        $this->college = new College();
    }

    /**
     * Show emplyer creation form
     */

    public function employer() : View {
        $role = "corporate";
        return view('auth.employer', compact('role'));
    }

    public function getstarted() {

        if (auth()->user()) {
            if (auth()->user()->role === "corporate") {
                return redirect()->route('jobs.create');
            }else {
                return redirect()->route('jobs.index');
            }
        } else {
            return view('auth.register');
        }

    }

    /**
     * Show institution creation form
     */

    public function institution() : View {
        $role = "college";
        return view('auth.institution', compact('role'));
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $role = 'student';
        $colleges = $this->college->get();
        return view('auth.student', compact('role', 'colleges'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'college_id' => ['required','exists:colleges,id'],
            'first_name' => ['required', 'string', 'max:60'],
            'last_name' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:'.User::class],
            'phone' => ['required','string','max:60', 'unique:'.User::class],
            'role' => ['nullable','string',''],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'college_id' => $validated["college_id"],
            'first_name' => $validated["first_name"],
            'last_name' => $validated["last_name"],
            'email' => $validated["email"],
            'phone' => $validated["phone"],
            'role' => $validated["role"],
            'password' => Hash::make($validated["password"]),
        ]);

        Auth::login($user);

        return json_encode(['status'=>'success', 'message'=>'Account created succcessfully and email verification has been sent to your email. Please click on the email to verify your account. ', 'url'=> '/jobs']);
    }

    public function corporateCreate(Request $request) {
        DB::beginTransaction();
        $corporate = Corporate::create($request->company);
        $user = User::create([
            'corporate_id' => $corporate->id,
            'first_name' => $request->user["first_name"],
            'last_name' => $request->user["last_name"],
            'email' => $request->user["email"],
            'phone' => $request->user["phone"],
            'role' => 'corporate',
            'password' => Hash::make($request->user["password"]),
        ]);
        DB::commit();

        Auth::login($user);

        return json_encode(['status'=>"success", 'message'=>'Corporate account created successfully. Check your email and verify before you proceed.', 'url'=>'/jobs/create']);
    }

    public function institutioncreate(Request $request) {
        DB::beginTransaction();
        $college = College::create($request->company);
        $user = User::create([
            'college_id' => $college->id,
            'first_name' => $request->user["first_name"],
            'last_name' => $request->user["last_name"],
            'email' => $request->user["email"],
            'phone' => $request->user["phone"],
            'role' => $request->user["role"],
            'password' => Hash::make($request->user["password"]),
        ]);
        DB::commit();

        Auth::login($user);

        return json_encode(['status'=>"success", 'message'=>'Institution account created successfully. Check your email and verify before you proceed.', 'url'=>'/jobs']);
    }

}
