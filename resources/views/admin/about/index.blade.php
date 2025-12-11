@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">About</h1>
            <a href="{{ route('admin.about.create') }}"
                class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-200 transition-all">Create</a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Education</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Location</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($abouts as $about)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $about->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $about->education }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $about->email }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $about->location }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.about.edit', $about) }}"
                                    class="inline-block px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm shadow-indigo-200">
                                    Edit
                                </a>
                                <form action="{{ route('admin.about.destroy', $about) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-block px-4 py-2 bg-white border border-red-200 text-red-600 hover:bg-red-50 text-sm font-medium rounded-lg transition-colors"
                                        onclick="return confirm('Delete this entry?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $abouts->links() }}</div>
    </div>
@endsection