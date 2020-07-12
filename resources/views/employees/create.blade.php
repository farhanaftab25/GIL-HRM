<x-app>
    <div id="wrapper">
        <x-sidebar></x-sidebar>
        <!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">
                <x-top-navbar></x-top-navbar>
                {{-- Create form --}}
                <!-- Begin Page Content -->
                <div class="container-fluid">
                     <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Employee</h1>
                        <li class="list-unstyled">
                            <a href="{{ route('employees.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                <i class="fa fa-window-close"></i> Cancel</a>
                        </li>
                       
                    </div>
                    <hr>           
                    <form method="post" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="employee_id">Employee ID</label>
                                <input type="text" class="form-control" id="employee_id" name="employee_id"
                                value='{{ old('employee_id') }}'>
                                @error('employee_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                         
                        </div>
                       
                        <div class="card mb-2">
                            <div class="card-header bg-primary">
                                <h3 class="text-white">Personal Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                        value='{{ old('name') }}'>
                                        @error('name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="avatar">Profile Image</label>
                                        <input type="file" class="form-control" id="avatar" name="avatar"
                                        value='{{ old('avatar') }}'>
                                        @error('avatar')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="father_name">Father Name</label>
                                        <input type="text" class="form-control" id="father_name" name="father_name"
                                        value='{{ old('father_name') }}'>
                                        @error('father_name')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                        value='{{ old('email') }}'>
                                        @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="cnic">Cnic</label>
                                        <input type="number" class="form-control" id="cnic" name="cnic"
                                        value='{{ old('cnic') }}' placeholder="Dashes are not allowed">
                                        @error('cnic')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="number" class="form-control" id="phone_number" name="phone_number"
                                        value='{{ old('phone_number') }}'>
                                        @error('phone_number')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" id="address" name="address">
                                            {{ old('address') }}
                                        </textarea>
                                        @error('address')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        <div class="card mb-2">
                            <div class="card-header bg-primary">
                                <h3 class="text-white">Company Information</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="salary">Salary</label>
                                        <input type="number" class="form-control" id="salary" name="salary"
                                        value='{{ old('salary') }}'>
                                        @error('salary')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group col-md-6">
                                        <label for="designation">Select Designation</label>
                                        <select class="form-control" id="designation" name="designation_id">
                                            @foreach (\App\Designation::all() as $designation)
                                                <option value="{{ $designation->id }}">{{ $designation->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('designation_id')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                        {{-- Card body end --}}
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="submit" value="Add Employee" class="btn btn-primary">
                            </div>
                          </div>
                    </form>
                </div>
            </div>

            <x-footer></x-footer>
		</div>
			<!-- End of Main -->
    </div>
    <x-top-button></x-top-button>
</x-app>
