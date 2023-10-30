@extends('errors.illustrated-layout')

@section('code', '503 👾')

@section('title', __('Upload In Progress'))

@section('image')
    <div style="background-image: url(https://picsum.photos/seed/picsum/1920/1080);" class="absolute pin bg-no-repeat md:bg-left lg:bg-center bg-cover"></div>
@endsection

@section('message', __('Please standby or contact the website administrator.'))
