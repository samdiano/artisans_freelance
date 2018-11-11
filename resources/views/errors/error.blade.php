
@if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger fade in fadeAlert" data-alert="alert" >
        <a class="close" data-dismiss="alert" href="#">&times;</a>
        {{ $error }}
    </div>
    @endforeach
@endif