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
                        <h1 class="h3 mb-0 text-gray-800">Employee Details</h1>
                        <li class="list-unstyled">
                            <a href="{{ route('employees.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                Cancel
                            </a>
                        </li>
                    
                    </div>
                    <hr>
                    {{-- Details for employee --}}
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8">
                                <h2>{{ ucwords($employee->name) }}</h2>
                                <hr>
                                <p><strong>Designation: </strong> {{ $employee->designation->title }} </p>
                                <p><strong>Father Name: </strong> {{ $employee->father_name }} </p>
                                <p><strong>Email: </strong> {{ $employee->email }} </p>
                                <p><strong>Cnic: </strong> {{ $employee->cnic }}</p>
                                <p><strong>Phone Number: </strong> {{ $employee->phone_number }}</p>
                                <p><strong>Salary: </strong> {{ $employee->salary }}</p>
                                <p><strong>Address: </strong> {{ $employee->address }}</p>
                            </div>             
                            <div class="col-xs-12 col-sm-4 text-center">
                                <figure>
                                    <img src="/storage/{{ $employee->avatar }}" alt="Profile image" width="100px" height="100px">
                                </figure>
                            </div>
                        </div>
                    </div>
                    {{-- end of container --}}
                </div>
                <!-- /.container-fluid -->
            </div>
            <x-footer></x-footer>
		</div>
			<!-- End of Main -->
    </div>
    <x-top-button></x-top-button>
</x-app>