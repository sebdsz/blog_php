@extends('layouts.master')
@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">

                @include('front.partials.best')
                @include('front.partials.posts')

            </div>
            <div class="col-md-6">
                <ul>
                    <li>php</li>
                    <li>sponsor</li>
                    <li>etc</li>
                    <li>...</li>
                </ul>
            </div>
        </div>
    </div>
@endsection