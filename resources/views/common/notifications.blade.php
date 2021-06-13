@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <div class="container">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
    <div class="container">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
    <div class="container">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
</div>
@endif