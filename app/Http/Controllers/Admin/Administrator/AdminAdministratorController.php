<?php

namespace App\Http\Controllers\Admin\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Administrator\AdministratorCreateRequest;
use App\Http\Requests\Admin\Administrator\AdministratorEditRequest;
use App\Models\AreaPostCode;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class AdminAdministratorController extends Controller
{
    private $adminRepository;

    private $roleRepository;

    private $message;
    /**
     * AdminAdministratorController constructor.
     */
    public function __construct(AdminRepositoryInterface $adminRepository, RoleRepositoryInterface $roleRepository)
    {
        $this->adminRepository = $adminRepository;
        $this->roleRepository = $roleRepository;
        $this->message = $this->messages();
    }

    public function index(Request $request)
    {
        try {
            $page = [
                'title' => 'Administrator Listing',
                'bread_crumb' => ['parent' => 'Home', 'secondary_parent' => 'Administrator', 'root' => 'Administrator Listing'],
            ];
            $roles = $this->roleRepository->all();
            $administrators = $this->adminRepository->getUsersByRoles([2, 3, 4]);
            return view('backend.administrator.index', compact('page', 'administrators', 'roles'));
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Administrator Listing');
            return view('backend.error.500');
        }
    }

    public function getAdministrator(Request $request)
    {
        try {
            if ($request->ajax()) {
                $where = ['role_id' => 2];
                $data = $this->adminRepository->get($where);
                return FacadesDataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Get Admin');
            return view('backend.error.500');
        }
    }

    public function show(Request $request, $id)
    {
        try {
            $page = [
                'title' => 'Administrator Detail',
                'bread_crumb' => ['parent' => 'Home', 'secondary_parent' => 'Administrator', 'root' => 'Administrator Detail'],
            ];

            $whereClause = [];
            $withClause = ['getUserLoginHistory'];
            $user = $this->adminRepository->getUsersById($id, $whereClause, $withClause);
            return view('backend.administrator.view', compact('page', 'user'));
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Admin Detail');
            return view('backend.error.500');
        }
    }

    public function create()
    {
        try {
            $data = [];
            $adminRoles = $this->roleRepository->getRoles([2, 3, 4]);
            $countries = Country::all();
            $states = State::all();
            $page = [
                'title' => 'Administrator Create Form',
                'bread_crumb' => ['parent' => 'Home', 'secondary_parent' => 'Administrator', 'root' => 'Administrator Create Form'],
            ];
            return view('backend.administrator.create', compact('data', 'page', 'adminRoles', 'countries', 'states'));
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Create Admin Form');
            return view('backend.error.500');
        }
    }

    public function store(AdministratorCreateRequest $request)
    {
        try {
            $data = $request->all();
            $user = $this->adminRepository->store($data);
            if ($user) {
                Toastr::success($this->message['created_success'], 'Success', ["positionClass" => $this->message['positionClass']]);
                return redirect()->route('admin.administrator');
            }

            Toastr::success($this->message['created_error'], 'Success', ["positionClass" => $this->message['positionClass']]);
            return back();
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Store Admin');
            return view('backend.error.500');
        }
    }

    public function edit($id)
    {
        try {
            $page = [
                'title' => 'Administrator Edit Form',
                'bread_crumb' => ['parent' => 'Home', 'secondary_parent' => 'Administrator', 'root' => 'Administrator Edit Form'],
            ];
            $data = $this->adminRepository->find($id);
            $adminRoles = $this->roleRepository->getRoles([2, 3, 4]);
            $countries = Country::all();
            $states = State::all();
            return view('backend.administrator.edit', compact('data', 'page', 'countries', 'states', 'adminRoles'));
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Edit Admin form');
            return view('backend.error.500');
        }
    }

    public function update($id, AdministratorEditRequest $request)
    {
        try {
            $data = $request->all();
            $user = $this->adminRepository->update($data, $id);
            if ($user) {
                Toastr::success($this->message['updated_success'], 'Success', ["positionClass" => $this->message['positionClass']]);
                return redirect()->route('admin.administrator');
            }
            Toastr::error($this->message['updated_error'], 'Error', ["positionClass" => $this->message['positionClass']]);
            return back();
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Update  Admin');
            return view('backend.error.500');
        }
    }

    public function delete(Request $request)
    {
        try {
            $data = $this->adminRepository->destroy($request->id);
            if ($data) {
                return response(['success' => true], 200);
            } else {
                return response(['error' => false], 200);
            }
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Delete Admin');
            return view('backend.error.500');
        }
    }

    public function getCountries(Request $request)
    {
        try {
            $data = Country::where('status', 1)->get();
            return response()->json(
                [
                    'statusCode' => 200,
                    'response' => [
                        'data' => $data,
                    ],
                    'message' => "Success",
                    'status' => true,
                ]
            );
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Get Countries');
            return view('backend.error.500');
        }
    }

    public function getStatesByCountry(Request $request)
    {
        try {
            $data = State::where('country_id', $request->country_id)->get();
            return response()->json(
                [
                    'statusCode' => 200,
                    'response' => [
                        'data' => $data,
                    ],
                    'message' => "Success",
                    'status' => true,
                ]
            );
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Get States');
            return view('backend.error.500');
        }
    }


    public function getCitiesByCountry(Request $request)
    {
        try {
            $data = City::where('country_id', $request->country_id)->get();
            return response()->json(
                [
                    'statusCode' => 200,
                    'response' => [
                        'data' => $data,
                    ],
                    'message' => "Success",
                    'status' => true,
                ]
            );
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Get Cities');
            return view('backend.error.500');
        }
    }
    public function getCitiesByState(Request $request)
    {
        try {
            $data = City::where('state_id', $request->state_id)->get();
            return response()->json(
                [
                    'statusCode' => 200,
                    'response' => [
                        'data' => $data,
                    ],
                    'message' => "Success",
                    'status' => true,
                ]
            );
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Get Cities');
            return view('backend.error.500');
        }
    }
    public function geAreaPostCodes(Request $request)
    {
        try {
            $data = AreaPostCode::where('city_id', $request->city_id)->get();
            return response()->json(
                [
                    'statusCode' => 200,
                    'response' => [
                        'data' => $data,
                    ],
                    'message' => "Success",
                    'status' => true,
                ]
            );
        } catch (Exception $exception) {
            activity()->withProperties($exception)->log('Get States');
            return view('backend.error.500');
        }
    }

    private function messages()
    {
        return array(
            "created_success" => "Created Successfully",
            "updated_success" => "Updated Successfully",
            "created_error" => "Created Failure",
            "updated_error" => "Updated Failure",
            "positionClass" => "toast-top-right",
        );
    }
}
