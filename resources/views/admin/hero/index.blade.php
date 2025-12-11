@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Hero</h1>
            @if($heroes->isEmpty())
                <a href="{{ route('admin.hero.create') }}"
                    class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-200 transition-all">
                    Create Hero
                </a>
            @endif
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl">{{ session('success') }}</div>
        @endif

        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-700">
                    <tr>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Subtitle</th>
                        <th class="px-6 py-4 font-semibold text-sm uppercase tracking-wider">Profile Image</th>
                        <th class="px-6 py-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($heroes as $hero)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-gray-800 font-medium">{{ $hero->title }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $hero->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ \Illuminate\Support\Str::limit($hero->subtitle, 40) }}</td>
                            <td class="px-6 py-4">
                                @if($hero->profile_image)
                                    <img src="{{ asset('storage/' . $hero->profile_image) }}" alt="hero"
                                        class="w-12 h-12 object-cover rounded-full border-2 border-white shadow-sm" />
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.hero.edit', $hero) }}"
                                    class="inline-block px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm shadow-indigo-200">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection