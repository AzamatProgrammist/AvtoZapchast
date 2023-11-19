<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Shop;
use Spatie\Permission\Models\Role;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create admin', ['only' => ['create', 'store']]);
        $this->middleware('permission:create admin', ['only' => ['edit', 'update']]);
        $this->middleware('permission:create admin', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $request->validated();
        if (in_array(1, $request->roles)) {
            $usertype = 1;
        }elseif (in_array(2, $request->roles)) {
            $usertype = 2;
        }else{
            $usertype = 0;
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'usertype' => $usertype,
            'password' => bcrypt($request->password),
        ]);
        $user->assignRole($request->roles);
        return redirect()->route('admin.users.index')->with('success', 'User created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $userRoles = $user->roles()->pluck('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $request->validated([
            'email' => 'required|email|unique:users,email'.$user->id,
        ]);
        if (in_array(1, $request->roles)) {
            $usertype = 1;
        }elseif (in_array(2, $request->roles)) {
            $usertype = 2;
        }else{
            $usertype = 0;
        }
        $user->name = $request->name;
        $user->usertype = $usertype;
        $user->phone = $request->phone;
        $user->email = $request->email;
        if (isset($request->password)) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shops = Shop::where('user_id', $id)->count();
        $user = User::findOrFail($id);
        if ($shops > 0) {
            
            return redirect()->route('admin.users.index')->with('success', "foydalanuvchini bazada magazini mavjud");
        }else{
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', "foydalanuvchi bazadan o'chirildi");
        }
    }
}
