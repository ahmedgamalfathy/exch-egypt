@extends('layouts.master')
@section('title','الأسهم')
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
          <h5 class="card-title mb-3">الأسهم</h5>
          <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
            <div class="col-md-4 user_role">
                <a href="{{ route('create') }}">
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
                <th>الكود</th>
                <th>اسم السهم</th>
                <th>سعر الاغلاق السنوي</th>
                <th>سعر الاغلاق اليومي</th>
                <th colspan="2">نسبة الارتفاع خلال العام</th>
                <th>حجم السيولة الداخلة</th>
                <th>قيمة السيولة الداخلة</th>
                <th>حجم السيولة الخارجة</th>
                <th>قيمة السيولة الخارجة</th>
                <th>صافي السيولة</th>
                <th>نسبة السيولة</th>
                <th>حجم التداول</th>
                <th colspan="2">تاريخ الأنشاء</th>
                {{-- <th>تاريخ التعديل</th> --}}
                <th>الأضافة</th>
                <th>التعديل</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($stoks as $stok )
                <tr>

                    <td>{{ $stok->code }}</td>
                    <td>{{ $stok->stock_name }}</td>
                    <td>{{ $stok->closing_price_year }}</td>
                    <td>{{ $stok->closing_price_today }}</td>
                    <td colspan="2">{{ $stok->annual_growth_rate }}</td>
                    <td>{{ $stok->internal_liquidity_volume }}</td>
                    <td>{{ $stok->internal_liquidity_value }}</td>
                    <td>{{ $stok->external_liquidity_volume }}</td>
                    <td>{{ $stok->external_liquidity_value }}</td>
                    <td>{{ $stok->net_liquidity }}</td>
                    <td>{{ $stok->liquidity_ratio }}</td>
                    <td>{{ $stok->trading_volume }}</td>
                    <td colspan="2">{{ \Carbon\Carbon::parse($stok->created_at)->diffForHumans() }}</td>
                    {{-- <td>{{ $stok->updated_at}}</td> --}}
                    <td>
                        <a href="/stoks_edit/{{ $stok->id }}">
                            <button class="btn btn-secondary">تعديل</button>
                        </a>
                    </td>
                    <td>
                        <form   action="/stoks/{{ $stok->id }}" method="POST">
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
            {{ $stoks->onEachSide(5)->links() }}
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
