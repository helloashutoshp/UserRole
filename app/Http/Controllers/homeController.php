<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class homeController extends Controller
{
    public function index()
    {
        $users = User::select('users.*', 'role.name as roleName')->leftJoin('role', 'role.id', 'users.role_id')->paginate(10);
        $roles  = Role::paginate();
        $allActions = Action::pluck('name', 'id')->toArray();
        foreach ($roles as $role) {
            $actionIds = explode(',', $role->action);
            $role->action_names = collect($actionIds)
                ->map(fn($id) => $allActions[$id] ?? 'Unknown')
                ->implode(', ');
        }
        return view('admin.dashboard', ['users' => $users, 'role' => $roles]);
    }


    public function createUser()
    {
        $role = Role::get();
        return view('admin.user.create', ['role' => $role]);
    }

    public function userStore(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        if ($validator->passes()) {
            $user = new User();
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->role_id = $req->role;
            $user->save();
            session()->flash('success', 'Successfully user created');
            return response()->json([
                'status' => true,
                'message' => "user created",

            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function userEdit($id)
    {
        $decryptId = Crypt::decrypt($id);
        $role = Role::get();
        $user = User::find($decryptId);
        return view('admin.user.edit', ['user' => $user, 'role' => $role]);
    }

    public function userUpdate(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'email' => 'required|email',
        ]);
        if ($validator->passes()) {
            $user = User::find($req->user_id);
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->role_id = $req->role;
            $user->update();
            session()->flash('success', 'Successfully user updated');
            return response()->json([
                'status' => true,
                'message' => "user updated",

            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            session()->flash('error', 'user not found');
            return response()->json([
                'status' => false,
                'message' => 'user not found'
            ]);
        }
        $user->delete();
        session()->flash('success', 'User deleted');
        return response()->json([
            'status' => true,
            'message' => 'deleted'
        ]);
    }

    public function createRole()
    {
        $action = Action::get();
        return view('admin.role.create', ['action' => $action]);
    }

    public function roleStore(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'action' => 'required',
        ]);
        if ($validator->passes()) {
            $role = new Role();
            $role->name = $req->name;
            $role->action = implode(',', $req->action);
            $role->save();
            session()->flash('success', 'Successfully role created');
            return response()->json([
                'status' => true,
                'message' => "role created",

            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function roleDestroy($id)
    {
        $role = Role::find($id);
        if (!$role) {
            session()->flash('error', 'role not found');
            return response()->json([
                'status' => false,
                'message' => 'role not found'
            ]);
        }
        $role->delete();
        session()->flash('success', 'Role deleted');
        return response()->json([
            'status' => true,
            'message' => 'deleted'
        ]);
    }

    public function roleEdit($id)
    {
        $decryptId = Crypt::decrypt($id);
        $role = Role::find($decryptId);
        $actions = Action::all();
        return view('admin.role.edit', ['role' => $role, 'actions' => $actions]);
    }

    public function roleUpdate(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'action' => 'required',
        ]);
        $id = $req->role_id;
        if ($validator->passes()) {
            $role = Role::find($id);
            $role->name = $req->name;
            $role->action = implode(',', $req->action);
            $role->update();
            session()->flash('success', 'Successfully role updated');
            return response()->json([
                'status' => true,
                'message' => "role updated",

            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
