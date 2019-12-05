@extends('layouts.app')

@section('Listcontent')
    {{-- START:Showing Success Message --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    {{-- END:Showing Success Message --}}

    <section>
        <table class="table table-hover table-triped">
            <thead>
                <tr>
                    <th scope="col">UserID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>

            <tbody>

              @forelse ($data as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <th>{{$item->first_name}} {{$item->last_name}}</th>
                    <th>{{$item->email}} </th>
                    <th>{{$item->phone}}</th>
                    {{-- START:Update Button --}}
                    <th>
                      <button type="button"  class="btn btn-primary update_btn update_button" data-toggle="modal" data-target="#Update_Button_Modal_{{$item->id}}">Update</button>
                          {{-- Update Button Modal Section:START --}}
                          <div class="modal fade" id="Update_Button_Modal_{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="Update_Button_Modal_Label" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="Update_Button_Modal_Label">Update User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    
                                    <form method="POST" action="{{ url('employees') }}/{{$item->id}} ">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group row">
                                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                                            <div class="col-md-6">
                                                <input id="first_name" type="text" class="form-control" name="first_name" required autofocus>
                                            </div>
                                        </div>
                            
                                        <div class="form-group row">
                                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                                            <div class="col-md-6">
                                                <input id="last_name" type="text" class="form-control" name="last_name" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>
                                            <div class="col-md-6">
                                                <input id="email" type="text" class="form-control" name="email" >
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                                            <div class="col-md-6">
                                                <input id="phone" type="text" class="form-control" name="phone"  >
                                            </div>
                                        </div>
                          
                        
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" >
                                                    Update User
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                    
                                  </div>
                                </div>
                              </div>
                          </div>
                          {{-- Update Button Modal Section:STOP --}}
                    </th>
                    {{-- STOP:Update Button --}}

                    {{-- START:Delete Button --}}
                    <th>
                        <form method="POST" action="{{url('/employees')}}/{{$item->id}}"> 
                          @method("DELETE")
                          @csrf
                          <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </th>
                    {{-- STOP:Delete Button --}}

                </tr>
              @empty
                  <tr>
                    <th colspan="6" style="text-align: center;"><h1>No Data Found</h1></th>
                  </tr>
              @endforelse
                
                


            </tbody>

        </table>
    </section>


@endsection
