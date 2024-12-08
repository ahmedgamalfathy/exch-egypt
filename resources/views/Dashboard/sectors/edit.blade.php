@extends('layouts.master')
@section('title',"تعديل السهم")
@section('content')
{{-- <form class="add-new-user pt-0" id="addNewUserForm" action="/admins/{{ $admin->id }}" method="POST">
    @method('PUT')
    @csrf --}}
    <div class="container pt-5">
        <div class="card shadow-sm border-0">
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <h5 id="AddUserLabel" class="mb-0">تعديل مؤشر</h5>
            </div>
            <div class="card-body">
                <form class="add-new-user" id="addNewUserForm" action="{{ route('sector.update',['id'=>$sector->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row g-3">
                {{-- //code , stock_name, closing_price_year, closing_price_today,annual_growth_rate
                    //internal_liquidity_volume, internal_liquidity_value, external_liquidity_volume
                    //external_liquidity_value, net_liquidity,liquidity_ratio,trading_volume --}}
                        <!-- Name Field -->
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">مؤشر</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="index" value="{{ $sector->index }}" required>
                            @error('index')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">الاغلاق</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="closing" value="{{ $sector->closing }}" required>
                            @error('closing')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">التغير</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="change" value="{{ $sector->change }}" required>
                            @error('change')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">التغير%</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="change_percentage" value="{{ $sector->change_percentage }}" required>
                            @error('change_percentage')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">أعلى</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="high" value="{{ $sector->high }}" required>
                            @error('high')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">ادنى</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="low" value="{{ $sector->low }}" required>
                            @error('low')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">الحجم</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="volume" value="{{ $sector->volume }}" required>
                            @error('volume')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">القيمة</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="value" value="{{ $sector->value }}" required>
                            @error('value')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">الصفقات</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="transactions" value="{{ $sector->transactions }}" required>
                            @error('transactions')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="add-user-fullname">صافي السيولة</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="" name="net_liquidity" value="{{ $sector->net_liquidity }}" required>
                            @error('net_liquidity')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        <button  type="submit" class="btn btn-success" onclick="return confirm('Are you sure edit?')" >تعديل</button>
                        <a href="{{ route('sectors') }}" class="btn btn-danger">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
