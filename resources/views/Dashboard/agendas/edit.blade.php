@extends('layouts.master')
@section('title',"تعديل الاجندة الاقتصادية")
@section('content')
{{-- <form class="add-new-user pt-0" id="addNewUserForm" action="/admins/{{ $admin->id }}" method="POST">
    @method('PUT')
    @csrf --}}
    <div class="container pt-5">
        <div class="card shadow-sm border-0">
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <h5 id="AddUserLabel" class="mb-0">تعديل الاجندة الاقتصادية</h5>
            </div>
            <div class="card-body">
                <form class="add-new-user" id="addNewUserForm" action="{{ route('agenda.update',['id'=>$agenda->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row g-3">
                {{-- //code , stock_name, closing_price_year, closing_price_today,annual_growth_rate
                    //internal_liquidity_volume, internal_liquidity_value, external_liquidity_volume
                    //external_liquidity_value, net_liquidity,liquidity_ratio,trading_volume --}}
                        <!-- Name Field -->
                         {{-- company_name ,currency,payer,coupon_number,coupon_value,maturity_date,transaction_date --}}
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">اسم الشركة</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="company_name" value="{{ $agenda->company_name }}" required>
                            @error('company_name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">العملة</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="currency" value="{{ $agenda->currency }}" required>
                            @error('currency')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">جهة الصرف</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="payer" value="{{ $agenda->payer }}" required>
                            @error('payer')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">رقم الكوبون</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="coupon_number" value="{{ $agenda->coupon_number }}" required>
                            @error('coupon_number')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">قيمة الكوبون</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="coupon_value" value="{{ $agenda->coupon_value }}" required>
                            @error('coupon_value')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">تاريخ الاستحقاق</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="maturity_date" value="{{ $agenda->maturity_date }}" required>
                            @error('maturity_date')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">تاريخ الصرف</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="transaction_date" value="{{ $agenda->transaction_date }}" required>
                            @error('transaction_date')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        <button  type="submit" class="btn btn-success" onclick="return confirm('Are you sure edit?')" >تعديل</button>
                        <a href="{{ route('agendas') }}" class="btn btn-danger">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
