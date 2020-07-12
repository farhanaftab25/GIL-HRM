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
                        <h1 class="h3 mb-0 text-gray-800">Add Designation</h1>
                        <li class="list-unstyled">
                            <a href="{{ route('designations.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                <i class="fa fa-window-close"></i> Cancel</a>
                        </li>
                    
                    </div>
                    
                    {{-- Form for adding designations --}}
                    <form method="post" action="{{ route('designations.store') }}">
                        @csrf
                        <div class="form-row"> 
                            <div class="col-md-12">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                                value="{{ old('title') }}">
                            </div>
                            @error('title')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if (Session::has('message'))
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{ Session::get('message') }}</strong>
                            </span>
                        @endif
                       
                        <div class="row mt-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Add Designation</button>
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