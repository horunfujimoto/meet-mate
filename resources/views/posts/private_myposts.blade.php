@extends('layouts.app')

@section('content')
    <div class="mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="title">投稿一覧</h2>
            <div class="d-flex align-items-center">
                <a href="{{ route('posts.create') }}" class="btn btn-hover mx-3" style="background-color: #FF6699; color: white; font-size: 1.2rem;">投稿 <i class="fa-solid fa-pen-nib"></i></a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="py-2">
                @include('posts.nabtabs')
            </div>

            <div class="pt-4">
        
                {{-- 投稿一覧 --}}
                @include('posts.posts')
                
            </div>
            
        </div>
    </div>
@endsection