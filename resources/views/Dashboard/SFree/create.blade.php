@extends('layouts.master')
@section('title',"انشاء الاسهم المجانية")



@section('content')
<div class="container pt-5">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <h5 id="AddUserLabel" class="mb-0">اضافة الاسهم المجانية</h5>
        </div>
        <div class="card-body">
            <form class="add-new-user" id="addNewUserForm" action="{{ route('sfree.store') }}" method="POST" enctype="multipart/form-data"   >
                @csrf
                <div class="row g-3">
                    <!-- Name Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="add-user-fullname">الاسم</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="ادخل اسم السهم المجاني" name="title" required>
                        @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="add-user-email">توزيع السهم</label>
                        <input type="text" id="add-user-distrip" class="form-control" placeholder=" سهم مجاني لكل سهم أصلي2.0" name="distrip" required>
                        @error('distrip')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Password Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="entitle_date">تاريخ الاستحقاق</label>
                        <input type="date" id="entitle_date" class="form-control" name="entitle_date" required>
                        @error('entitle_date')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="dis_date">تاريخ التوزيع</label>
                        <input type="date" id="dis_date" class="form-control" name="dis_date" placeholder="********" required>
                        @error('dis_date')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">Save</button>
                    <a href="{{ route('sfree.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


