<?php

namespace App\Http\Controllers;

use App\Reports;
use App\User;
use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Validator;
use Illuminate\Database\Query\Builder;
use Session;
use Auth;
use DB;
use Yajra\Datatables\Datatables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        //Menampilkan semua isi tabel reports berdasarkan id user yang sedang login kedalam variabel
        $report = Reports::where('user_id', '=', $id)
            ->get();

        //tampilkan view
        return view('users.user_home', compact('report'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('users.create', compact('category'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'report_date' => 'required',
            'category_id' => 'required|not_in:-- Choose --',
            'subject' => 'required | min:3',
            'description' => 'required | min:10'
        ]);

        if($validator->fails()){
            return redirect('home/create')
                ->withInput()
                ->withErrors($validator);
        }else {
            $user_id = Auth::id();
            $report_date = Input::get('report_date');
            $category_id = Input::get('category_id');
            $subject = Input::get('subject');
            $description = Input::get('description');
            # Isi kedalam database
            Reports::create(compact('user_id', 'report_date', 'category_id', 'subject', 'description'));
            Session::flash('message', 'Successfully created report!');
            return Redirect::to('/home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        # Mengambil data dalam berdasarkan berdasarkan id
        $report = Reports::find($id);
        
        # Menampilkan view
        return View('users.preview', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Reports::find($id);
        /*$reports = Reports::join('category', 'reports.category_id', '=', 'category.id')
            ->select('reports.*', 'category.category_name')
            ->where('reports.id', '=', $id)
            ->get();*/
        $category = Category::all();
        return view('users.update', compact('report', 'category'));
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
        $update = Reports::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'report_date' => 'required',
            'category_id' => 'required|not_in:-- Choose --',
            'subject' => 'required | min:3',
            'description' => 'required | min:10'
        ]);

        if($validator->fails()){
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }else {
            $input = $request->all();
            $update->fill($input)->save();
            Session::flash('message', 'Successfully updated report!');
            return Redirect::to('/home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        # Menghapus biodata berdasarkan id
        Reports::find($id)->delete();
        Session::flash('message', 'Successfully deleted report!');
        return Redirect::back();
    }

    public function password()
    {
        return View('change_password');
    }

    public function change(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'retype_password' => 'required|same:new_password'
        ]);

        if($validator->fails()){
            return redirect('home/password')
                ->withInput()
                ->withErrors($validator);
        }else{
            $user = Auth::id();
            $db_oldpass = User::find($user)->password;
            $old_pass = Input::get('old_password');
            $new_pass = Hash::make(Input::get('new_password'));

            if(Hash::check($old_pass, $db_oldpass)){
                //save new password
                /*$user->password = Hash::make(Request::input('new_password'));
                $user->save();*/
                DB::table('users')->where('id', '=', $user)->update(['password' => $new_pass]);
                    Session::flash('success', 'Your password has been changed.');
                    return Redirect::to('home/password');

            }else{
                Session::flash('failed', 'Your old password is incorrect.');
                return Redirect::to('home/password');
            }

        }
    }

    public function addCategory(Request $request)
    {
        $category_name = Input::get('category_name');

        # Isi kedalam database
        Category::create(compact('category_name'));
        Session::flash('message', 'Successfully added category!');
        return Redirect::to('/home');

    }
}
