<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersEditRequest;
use App\Http\Requests\UsersRequest;
use App\Models\Photo;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth'); //beveiliging
    }
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(20);

       // $users = User::all();   //->orderBy('name'); //eloquent schrijven 'proper'(eloquent)MODEL
      // $users = DB::table('users')->get(); //rechtstreekse SQL: database docs(querybuilder)VIA DB FACADE ARRAYNIVEAU
        //$users =User::where('is_active', 1);
        //dd($users);
        //return view('admin.users.index', ['users'=>$users]); 2 schrijfwijzen
        return view('admin.users.index', compact('users')); //compact draagt assoc array over
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::pluck('name', 'id')->all();  //in form alle rollen laten weergeven
        return view( 'admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //verbonden met create (create = weergave, store = wegschrijven
       /* User::create([
            'name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password']),
            'role_id'=>$request['roles[]'],
            'is_active'=>$request['is_active']
        ]);*/
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request['password']);
        $user->is_active = $request->is_active;
        /**code opslaan foto**/
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName() ;//ophalen bestandsnaam en datum toevoegen
            $file->move('img', $name); //lokaal opslaan in map images
            //verbinden DB :
            $photo = Photo::create(['file'=>$name]); //schrijft weg naar tabel en slaat op in $photo
            $user->photo_id =$photo->id; //halen id uit $photo en steken die in veld phot_id van users tabel
        }
        $user->save();

        $user->roles()->sync($request->roles,false);


        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::findOrFail($id);// enkel find nie genoeg hier ook errorhandling 404page

        $roles = Role::pluck('name', 'id')->all(); //eerst veldnamen dan pas id
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //request = alle velden die gepathced moeten worden, id meegegven in edit page zelf in array
        $user = User::findOrFail($id);
        if(trim($request->password)==''){
            $input= $request->except('password');
        }else{
            $input = $request->all;
            $input['password'] = Hash::make($request['password']);
        }
        /**code overschrijven  foto**/
        if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName() ;//ophalen bestandsnaam en datum toevoegen
            $file->move('img', $name); //lokaal opslaan in map images
            //verbinden DB :
            $photo = Photo::create(['file'=>$name]); //schrijft weg naar tabel en slaat op in $photo

            $user->photo_id = $input['photo_id'] = $photo->id ; //id ophalen

        }
            $user->update($input);
        /**wegschrijven tsstabel met nieuwe rollen **/
        $user->roles()->sync($request->roles, true);
        return redirect('admin/users');
        // return redirect->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //user id meegeven in form
        User::findOrFail($id)->delete(); //HARD DELETE: nooit doen
        return redirect('/admin/users');
    }
}
