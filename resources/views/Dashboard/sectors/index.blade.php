@extends('layouts.master')
@section('title','القطاعات')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Session</span>
                  <div class="d-flex align-items-center my-2">
                    <h3 class="mb-0 me-2">21,459</h3>
                    <p class="text-success mb-0">(+29%)</p>
                  </div>
                  <p class="mb-0">Total Users</p>
                </div>
                <span class="badge bg-label-primary rounded p-2">
                  <i class="ti ti-user ti-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Paid Users</span>
                  <div class="d-flex align-items-center my-2">
                    <h3 class="mb-0 me-2">4,567</h3>
                    <p class="text-success mb-0">(+18%)</p>
                  </div>
                  <p class="mb-0">Last week analytics</p>
                </div>
                <span class="badge bg-label-danger rounded p-2">
                  <i class="ti ti-user-plus ti-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Active Users</span>
                  <div class="d-flex align-items-center my-2">
                    <h3 class="mb-0 me-2">19,860</h3>
                    <p class="text-danger mb-0">(-14%)</p>
                  </div>
                  <p class="mb-0">Last week analytics</p>
                </div>
                <span class="badge bg-label-success rounded p-2">
                  <i class="ti ti-user-check ti-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Pending Users</span>
                  <div class="d-flex align-items-center my-2">
                    <h3 class="mb-0 me-2">237</h3>
                    <p class="text-success mb-0">(+42%)</p>
                  </div>
                  <p class="mb-0">Last week analytics</p>
                </div>
                <span class="badge bg-label-warning rounded p-2">
                  <i class="ti ti-user-exclamation ti-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div>
        @if(Session::has('message'))
        <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif
    </div>
      <!-- Users List Table -->
      <div class="card">
        <div class="card-header border-bottom">
          <h5 class="card-title mb-3">القطاعات</h5>
          <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
            <div class="col-md-4 user_role">
                <a href="{{ route('sector.create') }}">
                <button class="btn " style="background-color:#7367f0; color:white;">اضف</button>
               </a>
            </div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
          </div>
        </div>
        <div class="card-datatable table-responsive">
          <table class="datatables-users table">
            <thead class="border-top">
              <tr>
                <th>المؤشرات</th>
                <th>الاغلاق</th>
                <th>التغير</th>
                <th>التغير%</th>
                <th colspan="2">أعلى</th>
                <th>أدنى</th>
                <th>الحجم</th>
                <th>القيمة</th>
                <th>الصفقات</th>
                <th>صافي السيولة</th>
                <th>التعديل</th>
                <th>الحذف</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($sectors as $sector )
                <tr>
                    <td>{{ $sector->index }}</td>
                    <td>{{ $sector->closing }}</td>
                    <td>{{ $sector->change }}</td>
                    <td>{{ $sector->change_percentage }}</td>
                    <td colspan="2">{{ $sector->high }}</td>
                    <td>{{ $sector->low }}</td>
                    <td>{{ $sector->volume }}</td>
                    <td>{{ $sector->value }}</td>
                    <td>{{ $sector->transactions }}</td>
                    <td>{{ $sector->net_liquidity }}</td>
                    <td colspan="2">{{ \Carbon\Carbon::parse($sector->created_at)->diffForHumans() }}</td>
                    {{-- <td>{{ $stok->updated_at}}</td> --}}
                    <td>
                        <a href="{{ route('sector.edit',['id'=>$sector->id]) }}">
                            <button class="btn btn-secondary">تعديل</button>
                        </a>
                    </td>
                    <td>
                        <form   action="{{ route('delete.sector',['id'=>$sector->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button  type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" >حذف </button>
                        </form>
                    </td>

               </tr>
                @endforeach
            </tbody>
          </table>
          <div class="pt-5 d-flex justify-content-center">
            {{ $sectors->onEachSide(5)->links() }}
        </div>
        </div>
      </div>
    </div>
    <!-- / Content -->



    <div class="content-backdrop fade"></div>
  </div>

@endsection
@section('script')
<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this item?")) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection
