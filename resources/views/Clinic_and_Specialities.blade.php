<section class="section section-specialities">

<div class="container-fluid">

<div class="section-header text-center">

<h2>Clinic and Specialities</h2>

<p class="sub-title">
Discover our medical specialities
</p>

</div>

<div class="row justify-content-center">

<div class="col-md-9">

<div class="specialities-slider slider">
@php
  $specialities = isset($doctors)
    ? collect($doctors)->pluck('speciality')->filter()->unique()->take(12)
    : collect();
@endphp

@foreach($specialities as $speciality)
  <div class="speicality-item text-center">
    <div class="speicality-img">
      <img src="{{ asset('front-end/assets/img/specialities/specialities-01.png') }}" class="img-fluid">
      <span><i class="fa fa-circle"></i></span>
    </div>
    <p>{{ $speciality }}</p>
  </div>
@endforeach

</div>

</div>

</div>

</div>

</section>