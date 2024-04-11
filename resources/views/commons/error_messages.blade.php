@if (count($errors) > 0)
    <div class="alert-validate p-1 mb-3" style="background-color: #FF97C2; color: white; text-align: center; border-radius: 10px;">
        <ul style="padding: 0; margin: auto;">
            @foreach ($errors->all() as $error)
                <li><i class="fa-solid fa-triangle-exclamation"></i>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif