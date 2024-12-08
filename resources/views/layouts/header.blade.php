<nav
@php
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
$name= Auth::guard('admin')->name;
$id= Auth::guard('admin')->id();
$admin=Admin::findOrFail($id);
@endphp
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar">
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
  <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="ti ti-menu-2 ti-sm"></i>
  </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
  <!-- Search -->
  <div class="navbar-nav align-items-center">
    <div class="nav-item navbar-search-wrapper mb-0">
      <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
        <i class="ti ti-search ti-md me-2"></i>
        <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
      </a>
    </div>
  </div>
  <!-- /Search -->

  <ul class="navbar-nav flex-row align-items-center ms-auto">
    {{-- <!-- Language -->
    <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <i class="ti ti-language rounded-circle ti-md"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item" href="javascript:void(0);" data-language="en">
            <span class="align-middle">English</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="javascript:void(0);" data-language="fr">
            <span class="align-middle">French</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="javascript:void(0);" data-language="de">
            <span class="align-middle">German</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="javascript:void(0);" data-language="pt">
            <span class="align-middle">Portuguese</span>
          </a>
        </li>
      </ul>
    </li>
    <!--/ Language --> --}}

    <!-- Style Switcher -->
    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <i class="ti ti-md"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
        <li>
          <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
            <span class="align-middle"><i class="ti ti-sun me-2"></i>Light</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
            <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
            <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
          </a>
        </li>
      </ul>
    </li>
    <!-- / Style Switcher-->


    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
      <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
          <img src="{{ $admin->photo ? asset('images/' . $admin->photo) : asset('avater.png') }}" alt class="h-auto rounded-circle" />
        </div>
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="dropdown-item" href="#">
            <div class="d-flex">
              <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                  <img src="{{ $admin->photo ? asset('images/' . $admin->photo) : asset('avater.png') }}"  class="h-auto rounded-circle" />

                </div>
              </div>
              <div class="flex-grow-1">

                <span class="fw-medium d-block">{{ $name }}</span>
                <small class="text-muted">Admin</small>
              </div>
            </div>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>

          <a class="dropdown-item" href="admins/{{ $id }}">
            <i class="ti ti-user-check me-2 ti-sm"></i>
            <span class="align-middle">My Profile</span>
          </a>
        </li>
        <li>
          <a class="dropdown-item" href="#">
            <i class="ti ti-settings me-2 ti-sm"></i>
            <span class="align-middle">Settings</span>
          </a>
        </li>
        <li>
          <div class="dropdown-divider"></div>
        </li>
        <li>
            <form action="/logout" method="POST">
                @csrf
                <a class="dropdown-item" href="" ></a>
                    <i class="ti ti-logout me-2 ti-sm"></i>
                    <button type="submit" class="btn btn-danger">Log Out</button>
            </form>
        </li>
      </ul>
    </li>
    <!--/ User -->
  </ul>
</div>

<!-- Search Small Screens -->
<div class="navbar-search-wrapper search-input-wrapper d-none">
  <input
    type="text"
    class="form-control search-input container-xxl border-0"
    placeholder="Search..."
    aria-label="Search..." />
  <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
</div>
</nav>
