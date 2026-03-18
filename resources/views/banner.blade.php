<!-- Banner Section -->
<section class="section section-search">

<div class="container-fluid">

<div class="banner-wrapper text-center">

<h1>Search Doctor, Make an Appointment</h1>

<p>
Find the best doctors and book appointments easily
</p>

<div class="search-box">

<form action="{{ route('doctors') }}" method="GET">

<div class="form-group search-info">

<input type="text"
name="search"
class="form-control"
placeholder="Search doctors or speciality">

</div>

<button type="submit" class="btn btn-primary search-btn">

<i class="fas fa-search"></i>

<span>Search</span>

</button>

</form>

</div>

</div>

</div>

</section>