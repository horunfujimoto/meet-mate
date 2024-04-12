@extends('layouts.app')

@section('content')
    <div class="mx-auto">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="title">出会った方の一覧</h2>
            <a href="{{ route('match_users.create') }}" class="btn btn-hover" style="background-color: #FF6699; color: white; font-size: 1.2rem;">登録 <i class="fa-solid fa-pen-nib"></i></a>
        </div>
        
        <!-- コントローラー内のindexアクションでフォームをPOSTするためのフォームを設置 -->
        <form id="sortForm" action="{{ route('match_users.index') }}" method="GET">
            <label for="feeling" class="label">
                <span class="label-text">好感度での並び替え:</span>
            </label>
            <select name="feeling" id="feeling" class="input input-bordered">
                <option value="1" {{ $select == '1' ? 'selected': '' }}>登録順</option>
                <option value="2" {{ $select == '2' ? 'selected': '' }}>好感度が低い順</option>
                <option value="3" {{ $select == '3' ? 'selected': '' }}>好感度が高い順</option>
            </select>
        </form>
        
        <!-- PC用のスタイル -->
        <div class="row mt-4 d-none d-md-block">
            <table class="table table-bordered">
                <div class="py-2">
                    <thead style="background-color: #FFCCCC;">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">出会った方</th>
                            <th class="border border-gray-300 px-4 py-2">年齢</th>
                            <th class="border border-gray-300 px-4 py-2">好感度</th>
                            <th class="border border-gray-300 px-4 py-2">出会い方</th>
                            <th class="border border-gray-300 px-4 py-2">画像</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($match_users as $match_user)
                        <tr onclick="window.location='{{ route('match_users.show', $match_user->id) }}';" style="cursor:pointer;">
                            <td class="border border-gray-300 px-4 py-2">{{ $match_user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $match_user->age }}歳</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $match_user->feeling }}％</td>
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
    
<script>
    // セレクトボックスの要素を取得
    var selectBox = document.getElementById('feeling');
    
    // セレクトボックスの値が変更されたときに呼び出される関数を定義
    function handleChange() {
        document.getElementById('sortForm').submit();
    }
    
    // イベントリスナーを追加して、セレクトボックスの値が変更されたときに関数が呼び出されるようにする
    selectBox.addEventListener('change', handleChange);

</script>
    
@endsection

