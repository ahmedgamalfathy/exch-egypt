@extends('layouts.master')
@section('title',"إضافة الاجندة الاقتصادية ")
@section('content')
{{-- <form class="add-new-user pt-0" id="addNewUserForm" action="/admins/{{ $admin->id }}" method="POST">
    @method('PUT')
    @csrf --}}
    <div class="container pt-5">
        <div class="card shadow-sm border-0">
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <h5 id="AddUserLabel" class="mb-0">تأكد من استيراد  ملف الأكسل الخاص بالاجندة الاقتصادية</h5>
            </div>

            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form class="add-new-user" id="addNewUserForm" action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                {{-- //code , stock_name, closing_price_year, closing_price_today,annual_growth_rate
                    //internal_liquidity_volume, internal_liquidity_value, external_liquidity_volume
                    //external_liquidity_value, net_liquidity,liquidity_ratio,trading_volume --}}
                        <!-- Name Field -->

                        <div class="col-md-12">
                            <label class="form-label" for="add-user-fullname">استيراد ملف  الأجندة الأقتصادية</label>
                            <input type="file" class="form-control" id="add-user-fullname"  name="file" required>
                            @error('file')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end gap-4 mt-4">
                        <button  type="submit" class="btn" style="background-color:#7367f0; color:white;" onclick="return confirm('هل انت متاكد من  استيراد هذا الملف ')" >حفظ</button>
                        <a href="{{ route('agendas') }}" class="btn btn-danger">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
