<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Reports;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admin_home');
    }
    
    public function listReport(){
        //Menampilkan semua isi tabel reports kedalam variabel
        $report = Reports::join('users', 'reports.user_id', '=', 'users.id')
            ->select('reports.*', 'users.name')
            ->where('admin', '=', 0)
            ->get();

        //tampilkan view
        return view('admin.list_reports', compact('report'));
    }

    public function listUsers(){
        //Menampilkan semua isi tabel reports kedalam variabel
        $user = User::where('admin', '=', 0)->get();

        //tampilkan view
        return view('admin.list_users', compact('user'));
    }
    
    public function deleteUser($id)
    {
        User::where('id', '=', $id)->delete();
        Session::flash('message', 'Successfully deleted user!');
        return Redirect::back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_user');
    }

    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'admin' => 'required|not_in:-- Choose --'
        ]);

        if($validator->fails()){
            return redirect('home/create-user')
                ->withErrors($validator)
                ->withInput();
        }else {
            $name = Input::get('name');
            $email = Input::get('email');
            $password = Hash::make(Input::get('password'));
            $admin = Input::get('admin');
            # Isi kedalam database
            User::create(compact('name', 'email', 'password', 'admin'));
            Session::flash('message', 'Successfully created user!');
            return Redirect::to('home/users');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
