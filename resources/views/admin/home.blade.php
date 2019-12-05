@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

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
                      <h5 class="modal-title" id="Create_Employee_Button_Modal_Label">Create User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      
                      <form method="POST" action="{{ url('employees') }} ">
                          @csrf
                          @method('PUT')
                          <div class="form-group row">
                              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                              <div class="col-md-6">
                                  <input id="name" type="text" class="form-control" name="name" required autofocus>
                              </div>
                          </div>
              
                          <div class="form-group row">
                              <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                              <div class="col-md-6">
                                <select class="form-control" id="exampleFormControlSelect1" name="company_id">
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
                                  <input id="email" type="text" class="form-control" name="email" required>
                              </div>
                          </div>


                          <div class="form-group row">
                              <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                              <div class="col-md-6">
                                  <input id="phone" type="text" class="form-control" name="phone"  required>
                              </div>
                          </div>
            
          
                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" >
                                      Create User
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
                            <h5 class="modal-title" id="Create_Company_Button_Modal_Label">Create User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                        
                            <form method="POST" action="{{ url('employees') }} ">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" required autofocus>
                                    </div>
                                </div>
                    
                                
                                

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                    <div class="col-md-6">
                                        <input id="email" type="text" class="form-control" name="email" required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('website') }}</label>
                                    <div class="col-md-6">
                                        <input id="website" type="text" class="form-control" name="website"  required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('logo') }}</label>
                                    <div class="col-md-6">
                                        <input id="logo" type="file" class="form-control" name="logo">
                                    </div>
                                </div>
                
                
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" >
                                            Create User
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

@endsection
