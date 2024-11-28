@extends('layouts.home')

@section('content')
    <h3 class="flex justify-center text-3xl font-bold">Selamat datang {{ auth()->user()->name }} di website distribusi klpcm
    </h3>
@endsection
