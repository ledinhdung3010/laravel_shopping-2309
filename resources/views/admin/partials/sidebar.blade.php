<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
          <div class="sidebar-brand d-none d-md-flex">
            <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
              <use xlink:href="assets/brand/coreui.svg#full"></use>
            </svg>
            <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
              <use xlink:href="assets/brand/coreui.svg#signet"></use>
            </svg>
          </div>
          <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
            <li class="nav-item"><a class="nav-link" href="{{route('admin.dashboard')}}">
                <svg class="nav-icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                </svg> Dashboard
                {{-- <span class="badge badge-sm bg-info ms-auto">NEW</span> --}}
              </a></li>
            <li class="nav-title">Manage</li>
            <li class="nav-item"><a class="nav-link" href="{{route('admin.order')}}">
              <svg class="nav-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
              </svg>Order Management</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('admin.user')}}">
                <svg class="nav-icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                </svg>Admin Management</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('admin.color')}}">
                <svg class="nav-icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
                </svg> Colors</a></li>
            
            <li class="nav-item"><a class="nav-link" href="{{route('admin.category')}}">
              <svg class="nav-icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
              </svg>Categories</a></li>
              <li class="nav-item"><a class="nav-link" href="#">
                <svg class="nav-icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                </svg>Tags</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('admin.size')}}">
                <svg class="nav-icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                </svg>Sizes</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('admin.product')}}">
                <svg class="nav-icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil"></use>
                </svg>Products</a></li>
 
          </ul>
         
        </div>