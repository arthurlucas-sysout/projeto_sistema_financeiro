@if(session('sucess'))
    <p style="color: green">{{ session('sucess') }}</p>

    @elseif (session('erro'))
    <p style="color: red">{{ session('erro') }}</p>
@endif
