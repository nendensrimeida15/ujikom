<!----- pesan  sukses------>

@if(session()->has('success'))
<div class="alert alert-success" role="alert">
    <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{!!session('success')!!}</strong>
</div>
@endif

@if(session()->has('info'))
<div class="alert alert-info" role="alert">
    <button aria-label="Close" class="btn-close" data-bs-dismiss="alert" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>{!!session('info')!!}</strong>
</div>
@endif

@if($errors->any())
<div class="pt-3">
    <div clas="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif