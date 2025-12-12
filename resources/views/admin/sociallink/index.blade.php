@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Social Links</h1>
        <div class="flex gap-4">
            <a href="{{ route('dashboard') }}"
                class="px-6 py-3 bg-white border-2 border-gray-200 text-gray-700 hover:bg-gray-50 font-medium rounded-xl transition-all">
                Back
            </a>
            <a href="{{ route('admin.sociallink.create') }}"
                class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-lg shadow-indigo-200 transition-all">
                Add Social Link
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-xl">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($socialLinks as $link)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 flex flex-col h-full">
                <div class="border-b border-gray-100 pb-4 mb-4">
                    <h3 class="text-xl font-bold text-gray-800">{{ $link->platform }}</h3>
                </div>

                <div class="space-y-4 flex-1">
                    <div class="flex items-center justify-between group bg-gray-50 p-3 rounded-xl hover:bg-gray-100 transition-colors">
                        <div>
                            <p class="text-gray-700 font-medium">URL: 
                                <a href="{{ $link->url }}" target="_blank" class="text-blue-600 hover:underline">{{ $link->url }}</a>
                            </p>
                            <p class="text-gray-500">Icon: {{ $link->icon }}</p>
                        </div>
                        <div class="flex gap-2 opacity-100 transition-opacity">
                            <a href="{{ route('admin.sociallink.edit', $link) }}"
                               class="p-2 bg-indigo-100 text-indigo-600 rounded-lg hover:bg-indigo-200 transition-colors"
                               title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </a>
                            <form action="{{ route('admin.sociallink.destroy', $link) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="p-2 bg-red-100 text-red-600 rounded-lg hover:bg-red-200 transition-colors"
                                        onclick="return confirm('Delete this social link?')" title="Delete">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
