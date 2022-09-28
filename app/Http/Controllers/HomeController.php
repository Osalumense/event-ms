<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Events;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function adminIndex()
    {
        $total_users = User::getUserCount();
        $recently_added_users = User::getRecentlyAdded();
        return view('admin.index')->with([
            'total_users'=> $total_users,
            'recently_added_users' => $recently_added_users
        ]);
    }

    public function renderCounsellorsPage()
    {
        return view('admin.users.users');
    }

    public function renderVehiclesViewPage()
    {
        return view('admin.vehicles.index');
    }

    public function displayCounsellors()
    {
        $data = User::where('type', '=', (string)\UserType::ADMIN)
        ->orderBy('id', 'DESC');
        return Datatables::of($data)
        ->editColumn('is_active', function ($user) {
            return \ActiveStatus::getValueInHtml($user->is_active);
        })
        ->addColumn('name', function($user){
            return $user->last_name.' '.$user->first_name;
        })
        ->addColumn('action', function ($user) {
            return view('admin.partials.admin_users_action')->with([
                'user' => $user,
            ]);
        })
        ->editColumn('created_at', function ($user) {
            return $user->created_at->format('d/m/Y');
        })
        ->rawColumns(['action', 'is_active'])
        ->make(true);
    }

    // public function renderUsersPage()
    // {
    //     return view('admin.users');
    // }

    // public function displayUsers()
    // {
    //     $data = User::where('type', '=', (string)\UserType::USER)
    //     ->orderBy('id', 'DESC');
    //     return Datatables::of($data)
    //     ->editColumn('is_active', function ($user) {
    //         return \ActiveStatus::getValueInHtml($user->is_active);
    //     })
    //     ->addColumn('name', function($user){
    //         return $user->last_name.' '.$user->first_name;
    //     })
    //     ->addColumn('action', function ($user) {
    //         return view('admin.partials.admin_user_action')->with([
    //             'user' => $user,
    //         ]);
    //     })
    //     // ->editColumn('created_at', function ($user) {
    //     //     return $user->created_at->format('d/m/Y');
    //     // })
    //     ->rawColumns(['action', 'is_active'])
    //     ->make(true);
    // }

    /**
     * Delete Counsellor.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function deleteCounsellor($id)
    {
        $user = $id;
        // $user = User::findOrFail($decodedId);
        if ($user->type == \UserType::COUNSELLOR) {
            $user->delete();
            \session()->flash('success', 'User deleted');

            return redirect(url('/admin/users'));
        }
        return redirect()->back();
    }

    /**
     * Render users update view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    */
    public function editUsers(Request $request)
    {
        $id = $request->segment(4);
        $user = User::FindOrFail($id);
        return view('admin.users.user-edit')->with(['user' => $user]);
    }

    public function updateCounsellors(Request $request)
    {
        $postData = request()->all();
        $user = Auth::user();
        if ($user instanceof User && $user->type == \UserType::SUPER_ADMIN) {
            $validators = Validator::make($request->input(), [
                'first_name' => 'required|string|max:30',
                'last_name' => 'required|string|max:30',
                'mobile_number' => 'bail|numeric|digits_between:11,12',
                'gender' => 'required|numeric',
                'is_active' => 'required|numeric',
                'user_type' => 'required|numeric'
            ]);
            if ($validators->fails()) {
                return redirect()->back()->withErrors($validators)->withInput();
            }
             /** @var User $getUser */
             $getUser = User::get($postData['id']);
             $getUser->first_name = $postData['first_name'];
             $getUser->last_name = $postData['last_name'];
             $getUser->mobile_number = $postData['mobile_number'];
             $getUser->gender = $postData['gender'];
             $getUser->type = $postData['user_type'];
             $getUser->is_active = $postData['is_active'];
             $getUser->save();
     
             return redirect('/admin')->with('success', 'User updated successfully');  
        } else {
            \session()->flash('error', 'User not authenticated');
            return redirect()->back();
        }
        
    }

    public function renderNewUserPage()
    {
        return view('admin.users.new-user');
    }

    public function createNewUser(Request $request)
    {
        $postData = request()->all();
        $user = Auth::user();
        if ($user instanceof User && $user->type == \UserType::SUPER_ADMIN) {
            $validators = Validator::make($request->input(), [
                'first_name' => 'required|string|max:30',
                'last_name' => 'required|string|max:30',
                'mobile_number' => 'bail|numeric|digits_between:11,12',
                'gender' => 'required|numeric',
                'is_active' => 'required|numeric',
                'user_type' => 'required|numeric'
            ]);
            if ($validators->fails()) {
                return redirect()->back()->withErrors($validators)->withInput();
            }
             /** @var User $getUser */
             $newUser = new User;
             $newUser->first_name = $postData['first_name'];
             $newUser->last_name = $postData['last_name'];
             $newUser->mobile_number = $postData['mobile_number'];
             $newUser->staff_id = $postData['staff_id'];
             $newUser->gender = $postData['gender'];
             $newUser->type = $postData['user_type'];
             $newUser->is_active = $postData['is_active'];
             $newUser->save();
     
             return redirect('/admin')->with('success', 'User created successfully');  
        } else {
            \session()->flash('error', 'User not authenticated');
            return redirect()->back();
        }

    }

    public function getAllEvents()
    {
        return Events::getEventCount();
    }

    
}
