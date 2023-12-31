@extends('layout')

@section('content')
<x-employer-nav />
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Available maids for you</h5>
        <div class="p-2">

            @if($errors->any())<span style="color: red;"> {{$errors->first()}}</span> <br>@endif
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
                                onclick="hire('{{ $item->id }}')"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Hire</button>
                        </div>
                    </div>
                </div>
                @endforeach
                <div id="defaultModal" tabindex="-1" aria-hidden="true"
                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    You want to hire this maid?
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-hide="defaultModal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <div class="p-6 space-y-6">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Service fee is 100 Rwf
                                </h3>
                                <form class="space-y-6" action="/employer" method="POST">
                                    @csrf
                                    <div>
                                        <input type="hidden" name="maid" id="maidId" required>
                                    </div>
                                    <div>
                                        <label for="phone"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Billing
                                            phone number</label>
                                        <input type="text" name="phone" id="phone"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Enter your phone" required>
                                    </div>
                                    <div>
                                        <label for="description"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                        <textarea type="text" name="description" id="description"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Can you provide small description" required></textarea>
                                    </div>
                                    <button type="submit"
                                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send
                                        request</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function hire(item) {
        var maidId = document.getElementById('maidId');
        maidId.value = item;
    }
</script>
@stop