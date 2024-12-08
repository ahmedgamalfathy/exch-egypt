@extends('layouts.master')
@section('title',"تعديل  سياسة خصوصية")
@section('content')
<div class="container pt-5">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <h5 id="AddUserLabel" class="mb-0">تعديل سياسة خصوصية </h5>
        </div>
        <div class="card-body">
            <form class="add-new-user" id="addNewUserForm" action="{{ route('privacy.update', ['id'=> $privacy->id]) }}" method="POST"  >
                @csrf
                @method('PUT')
                <div class="row ">
                    <div class="col-12">
                        <label class="form-label" for="add-user-fullname">المحتوى</label>
                        <input type="text" class="form-control" placeholder="" value="{{  $privacy->title }}" name="title">
                        @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Name Field -->
                    <div class="col-12">
                        <label class="form-label" for="add-user-fullname">المحتوى</label>
                        <textarea
                        type="text"
                        class="form-control"
                        id="add-user-fullname"
                         placeholder="اضف نص"
                         rows="10"
                         name="content" >{{ $privacy->content }} </textarea>
                        @error('content')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2" onclick="return confirm('Are you sure?')">تعديل</button>
                    <a href="{{ route('privacy') }}" class="btn btn-danger">تراجع</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


