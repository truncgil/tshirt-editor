<?php use App\Contents; ?>
@if(isset($c)) 
	
@extends('layouts.app')
@section("title",__($c->title))
@section('content')
<?php $slug = str_slug($c->type); ?>
<?php 

if($c->cover == "") {
	$pic = url('assets/images/banner-bg.jpg');
} else {
	$pic = url('cache/large/'.$c->cover);
} 
$bc = str_replace("Menü / ","",$c->breadcrumb);
$bc = explode(" / ",$bc);
$ust = Contents::where("slug",$c->kid)->first();
$j = j($c->json);


?>
@if(View::exists("types.$slug"))
	@include("types.$slug")
@elseif(View::exists("pages.".$c->slug))
	@include("pages.".$c->slug)
@else
	
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1>{{$c->title}}</h1>
				<?php echo $c->html ?>
			</div>
		</div>
		
	</div>
@endif 
@endsection
@else 
	
@endif