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


@include("admin.type.editor")


@endsection

