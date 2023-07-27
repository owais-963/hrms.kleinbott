<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Toastr;
use Carbon\Carbon;
use BrowserDetect;
use Location;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Interfaces\UserLoginHistoryRepositoryInterface;
use App\Repositories\Interfaces\UserLoginDetailActivityRepositoryInterface;
use Exception;

class AdminLoginController extends Controller
{
    private $adminRepository;

    private $adminUserLoginHistoryRepository;

    private $adminLoginDetailActivityRepository;

    private $message;

    protected $guard = 'admins';


    public function __construct(
        AdminRepositoryInterface $adminRepository,
        UserLoginHistoryRepositoryInterface $adminUserLoginHistoryRepository,
        UserLoginDetailActivityRepositoryInterface $adminLoginDetailActivityRepository
    ) {

        $this->adminRepository = $adminRepository;
        $this->adminLoginDetailActivityRepository = $adminLoginDetailActivityRepository;
        $this->adminUserLoginHistoryRepository = $adminUserLoginHistoryRepository;
        $this->message = $this->messages();
        //$this->middleware('guest:admin')->except('logout');
    }

    public function guard()
    {
        return Auth::guard($this->guard);
    }
    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function index()
    {
        return view('backend.auth.signin');
    }


    /**
     * Log the user in of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        try {
            if ($request->isMethod('post')) {
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->get('remember'))) {
                    $admin = Auth::guard('admin')->user();
                    $data = [
                        'last_login_at' => Carbon::now(),
                        'last_login_ip' => $request->getClientIp()
                    ];
                    $this->adminRepository->updateUserLoginHistory($data, Auth::guard('admin')->user()->id);
                    $location = Location::get($request->ip);
                    if ($location != false) {
                        $userLoginHistoryData = [
                            'user_id' => Auth::guard('admin')->user()->id,
                            'role_id' => '1',
                            'country' => $location->countryName,
                            'country_code' => $location->countryCode,
                            'city' => $location->cityName,
                            'region_name' => $location->regionName,
                            'browser' => BrowserDetect::browserFamily() . '-' . BrowserDetect::platformName(),
                            'last_login_ip' => $request->getClientIp(),
                            'last_login_at' => Carbon::now(),
                            'status' => 1
                        ];
                        $this->adminUserLoginHistoryRepository->store($userLoginHistoryData);
                    }

                    $userLoginDetailActivityData = [
                        'user_id' => Auth::guard('admin')->user()->id,
                        'role_id' => '1',
                        'login_details_id' => md5(uniqid() . mt_rand()),
                        'last_activity' => Carbon::now()
                    ];
                    $this->adminRepository->updateLoginHistory($data, Auth::guard('admin')->user()->id);
                    $this->adminLoginDetailActivityRepository->store($userLoginDetailActivityData);

                    if ($admin->role_id == 1) {
                        Toastr::success($this->message['administrator_login'], 'Success', ["positionClass" => $this->message['positionClass']]);
                        return redirect()->route('page.admin');
                    } else {
                        Auth::guard('admin')->logout();
                        $request->session()->invalidate();
                        $request->session()->regenerateToken();

                        Toastr::error($this->message['administrator_login_failure'], 'Error', ["positionClass" => $this->message['positionClass']]);
                        return redirect()->route('auth.admin.login.form');
                    }
                }
                return back()->withErrors(['error' => $this->message['administrator_login_invalid'], 'emailid' => $request->email]);
            } else {
                return redirect()->route('auth.login.showform');
            }
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('update  Admin');
            return view('backend.error.500');
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            if ($this->adminUserLoginHistoryRepository->checkByUserIDExists(Auth::guard('admin')->user()->id) == true) {
                $data = [
                    'status' => 0,
                    'logout_at' => Carbon::now()
                ];
                $this->adminUserLoginHistoryRepository->update($data, Auth::guard('admin')->user()->id);
            }
            if ($this->adminLoginDetailActivityRepository->checkByUserIDExists(Auth::guard('admin')->user()->id) == true) {
                $this->adminLoginDetailActivityRepository->destroyByUserId(Auth::guard('admin')->user()->id);
            }
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('auth.admin.login.showform');
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('update  Admin');
            return view('backend.error.500');
        }
    }

    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function change_password()
    {
        return view('backend.auth.change-password');
    }
    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function changePasswordProcess(Request $request)
    {
        try {

            if ($request->isMethod('post')) {
                $validation = Validator::make($request->all(), [
                    'current_password' => 'required',
                    'password' => 'required|min:8',
                    'confirm-password' => 'required_with:password|same:password|min:8'
                ]);

                if ($validation->fails()) {
                    Toastr::error('Credential are Invalid', 'Error', ["positionClass" => "toast-top-right"]);
                    return back()->withErrors($validation)->withInput();
                }
                $getUser = User::where('id', auth()->user()->id)->first();
                if (Hash::check($request->current_password, $getUser->password)) {
                    $admin = User::where('id', auth()->user()->id)->update([
                        'password' => Hash::make($request->password)
                    ]);

                    if ($admin) {
                        if (isset($request->logout_after) && $request->logout_after == 1) {
                            Auth::logout();
                            $request->session()->invalidate();
                            $request->session()->regenerateToken();
                            Toastr::success('Successfully! Password Changed', 'Success', ["positionClass" => "toast-top-right"]);
                            return redirect()->route('auth.admin.login.form');
                        } else {
                            Toastr::success('Successfully! Password Changed', 'Success', ["positionClass" => "toast-top-right"]);
                            return redirect()->route('page.admin');
                        }
                    } else {
                        Toastr::error('Password Invalid! Failed change password', 'Error', ["positionClass" => "toast-top-right"]);
                        return redirect()->route('admin.auth.change-password');
                    }
                }
                return back()->withErrors(['error' => "Invalid Password"]);
            } else {
                return redirect()->route('admin.auth.change-password');
            }
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('update  Admin');
            return view('backend.error.500');
        }
    }

    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function forgot()
    {
        return view('backend.auth.reset-password');
    }


    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function reset()
    {
        return view('backend.auth.new-password');
    }

    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function two_factor_auth()
    {
        return view('backend.auth.two-step');
    }

    /**
     * Auth Routes
     * Login, Register & Others
     */
    public function register()
    {
        return view('backend.auth.sign-up');
    }

    public function profile()
    {
        return view('backend.profile.index');
    }


    private function messages()
    {
        return array(
            "administrator_login" => "Administrator Login Successfully",
            "administrator_login_failure" => "Login Failure! Have no permission for admin",
            "administrator_login_invalid" => "Invalid Credential",
            "positionClass" => "toast-top-right"
        );
    }
}