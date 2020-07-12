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
                        <h1 class="h3 mb-0 text-gray-800">Designations</h1>
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
                            <a href="{{ route('designations.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                                <i class="fas fa-plus-square"></i> Add Designation
                            </a>
                        </li>
                    
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Created at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($designations as $designation)
                                    <tr>
                                        <td>{{ ucwords($designation->title) }}</td>
                                        <td>{{ $designation->created_at->diffForHumans() }}</td>
                                        <td class="d-flex">
                                            <a 
                                                href="{{ route('designations.edit', $designation->id) }}" 
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit fa-sm text-white-50"></i>
                                            </a>
                                            <form action="{{ route('designations.destroy', $designation) }}" method="post">
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
</x-app>