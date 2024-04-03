@extends('layouts.app')

@section('content')
<div class="mx-auto">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="title">ユーザー関連</h2>
    </div>
    <div class="row mt-4">
        <div class="py-2">
            @include('users.nabtabs')
        </div>
        <div class="pt-4">
            <form action="{{ route('users.index') }}" method="GET" class="ml-auto d-flex align-items-center">
                <div class="col-auto">
                    <input type="text" name="keyword" value="{{ $keyword }}" placeholder="ユーザー名を入力" class="form-control mr-2" style="width: 15em;">
                </div>
                <button type="submit" class="btn btn-hover" style="background-color: #FF6699; color: white; font-size: 1.2rem; margin-top: auto;"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            @include('users.users')
        </div>
        
    </div>
</div>
@endsection
