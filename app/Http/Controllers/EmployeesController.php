<?php

namespace App\Http\Controllers;

use App\Companies;
use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $companyList = [];

        if(Auth::user()->isAdmin()){
            $data = Employees::join('companies','companies.id','=','employees.company_id')
                            ->select('companies.name as companyName','employees.name as name','employees.email as email','phone','employees.id as id')
                            ->paginate(10);
            $companyList = Companies::all();
            return view('admin.employeeList',['data'=>$data,'companyList'=>$companyList]);
        }else{
            $data = Employees::join('companies','companies.id','=','employees.company_id')
                            ->select('companies.name as companyName','employees.name as name','employees.email as email','phone','employees.id as id')
                            ->where('employees.company_id',Auth::id())
                            ->paginate(10);
            $companyList = Companies::where('id',Auth::id())->get();
            return view('company.employeeList',['data'=>$data,'companyList'=>$companyList]);
        }
        
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Checking Validation 
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone'=>'required',
            'company_id' => 'required',
        ]);
        if(!Auth::user()->isAdmin()){
            $request->company_id = Auth::id();
        }
        
        Employees::create($request->only('name','email','phone','company_id'));
        
        
        return response()->json([
            'received'=>true,
            'message'=>"Created Successfully",
            'data'=>[
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "company_id" => $request->company_id,
            ],
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employees)
    {
        echo "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employees,$id)
    {
         //Checking Validation 
         $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'company_id' => 'required',
        ]);
        
        
        
        if(Auth::user()->isAdmin()){
            $employees::find($id)->update($request->only('name','email','phone','company_id'));
        }else{
            $employees::find($id)
                    ->where('company_id',Auth::id())
                    ->update($request->only('name','email','phone','company_id'));
        }
        
        return response()->json([
            'received'=>true,
            'message'=>"Updated Successfully",
            'data'=>[
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "company_id" => $request->company_id,
            ],
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employees,$id)
    {
        if(Auth::user()->isAdmin()){
            $employees = $employees::find($id);
            $employees->delete();
            return redirect()->route('employees.index')->with('status','Deleted Successfully');
        }else{
            $employees = $employees::find($id)->where('company_id',Auth::id());
            $employees->delete();
            return redirect()->route('employeesForCompany.index')->with('status','Deleted Successfully');
        }
        
        
    }
}
