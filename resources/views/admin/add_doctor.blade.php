@extends('maindesign')

@section('content')

<div class="container">

<h2>Add Doctor</h2>

<form action="{{ route('store.doctor') }}" method="POST" enctype="multipart/form-data">

@csrf

<div class="form-group">
<label>First Name</label>
<input type="text" name="first_name" class="form-control">
</div>

<div class="form-group">
<label>Last Name</label>
<input type="text" name="last_name" class="form-control">
</div>

<div class="form-group">
<label>Phone</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="form-group">
<label>Speciality</label>
<input type="text" name="speciality" class="form-control">

</div>

<div class="form-group">
<label>Address</label>
<input type="text" name="address_line1" class="form-control">
</div>

<div class="form-group">
<label>Experience (years)</label>
<input type="number" name="experience" class="form-control">
</div>

<div class="form-group">
<label>Description</label>
<textarea name="biography" class="form-control"></textarea>
</div>

<div class="form-group">
<label>Doctor Image</label>
<input type="file" name="image" class="form-control">
</div>

<br>

<button class="btn btn-primary">

Add Doctor

</button>

</form>

</div>

@endsection