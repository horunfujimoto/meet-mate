@extends('layouts.app')

@section('content')
    <div class="mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="title">投稿関連</h2>
            <div class="d-flex align-items-center">
                <a href="{{ route('posts.create') }}" class="btn btn-hover mx-3" style="background-color: #FF6699; color: white; font-size: 1.2rem;">投稿 <i class="fa-solid fa-pen-nib"></i></a>
            </div>
        </div>
        <div class="row mt-4">
            <div class="py-2">
                @include('posts.nabtabs')
            </div>

            <div class="pt-4">
                {{-- 検索機能 --}}
                <form action="{{ route('posts.index') }}" method="GET" class="ml-auto d-flex align-items-center">
                    <input type="text" name="keyword" value="{{ $keyword }}" placeholder="タイトルのキーワードを入力" class="form-control mr-2" style="width: 15em;">
                    <button type="submit" class="btn btn-hover" style="background-color: #FF6699; color: white; font-size: 1.2rem; margin-top: auto;"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                
                {{-- 投稿一覧 --}}
                @include('posts.posts')
                
            </div>
            
        </div>
    </div>
@endsection