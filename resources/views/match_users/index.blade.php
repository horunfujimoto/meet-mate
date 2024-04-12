@extends('layouts.app')

@section('content')
    <div class="mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="title">出会った方の一覧</h2>
            <a href="{{ route('match_users.create') }}" class="btn btn-hover" style="background-color: #FF6699; color: white; font-size: 1.2rem;">登録 <i class="fa-solid fa-pen-nib"></i></a>
        </div>
        
        <!-- PC用のスタイル -->
        <div class="row mt-4 d-none d-md-block">
            <table class="table table-bordered">
                <div class="py-2">
                    <thead style="background-color: #FFCCCC;">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">出会った方</th>
                            <th class="border border-gray-300 px-4 py-2">年齢</th>
                            <th class="border border-gray-300 px-4 py-2">住んでる場所</th>
                            <th class="border border-gray-300 px-4 py-2">出会い方</th>
                            <th class="border border-gray-300 px-4 py-2">画像</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($match_users as $match_user)
                        <tr onclick="window.location='{{ route('match_users.show', $match_user->id) }}';" style="cursor:pointer;">
                            <td class="border border-gray-300 px-4 py-2">{{ $match_user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $match_user->age }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $match_user->address }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @foreach($ways as $way)
                                    @if($way->id === $match_user->way_id)
                                        @if($match_user->way_id == 1)
                                            {{ $match_user->other_way }}
                                        @else
                                            {{ $way->way }}
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if($match_user->image)
                                    <img src="/images/{{ $match_user->image }}" alt="{{ $match_user->name }}" width="50" height="auto">
                                @else
                                    <img src="/images/no_image.png" alt="No Image" width="50" height="auto">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </div>
            </table>
        </div>
        
        <!-- スマートフォン用のスタイル -->
        <div class="row mt-4 d-md-none">
            @foreach($match_users as $match_user)
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header" style="background-color: #FFCCCC;">
                        出会った方: {{ $match_user->name }}
                    </div>
                    <div class="card-body">
                        <p class="card-text">年齢: {{ $match_user->age }}</p>
                        <p class="card-text">住んでる場所: {{ $match_user->address }}</p>
                        <p class="card-text">出会い方: 
                            @foreach($ways as $way)
                                @if($way->id === $match_user->way_id)
                                    @if($match_user->way_id == 1)
                                        {{ $match_user->other_way }}
                                    @else
                                        {{ $way->way }}
                                    @endif
                                @endif
                            @endforeach
                        </p>
                        <div class="text-center">
                            @if($match_user->image)
                                <img src="/images/{{ $match_user->image }}" alt="{{ $match_user->name }}" width="100" height="auto">
                            @else
                                <img src="/images/no_image.png" alt="No Image" width="100" height="auto">
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-muted" style="cursor:pointer;" onclick="window.location='{{ route('match_users.show', $match_user->id) }}';">
                        タップして詳細を表示
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
    </div>
@endsection
