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


            <a href= "{{url('/CreateNew')}}" type="button" class="btn btn-lg btn-block btn-primary">Create New Compay</a>
            <a href= "{{url('/CompanyList')}}" type="button" class="btn btn-lg btn-block btn-success">Company List</a>
            <a href= "{{url('/EmployeeList')}}" type="button" class="btn btn-lg btn-block btn-info">Employee List</a>
        </div>
    </div>

@endsection