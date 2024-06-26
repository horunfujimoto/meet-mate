@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="row justify-content-between align-items-center mb-3">
            <div class="col-auto">
                <h2 class="title">{{ $match_user->name }} さんの詳細ページ</h2>
            </div>
        </div>
        
        <div class="row m-2">
            <div class="col-md-4">
                <div class="mt-4">
                    @if($match_user->image)
                        <img src="/images/{{ $match_user->image }}" alt="{{ $match_user->name }}" class="img-fluid" width="200">
                    @else
                        <img src="/images/no_image.png" alt="No Image" class="img-fluid" width="200">
                    @endif
                    
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="mt-4">
                    <p>名前: {{ $match_user->name }}</p>
                    <p>年齢: {{ $match_user->age }}歳</p>
                    <p>好感度: {{ $match_user->feeling }}%</p>
                    <p>住んでいる場所: {{ $match_user->address }}</p>
                    <p>職業: {{ $match_user->work }}</p>
                    <p>誕生日: {{ $match_user->birthday }}</p>
                    <p>SNS: {{ $match_user->sns }}</p>
                    @if($match_user->way_id == 1)
                        <p>出会い方: {{ $match_user->other_way }}</p>
                    @else
                        <p>出会い方: {{ $way->way }}</p>
                    @endif
                    <p>その他: {{ $match_user->others }}</p>
                </div>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="edit-delete mt-4 text-center">
                    @if (Auth::id() == $match_user->user_id)
                        {{-- 編集ページへのリンク --}}
                        <div class="d-inline-block mr-2">
                            <a class="btn" href="{{ route('match_users.edit', $match_user->id) }}" style="background-color: #FF6699; color: white; font-size: 1.2rem;"><i class="fa-regular fa-pen-to-square"></i></a>
                        </div>
                        {{-- 削除フォーム --}}
                        <div class="d-inline-block mr-2">
                            <form method="POST" action="{{ route('match_users.destroy', $match_user->id) }}" class="my-2">
                                @csrf
                                @method('DELETE')
                                
                                <button type="submit" class="btn" 
                                    onclick="return confirm('出会った方を削除すると関連した投稿も削除されます。\n本当に削除してもよろしいですか？')" style="background-color: #FF6699; color: white; font-size: 1.2rem;"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
    </div>
@endsection