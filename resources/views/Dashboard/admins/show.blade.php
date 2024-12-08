@extends('layouts.master')
@section('title','عرض مستخدم ')
@section('content')
          <!-- Content wrapper -->

          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="py-3 mb-4"><span class="text-muted fw-light">User / View /</span> Account</h4>
              <div class="row">
                <!-- User Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                  <!-- User Card -->
                  <div class="card mb-4">
                    <div class="card-body">
                      <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                          <img
                            class="img-fluid rounded mb-3 pt-1 mt-4"
                            src="{{ asset('images/'.$admin->photo) }}"
                            height="100"
                            width="100"
                            alt="User avatar" />
                          <div class="user-info text-center">
                            <h4 class="mb-2">{{ $admin->email }}</h4>
                            <span class="badge bg-label-secondary mt-1">{{ $admin->name }}</span>
                          </div>
                        </div>
                      </div>
                      <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                      </div>
                      <p class="mt-4 small text-uppercase text-muted">التفاصيل</p>
                      <div class="info-container">
                        <ul class="list-unstyled">
                          <li class="mb-2">
                            <span class="fw-medium me-1">اسم المستخدم:</span>
                            <span>{{ $admin->username }}</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">الايميل:</span>
                            <span>{{ $admin->email }}</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">الحالة:</span>
                            <span class="badge bg-label-success">Active</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">الدور:</span>
                            <span>Admin</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">تاريخ الانشاء:</span>
                            <span>{{ \Carbon\Carbon::parse($admin->created_at)->diffForHumans() }}</span>
                          </li>
                          <li class="mb-2 pt-1">
                            <span class="fw-medium me-1">آخر تحديث:</span>
                            <span>{{ \Carbon\Carbon::parse($admin->updated_at)->diffForHumans() }}</span>
                          </li>
                        </ul>
                        <div class="d-flex justify-content-center">
                          <a
                            href="{{ route('admins.edit',['admin'=> $admin->id]) }}"
                            class="btn btn-primary me-3"
                            {{-- data-bs-target="#editUser"
                            data-bs-toggle="modal" --}}
                            >Edit</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /User Card -->
                </div>
                <!--/ User Sidebar -->

                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                  <!-- Project table -->
                  <div class="card mb-4">
                    <h5 class="card-header">User's Projects List</h5>
                    <div class="table-responsive mb-3">
                      <table class="table datatable-project border-top">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Project</th>
                            <th class="text-nowrap">Total Task</th>
                            <th>Progress</th>
                            <th>Hours</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                  <!-- /Project table -->

                </div>
                <!--/ User Content -->
              </div>
              <!-- /Modal -->
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>

@endsection
