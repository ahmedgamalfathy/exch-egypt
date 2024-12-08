@extends('layouts.master')
@section('title',"تعديل خبر ")



@section('content')
<div class="container pt-5">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <h5 id="AddUserLabel" class="mb-0">تعديل خبر</h5>
        </div>
        <div class="card-body">
            <form class="add-new-user" id="addNewUserForm" action="{{ route('update_new',['id'=>$new->id]) }}" method="POST" enctype="multipart/form-data"   >
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <!-- Name Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="add-user-fullname">العنوان</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="عنوان الخبر ..." name="title" value="{{ $new->title }}" required>
                        @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="stoks">اختر سهم </label>
                        <select id="stoks" name="stok_id" class=" form-select" data-placeholder="Size">
                            <option value="">اختر</option>
                            @forelse ($stoks as $stok)
                            <option value="{{$stok->id}}" {{$new->stok_id?$new->stok->id == $stok->id ? 'selected':'':""}} >{{$stok->stock_name}}</option>
                            @empty
                            <option selected>لاتوجد اخبار</option>
                            @endforelse
                          </select>
                        @error('stock_name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Email Field -->
                    <div class="col-md-12">
                        <label class="form-label" for="notes">المحتوى</label>
                        <textarea
                         id="notes"
                          class="form-control" placeholder="ادخل المحتوى..." name="notes"  required>{{ $new->notes }}</textarea>
                        @error('notes')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                {{-- <div class="mb-3">
                    <label for="formFile" class="form-label">الملف ان وجد</label>
                    <input class="form-control" type="file"  name="photo" id="formFile">
                  </div>
                  @error('photo')
                  <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror --}}
                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn p-3" style="background-color:#7367f0;color:white; ">تعديل</button>
                    <a href="{{ route('admins.index') }}" class="btn btn-danger">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


