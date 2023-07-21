@extends('layout')

@section('content')
<x-employer-nav />
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Available maids for you</h5>
        <div class="p-2">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach ($data as $item)
                <div
                    class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{$item->photo}}">
                        <img class="p-8 rounded-t-lg" src="{{$item->photo}}" alt="{{$item->name}} image" />
                    </a>
                    <div class="px-5 pb-5">
                        <div class="flex items-center justify-between">
                            <a href="#">
                                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{$item->name}}
                                </h5>
                                <h5 class="text-m font-semibold tracking-tight text-gray-900 dark:text-white">Gender:
                                    {{$item->gender}}
                                </h5>
                            </a>
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">{{$item->price}} Rwf</span>
                        </div>
                        <div class="flex items-center mt-2.5 mb-5">
                            <p class="font-bold text-gray-900 dark:text-white">
                                {{$item->description}}
                            </p>
                        </div>
                        <div class="flex items-center justify-between">
                            <button type="button" data-modal-target="defaultModal" data-modal-toggle="defaultModal"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Hire</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop