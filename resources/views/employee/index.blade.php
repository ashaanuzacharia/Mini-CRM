@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header">Employees</div>

                <div class="card-body">
                    <div class="text-right mb-4">
                        <a class="btn btn-success" href="{{ route('employees.create') }}">Create new employee</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class') }}">
                        {{ Session::get('message') }}
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-header">Employees list</div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Company</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($employees as $employee)
                                        <?php
                                            $company = DB::table('companies')->where(['id' => $employee->company_id])->first();
                                        ?>
                                        <tr>
                                            <td class="text-center">{{ $employee->id }}</td>
                                            <td>{{ $employee->first_name }}</td>
                                            <td>{{ $employee->last_name }}</td>
                                            <td>{{ $company->name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->phone }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-info btn-sm" href="{{ route('employees.view', $employee->id) }}">View</a>
                                                <a class="btn btn-secondary btn-sm" href="{{ route('employees.edit', $employee->id) }}">Edit</a>
                                                <a class="btn btn-danger btn-sm" href="{{ route('employees.delete', $employee->id) }}">Delete</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Oops! Nothing to show.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div class="float-right">
                                
                            {!! $employees->links() !!}
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection