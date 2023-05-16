<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sentaku Laundry</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>


    {{-- @can('read-customer') --}}
    <li class="nav-item {{ request()->segment(2) == 'customer' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('customer.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Customer</span></a>
    </li>
    <li class="nav-item {{ request()->segment(2) == 'karyawan' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('karyawan.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Karyawan</span></a>
    </li>
    <li class="nav-item {{ request()->segment(2) == 'pricelist' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pricelist.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Price List</span></a>
    </li>
    <li class="nav-item {{ request()->segment(2) == 'payment' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('payment.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Payment</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
