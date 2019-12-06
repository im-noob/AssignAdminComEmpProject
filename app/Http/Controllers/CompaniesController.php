<?php

namespace App\Http\Controllers;

use App\Companies;
use App\User;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        return view('admin.companyList',['data'=>Companies::paginate(10)]);
    }

    public function indexAll(){
        return view('admin.home',['comanyList'=>Companies::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Checking Validation 
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password'=>'required',
            'website' => 'nullable',
            'logo' => 'nullable',
        ]);
        
        $compID = Companies::create($request->only('name','email','website','logo'))->id;
        User::create([
            'id' => $compID,
            'name' => $request->name,
            'email' => $request->email,
            'password'=> bcrypt($request->password)
        ]);
        
        return response()->json([
            'received'=>true,
            'message'=>"Created Successfully",
            'data'=>[
                "name" => $request->name,
                "email" => $request->email,
                "website" => $request->website,
                "logo" => $request->logo,
                "password"=>$request->password,
            ],
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(Companies $companies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $companies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companies $companies,$id)
    {

        //Checking Validation 
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password'=>'required',
            'website' => 'nullable',
            'logo' => 'nullable',
        ]);
        
        $companies::find($id)->update($request->only('name','email','website','logo'));
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password'=> bcrypt($request->password)
        ]);
        
        return response()->json([
            'received'=>true,
            'message'=>"Updated Successfully",
            'data'=>[
                "name" => $request->name,
                "email" => $request->email,
                "website" => $request->website,
                "logo" => $request->logo,
                "password"=>$request->password,
            ],
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $companies,$id)
    {
        $companies = $companies::find($id);
        $companies->delete();
        return redirect()->route('companies.index')->with("Successfully Deleted");
    }
}
