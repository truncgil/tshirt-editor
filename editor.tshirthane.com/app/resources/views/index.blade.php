<?php 
$title = env("APP_NAME");
$description = env("APP_DESCRIPTION");
$keywords = env("APP_KEYWORDS");

?>

@extends('admin.master')

@section("title",$title)
@section("description",$description)
@section("keywords",$keywords)


@section('content')
<div id="page-container" class="sidebar-o enable-page-overlay side-scroll page-header-fixed side-trans-enabled">
    @include("partials.header")
        @include("admin.type.editor")
    @include("partials.footer")
</div>

<style>
    .sablon-sec {
        margin-top:75px;
    }
</style>

@endsection

