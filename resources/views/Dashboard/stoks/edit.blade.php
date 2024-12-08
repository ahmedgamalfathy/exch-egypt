@extends('layouts.master')
@section('title',"تعديل السهم")
@section('content')
{{-- <form class="add-new-user pt-0" id="addNewUserForm" action="/admins/{{ $admin->id }}" method="POST">
    @method('PUT')
    @csrf --}}
    <div class="container pt-5">
        <div class="card shadow-sm border-0">
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <h5 id="AddUserLabel" class="mb-0">تعديل اسهم</h5>
            </div>
            <div class="card-body">
                <form class="add-new-user" id="addNewUserForm" action="{{ route('update',['id'=>$stok->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row g-3">
                {{-- //code , stock_name, closing_price_year, closing_price_today,annual_growth_rate
                    //internal_liquidity_volume, internal_liquidity_value, external_liquidity_volume
                    //external_liquidity_value, net_liquidity,liquidity_ratio,trading_volume --}}
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">الكود</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="code" value="{{ $stok->code }}" required>
                            @error('code')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">اسم السهم</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="stock_name" value="{{ $stok->stock_name }}" required>
                            @error('stock_name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">سعر الاغلاق السنوي</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="closing_price_year" value="{{ $stok->closing_price_year }}" required>
                            @error('closing_price_year')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">سعر الاغلاق اليومي</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="closing_price_today" value="{{ $stok->closing_price_today }}" required>
                            @error('closing_price_today')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">نسبة الارتفاع خلال العام</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="annual_growth_rate" value="{{ $stok->annual_growth_rate }}" required>
                            @error('annual_growth_rate')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">حجم السيولة الداخلة</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="internal_liquidity_volume" value="{{ $stok->internal_liquidity_volume }}" required>
                            @error('internal_liquidity_volume')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">قيمة السيولة الداخلة</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="internal_liquidity_value" value="{{ $stok->internal_liquidity_value }}" required>
                            @error('internal_liquidity_value')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">حجم السيولة الخارجة</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="external_liquidity_volume" value="{{ $stok->external_liquidity_volume }}" required>
                            @error('external_liquidity_volume')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">قيمة السيولة الخارجة</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="external_liquidity_value" value="{{ $stok->external_liquidity_value }}" required>
                            @error('external_liquidity_value')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">صافي السيولة</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="net_liquidity" value="{{ $stok->net_liquidity }}" required>
                            @error('net_liquidity')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">نسبة السيولة</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="liquidity_ratio" value="{{ $stok->liquidity_ratio }}" required>
                            @error('liquidity_ratio')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">حجم التداول</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="trading_volume" value="{{ $stok->trading_volume }}" required>
                            @error('trading_volume')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        <button  type="submit" class="btn btn-success" onclick="return confirm('Are you sure edit?')" >تعديل</button>
                        <a href="{{ route('stoks') }}" class="btn btn-danger">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
