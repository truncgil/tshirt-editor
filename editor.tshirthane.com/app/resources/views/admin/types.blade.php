@extends('admin.master')

@section("title"){{@e2($c->title)}}@endsection
@section("desc",@$c->title." ". __("türüne ait içerikler"))
@section('content')
<?php $slug = str_slug($c->title); ?>
@if(View::exists("admin.type.$slug")) 
		@include("admin.type.$slug")
@else 
	@include("admin.type.default")
@endif
@endsection
