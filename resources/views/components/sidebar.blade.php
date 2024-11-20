<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Agung Swalayan</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">AG</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li>
                <a href="{{ url('dashboard-general-dashboard') }}"
                    class="nav-link {{ Request::is('dashboard-general-dashboard') ? 'active' : '' }}">
                    <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="menu-header">Sales</li>
            <li class="nav-item dropdown {{ $type_menu === 'sales' ? 'active' : '' }}">
                <a href="#sales" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-shopping-cart"></i><span>Sales</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('pages.sales.index') ? 'active' : '' }}">
                        <a href="{{ route('sales.index') }}" class="nav-link">Index</a>
                    </li>
                    <li class="{{ Request::is('pages.sales.create') ? 'active' : '' }}">
                        <a href="{{ route('sales.create') }}" class="nav-link">Create</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Products</li>
            <li class="nav-item dropdown {{ $type_menu === 'products' ? 'active' : '' }}">
                <a href="#products" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-boxes-packing"></i><span>Products</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('layout-default-layout') ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}" class="nav-link">Index</a>
                    </li>
                    <li class="{{ Request::is('layout-default-layout') ? 'active' : '' }}">
                        <a href="#" class="nav-link">Create</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Inventory</li>
            <li class="nav-item dropdown {{ $type_menu === 'inventories' ? 'active' : '' }}">
                <a href="#inventory" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Inventory</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('layout-default-layout') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('layout-default-layout') }}">Adjustments</a>
                    </li>
                    <li class="{{ Request::is('transparent-sidebar') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('transparent-sidebar') }}">Low Stock</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Customers</li>
            <li class="nav-item dropdown {{ $type_menu === 'customers' ? 'active' : '' }}">
                <a href="#customers" class="nav-link has-dropdown"><i class="fas fa-th"></i><span>Customers</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('layout-default-layout') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('layout-default-layout') }}">Index</a>
                    </li>
                    <li class="{{ Request::is('transparent-sidebar') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('transparent-sidebar') }}">Create</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Suppliers</li>
            <li class="nav-item dropdown {{ $type_menu === 'suppliers' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                    <span>Suppliers</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('layout-default-layout') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('layout-default-layout') }}">Index</a>
                    </li>
                    <li class="{{ Request::is('transparent-sidebar') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('transparent-sidebar') }}">Create</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Reports</li>
            <li class="nav-item {{ $type_menu === 'reports' ? 'active' : '' }}">
                <a href="#" class="nav-link"><i class="far fa-user"></i> <span>Report Sales</span></a>
                <a href="#" class="nav-link"><i class="far fa-user"></i> <span>Report Inventories</span></a>
                <a href="#" class="nav-link"><i class="far fa-user"></i> <span>Report Finances</span></a>
                <a href="#" class="nav-link"><i class="far fa-user"></i> <span>Report User Activities</span></a>
            </li>
        </ul>
    </aside>
</div>
