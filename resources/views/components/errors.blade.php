    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <ul>
                <li style="color: red">{{ $error }}</li>
            </ul>
        @endforeach
    @endif
