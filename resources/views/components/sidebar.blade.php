<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">HRM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Main
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDesignation" aria-expanded="true" aria-controls="collapseDesignation">
          <i class="fas fa-fw fa-industry"></i>
          <span>Designation</span>
        </a>
        <div id="collapseDesignation" class="collapse" aria-labelledby="headingDesignation" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
            <a class="collapse-item" href="{{ route('designations.index') }}">All Designation</a>
            <a class="collapse-item" href="{{ route('designations.create') }}">Add Designation</a>
          </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmployee" aria-expanded="true" aria-controls="collapseEmployee">
          <i class="fas fa-fw fa-user"></i>
          <span>Employee</span>
        </a>
        <div id="collapseEmployee" class="collapse" aria-labelledby="headingEmployee" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('employees.index') }}">All Employee</a>
            <a class="collapse-item" href="{{ route('employees.create') }}">Add Employee</a>
          </div>
        </div>
    </li>
</ul>
<!-- End of Sidebar -->