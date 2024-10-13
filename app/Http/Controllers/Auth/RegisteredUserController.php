<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\User;
use App\Services\CenterAppointmentService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    protected $center_service;
    public function __construct(CenterAppointmentService $center_service){
        $this->center_service=$center_service;
    }
    /**
     * Display the registration view.
     */
    public function create(): View{
        $centers=Center::all();
        return view('auth.register',compact('centers'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse{
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'vaccine_center'=>['required','string'],
            'nid'=>['required','string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'vaccine_center'=>$request->vaccine_center,
            'nid'=>$request->nid,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $this->center_service->appoint();
        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
