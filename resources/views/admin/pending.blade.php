@extends('layout')

@section('content')
<x-admin-nav />
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">All pending maid requests</h5>

        <br>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Image
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Names
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Gender
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Address
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($data->isEmpty())
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th colspan="6" scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            No data
                        </th>
                    </tr>
                    @else
                    @foreach ($data as $item)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <td class="px-6 py-4">
                            <a href="{{$item->maids->photo}}">
                                <div class="flex-shrink-0">
                                    <img class="w-8 h-8 rounded-full" src="{{$item->maids->photo}}"
                                        alt="{{$item->maids->name}} image">
                                </div>
                            </a>
                        </td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{$item->maids->name}}
                        </th>
                        <td class="px-6 py-4">
                            {{$item->maids->gender}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item->maids->address}}
                        </td>
                        <td class="px-6 py-4">
                            {{$item->maids->price}} Rwf
                        </td>
                        <td class="px-6 py-4">
                            <a href="/admin/request/approve/{{$item->id}}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Approve</a>
                            <a href="/admin/request/reject/{{$item->id}}"
                                class="font-medium text-red-600 dark:text-red-500 hover:underline">Reject</a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop