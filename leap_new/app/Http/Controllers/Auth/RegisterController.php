<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Department;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/
	
	use RegistersUsers;
	
	/**
	 * Where to redirect users after login / registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/list/users';
	protected $registerView = 'auth.register';
	
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
	
	protected function getRegister() {
		$requiredData = $this->formRequiredData();
		$departments = $requiredData['departments'];
		$roles = $requiredData['roles'];
		$managers = $requiredData['managers'];
	   return view('auth.register', ['departments' => $departments, 'roles' => $roles, 'managers' => $managers]);
	}

	public static function formRequiredData() {
		$departments = Department::orderBy('id')->pluck('name','id');
		$roles = Role::orderBy('id')->pluck('name','id');
		$managers = User::select(
            DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')
            ->where('role_id', '>=', 3)
            ->orderBy('id')
	   		->pluck('name', 'id');
		$requiredData = ['departments' => $departments, 'roles' => $roles, 'managers' => $managers];
		return $requiredData;
	}
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'middle_name' => 'max:255',
			'last_name' => 'required|max:255',
			'manager' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'department' => 'required',
			'role' => 'required',
			'joining_date' => 'required',
			'employee_code' => 'required',
			'designation' =>  'max:255'
		]);
	}
	
	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data)
	{
		return User::create([
			'first_name' => $data['name'],
			'middle_name' => $data['middle_name'],
			'last_name' => $data['last_name'],
			'email' => $data['email'],
			'password' => bcrypt('123456'),
			'manager_id' => $data['manager'],
			'department_id' => $data['department'],
			'role_id' => $data['role'],
			'status' => $data['status'],
			'joining_date' => $data['joining_date'],
			'employee_code' => $data['employee_code'],
			'designation' => $data['designation'],
		]);
	}

	public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

}
