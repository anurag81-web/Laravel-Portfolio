@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Edit Skill</h1>

        @if($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.skill.update', $skill) }}" method="POST"
            class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Name</label>
                <input type="text" name="name" value="{{ old('name', $skill->name) }}"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 bg-gray-50 transition-colors outline-none"
                    required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-bold text-gray-700">Skills (e.g. PHP, Python, Java)</label>
                <textarea name="skill_name"
                    class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 focus:border-indigo-500 focus:ring-0 bg-gray-50 transition-colors outline-none"
                    rows="3" required>{{ old('skill_name', $skill->skill_name) }}</textarea>
            </div>

            <div class="flex items-center gap-4 mt-8 pt-6 border-t border-gray-100">
                <button
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-200 transition-all">Update</button>
                <a href="{{ route('admin.skill.index') }}"
                    class="px-6 py-3 bg-white border-2 border-gray-200 text-gray-700 hover:bg-gray-50 font-medium rounded-xl transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection