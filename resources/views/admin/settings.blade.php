@extends('layout')

@section('content')
<x-admin-nav />
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Update your details</h5>
        <br>
        @if($errors->any())
        <span style="color: red;">{{$errors->first()}}</span>
        @endif
        @csrf
        <form action="/admin/settings/{{$data->id}}" method="POST">
            <input type="text" name="name" value="{{$data->name}}" id="">
            <input type="text" name="address" value="{{$data->address}}" id="">
            <input type="text" name="phone" value="{{$data->phone}}" id="">
            <input type="text" name="email" value="{{$data->email}}" id="">
            <input type="password" name="password" id="">
            <input type="password" name="confirmPassword" id="">
            <button type="submit"> Send</button>
        </form>
    </div>
</div>
@stop