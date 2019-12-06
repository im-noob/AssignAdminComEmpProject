@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
                <div id="status">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif             
                </div>
                

            @if (sizeof($comanyList) != 0) 
                <a href= "{{url('/CreateNew')}}" type="button" class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target="#Create_Employee_Button_Modal" >Create New Compay</a>
            @endif

            <a href= "{{url('/CreateNew')}}" type="button" class="btn btn-lg btn-block btn-dark" data-toggle="modal" data-target="#Create_Company_Button_Modal" >Create New Employee</a>
             <a href= "{{url('/companies')}}" type="button" class="btn btn-lg btn-block btn-success">Company List</a>
            <a href= "{{url('/EmployeeList')}}" type="button" class="btn btn-lg btn-block btn-info">Employee List</a>
            

            {{-- CreateNew Employee Button Modal Section:START --}}
            <div class="modal fade" id="Create_Employee_Button_Modal" tabindex="-1" role="dialog" aria-labelledby="Create_Employee_Button_Modal_Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="Create_Employee_Button_Modal_Label">Create Employee</h5>
                      <button id="EmployeeCloseButton" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div id="CreateEmployeeFormError">
                        
                        </div>
                      <form method="POST" action="{{ url('employees') }} ">
                          @csrf
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                              <div class="col-md-6">
                                  <input id="Empname" type="text" class="form-control" name="name" required autofocus>
                              </div>
                          </div>
              
                          <div class="form-group row">
                              <label for="exampleFormControlSelect1" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" id="Empcompany_id" name="company_id">
                                    @forelse ($comanyList as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @empty
                                        <option value="0">No Company</option>
                                    @endforelse
                                    
                                  </select>
                              </div>
                          </div>
                          

                          <div class="form-group row">
                              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                              <div class="col-md-6">
                                  <input id="Empemail" type="text" class="form-control" name="email" required>
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="Empphone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                              <div class="col-md-6">
                                  <input id="Empphone" type="text" class="form-control" name="phone"  required>
                              </div>
                          </div>
            
          
                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button id="CreateEmployeeButton"  type="button" class="btn btn-primary" >
                                      Create Employee
                                  </button>
                              </div>
                          </div>

                      </form>
                      
                    </div>
                  </div>
                </div>
            </div>
            {{-- CreateNew Employee Button Modal Section:STOP --}}


            {{-- CreateNew Company Button Modal Section:START --}}
            <div class="modal fade" id="Create_Company_Button_Modal" tabindex="-1" role="dialog" aria-labelledby="Create_Company_Button_Modal_Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="Create_Company_Button_Modal_Label">Create Company</h5>
                            <button id="CreateCompanyCloseButton" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="CreateCompanyFormError">
                                
                            </div>
                            <form method="POST" action="{{ url('employees') }}" id="CreateEmployeeForm">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                    <div class="col-md-6">
                                        <input id="Compname" type="text" class="form-control" name="name" required autofocus>
                                    </div>
                                </div>
                    
                                
                                

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                    <div class="col-md-6">
                                        <input id="Compemail" type="text" class="form-control" name="email" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('password') }}</label>
                                    <div class="col-md-6">
                                        <input id="Comppassword" type="text" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('website') }}</label>
                                    <div class="col-md-6">
                                        <input id="Compwebsite" type="text" class="form-control" name="website"  required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('logo') }}</label>
                                    <div class="col-md-6">
                                        <input id="Complogo" type="file" class="form-control" name="logo">
                                    </div>
                                </div>
                
                
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" id="CreateCompanyButton" class="btn btn-primary" >
                                            Create Company
                                        </button>
                                    </div>
                                </div>

                            </form>
                        
                        </div>
                    </div>
                </div>
            </div>
            {{-- CreateNew Company Button Modal Section:STOP --}}
    
                
    


        </div>
    </div>


    <script>
        $(function(){
            console.log("Script Start");


            //Create Company Section:START
            $("#CreateCompanyButton").click(function(){
                $Compname = $("#Compname").val();
                $Compemail = $("#Compemail").val();
                $Compwebsite = $("#Compwebsite").val();
                $Complogo = $("#Complogo").val();
                $Comppassword = $("#Comppassword").val();
                
                // START: Ajax Request
                $.ajax({
                            cache: false,
                            type: "POST",
                            data: {
            
                                _method: "POST",
                                _token:  "{{ csrf_token() }}",
                                name : $Compname,
                                email : $Compemail,
                                password: $Comppassword,
                                website : $Compwebsite,
                                logo : $Complogo,
                            },
                            url: "{{url('/')}}/companies", 
                            success: function(response){
                                console.log(response)
                                if (response.received) {

                                    $("#CreateCompanyCloseButton").click();
                                    $("#status").text("");
                                    $("#status").append('<div class="alert alert-success" role="alert">'+
                                            response.message
                                        +'</div>');

                                    //clearing data on success
                                    $("#Compname").val("");
                                    $("#Compemail").val("");
                                    $("#Compwebsite").val("");
                                    $("#Complogo").val("");

                                    // //filling value
                                    // $("#USDtoINRConverted").val(response.data.USDtoINRConverted);
                                    // $("#GoldQuientityIngForINR").val(response.data.GoldQuientityIngForINR);
                                    // $("#INRvalueIN1USD").val(response.data.INRvalueIN1USD);
                                    // $("#INRto1gGold").val(response.data.INRto1gGold);

                                }else{
                                    alert("Oops!!! Somthing is not right");
                                }
                            },
                            error: function(xhr,status,error){
                                $("#CreateCompanyFormError").text("");
                                $.each(xhr.responseJSON.errors, function (indexInArray, valueOfElement) { 
                                    console.log(valueOfElement[0]);
                                     $("#CreateCompanyFormError").append('<div class="alert alert-danger" role="alert">'+
                                            valueOfElement[0]
                                        +'</div>');
                                });

                                console.log(xhr.responseJSON);

                                console.log(status);
                                console.log(error);
                            }
                    });
                    // END: Ajax Request
            })
            //Create COmpany Section:STOP




            //Create Employee Section:START
            $("#CreateEmployeeButton").click(function(){
                $Empname = $("#Empname").val();
                $Empemail = $("#Empemail").val();
                $Empcompany_id = $("#Empcompany_id").val();
                $Empphone = $("#Empphone").val();
                
                // START: Ajax Request
                $.ajax({
                            cache: false,
                            type: "POST",
                            data: {
            
                                _method: "POST",
                                _token:  "{{ csrf_token() }}",
                                name : $Empname,
                                email : $Empemail,
                                company_id : $Empcompany_id,
                                phone : $Empphone,
                            },
                            url: "{{url('/')}}/employees", 
                            success: function(response){
                                console.log(response)
                                if (response.received) {

                                    $("#EmployeeCloseButton").click();
                                    $("#status").text("");
                                    $("#status").append('<div class="alert alert-success" role="alert">'+
                                            response.message
                                        +'</div>');

                                    //clearing data on success
                                    $("#Empname").val("");
                                    $("#Empemail").val("");
                                    $("#Empcompany_id").val("");
                                    $("#Empphone").val("");

                                    // //filling value
                                    // $("#USDtoINRConverted").val(response.data.USDtoINRConverted);
                                    // $("#GoldQuientityIngForINR").val(response.data.GoldQuientityIngForINR);
                                    // $("#INRvalueIN1USD").val(response.data.INRvalueIN1USD);
                                    // $("#INRto1gGold").val(response.data.INRto1gGold);

                                }else{
                                    alert("Oops!!! Somthing is not right");
                                }
                            },
                            error: function(xhr,status,error){
                                $("#CreateEmployeeFormError").text("");
                                $.each(xhr.responseJSON.errors, function (indexInArray, valueOfElement) { 
                                    console.log(valueOfElement[0]);
                                     $("#CreateEmployeeFormError").append('<div class="alert alert-danger" role="alert">'+
                                            valueOfElement[0]
                                        +'</div>');
                                });

                                console.log(xhr.responseJSON);

                                console.log(status);
                                console.log(error);
                            }
                    });
                    // END: Ajax Request
            })
            //Create Employee Section:STOP


        })
    </script>

@endsection
