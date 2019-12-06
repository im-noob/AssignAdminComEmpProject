<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Mail\SendMailToAdmin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        if(Auth::user()->isAdmin()){
            return view('admin.home',['companyList'=>Companies::all()]);
        }else{
            return view('company.home',['companyList'=>Companies::where('id',Auth::id())->get()]);
        }
        
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
            'email' => 'required|email|unique:users,email',
            'password'=>'required',
            'website' => 'nullable',
            'logo' => 'nullable',
        ]);
        
        // processing logo
        $path = "";
        if($request->hasFile('logo')) {
            $file = $request->file('logo');
            $ImageSize = getimagesize($file);
            $width = $ImageSize[0];
            $height = $ImageSize[1];
            if ($width < 100 || $height < 100) {
                return response()->json([
                    'errors'=>[
                        'logo' => ['Image is dimension is less than 100 X 100.']
                    ],
                ],442);
            }
            $path = $file->store('public/');
            $pathBaseFile = basename($path);
            // $fileExtension = $file->getClientOriginalExtension();
            $onlyFullFileName = $pathBaseFile;
        }
        
        $request->logo = $onlyFullFileName;

        $compID = Companies::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'website'=>$request->website,
                'logo' => $onlyFullFileName,
            ])->id;

        User::create([
            'id' => $compID,
            'name' => $request->name,
            'email' => $request->email,
            'password'=> bcrypt($request->password),
            'path' => $path,
        ]);

        
        // Sending Mail to Admin
        Mail::to($request->user())->send(new SendMailToAdmin(User::findOrFail($compID)));

        
        return response()->json([
            'received'=>true,
            'message'=>"Created Successfully",
            'data'=>[
                "name" => $request->name,
                "email" => $request->email,
                "website" => $request->website,
                "logo" => $request->logo,
                "password"=>$request->password,
                "onlyFullFileName" => $onlyFullFileName,
                "logoRequest" => $request->logo,
                "ImageSize" => $ImageSize,
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
            'email' => 'required|email|unique:users,email',
            'password'=>'required',
            'website' => 'nullable',
        ]);
        
        
        $companies::find($id)->update($request->only('name','email','website'));
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
        return redirect()->route('companies.index')->with('status','Deleted Successfully');
    }
}
