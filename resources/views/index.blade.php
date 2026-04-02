@extends('maindesign')

@section('content')


@include('banner')
@include('Clinic_and_Specialities', ['doctors' => $doctors ?? [], 'specialties' => $specialties ?? []])

@include('Popular_Section')

@include('Availabe_Features')

@endsection
