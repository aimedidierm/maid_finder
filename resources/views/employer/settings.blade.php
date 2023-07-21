@extends('layout')

@section('content')
<x-employer-nav />
<div class="p-4 sm:ml-64">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">Update your details</h5>
        <div class="max-w-full mx-auto bg-white rounded p-6 shadow-md">
            <form>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" id="name" name="name"
                        class="w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Enter your name" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Enter your email" required>
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 font-bold mb-2">Address</label>
                    <textarea id="address" name="address"
                        class="w-full border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Enter your address" required></textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Update
                        Details</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop