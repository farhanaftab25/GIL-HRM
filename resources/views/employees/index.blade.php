<x-app>
    <div id="wrapper">
        <x-sidebar></x-sidebar>
        <!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">
                <x-top-navbar></x-top-navbar>
                 <!-- Begin Page Content -->
                 <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Employees</h1>
                        <p class="mb-0 text-gray-800">
                            @if(Session::has('message'))
                                <div class="alert alert-danger">
                                    {{ Session::get('message')}}
                                </div>
                            @endif
                            @if(Session::has('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success')}}
                                </div>
                            @endif
                        </p>
                        <li class="list-unstyled">
                            <a href="{{ route('employees.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus-square"></i> Add Employee
                            </a>
                        </li>
                    
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Employee Id</th>
                                    <th>Profile pic</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Phone Number</th>
                                    <th>Salary</th>
                                    <th>CNIC</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>{{ $employee->employee_id }}</td>
                                        <td>
                                            <img src="storage/{{ $employee->avatar }}" alt="Profile image" width="100px" height="100px">
                                        </td>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->designation->title }}</td>
                                        <td>{{ $employee->phone_number }}</td>
                                        <td>{{ $employee->salary }}</td>
                                        <td>{{ $employee->cnic }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-eye text-white-50"></i>
                                            </a>
                                            <a 
                                                href="{{ route('employees.edit', $employee->id) }}" 
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit fa-sm text-white-50"></i>
                                            </a>
                                            <form action="{{ route('employees.destroy', $employee) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash fa-sm text-white-50"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                <!-- /.container-fluid -->
            </div>

            <x-footer></x-footer>
		</div>
			<!-- End of Main -->
    </div>
    <x-top-button></x-top-button>
    {{-- <script>
        $(document).on('submit', '#deleteForm', function (e) {
            alert('hello');
        });
    </script> --}}
</x-app>