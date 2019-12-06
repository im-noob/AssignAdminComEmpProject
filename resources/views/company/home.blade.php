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
                

            <a href= "#" type="button" class="btn btn-lg btn-block btn-primary" data-toggle="modal" data-target="#Create_Employee_Button_Modal" >Create New Employee</a>

            <a href= "{{url('/employeesForCompany')}}" type="button" class="btn btn-lg btn-block btn-info">My Employee List</a>
            

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
                      <form method="POST" action="{{ url('employeesForCompany') }} ">
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
                                    @forelse ($companyList as $item)
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

                
    


        </div>
    </div>


    <script>
        $(function(){
            console.log("Script Start");




            //Create Employee Section:START
            $("#CreateEmployeeButton").click(function(){
                $Empname = $("#Empname").val();
                $Empemail = $("#Empemail").val();
                $Empcompany_id = $("#Empcompany_id").val();
                $Empphone = $("#Empphone").val();
                


                if(!validateEmail($Empemail)){
                    alert("Not a valid Email");
                    return;
                }


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
                            url: "{{url('/')}}/employeesForCompany", 
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
