@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
{{-- @section('message', __('Service Unavailable')) --}}
@section('message', 'Server is at maintenance mode, Sorry for that inconvenience.')
