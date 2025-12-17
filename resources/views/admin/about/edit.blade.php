@extends('layouts.app')


@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Edit About Section</h1>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        

        <form action="{{ route('admin.about.update', $about) }}" method="POST" enctype="multipart/form-data"
            class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $about->name) }}"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 bg-gray-50 transition-colors outline-none"
                    required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Description</label>
                <textarea name="description"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 bg-gray-50 transition-colors outline-none"
                    rows="4" required>{{ old('description', $about->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Education</label>
                <input type="text" name="education" value="{{ old('education', $about->education) }}"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 bg-gray-50 transition-colors outline-none">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email', $about->email) }}"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 bg-gray-50 transition-colors outline-none">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Location</label>
                <input type="text" name="location" value="{{ old('location', $about->location) }}"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 bg-gray-50 transition-colors outline-none">
            </div>

            <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                <button
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-200 transition-all">Update</button>
                <a href="{{ route('dashboard') }}"
                    class="px-6 py-3 bg-white border-2 border-gray-200 text-gray-700 hover:bg-gray-50 font-medium rounded-xl transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection