@extends('layouts.app')

@section('title', 'Pengguna') @section('subtitle', '')

@section('content')
    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 p-6">

        <div class="mb-6">
            <div class="flex justify-between items-center">
                <div class="relative w-full max-w-md">
                    <form method="GET" action="{{ route('pengguna.index') }}" class="flex">
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full border border-gray-200 rounded-lg py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition"
                                placeholder="Cari nama atau email...">
                        </div>
                        @if (request('search'))
                            <a href="{{ route('pengguna.index') }}"
                                class="ml-2 px-3 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                                <i class="fa-solid fa-times"></i>
                            </a>
                        @endif
                    </form>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-700 ml-4">
                    <i class="fa-solid fa-plus mr-1"></i> <a href="{{ route('pengguna.create') }}"
                        class="text-white no-underline">Tambah User</a>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr
                        class="bg-gray-50/50 border-b border-gray-100 text-xs text-gray-500 uppercase font-semibold tracking-wider">
                        {{-- <th class="p-4 w-10 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th> --}}
                        <th class="p-4">Name</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    {{-- <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="p-4 text-gray-700 font-medium">John Brown</td>
                        <td class="p-4 text-gray-500">johnbrown@gmail.com</td>
                        <td class="p-4 text-green-500 font-medium text-sm">Active</td>
                        <td class="p-4">
                            <button class="text-red-500 hover:text-red-700 text-sm font-medium transition">Delete</button>
                        </td>
                    </tr> --}}

                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-4 text-gray-700 font-medium">{{ $user->name }}</td>
                            <td class="p-4 text-gray-500">{{ $user->email }}</td>
                            <td class="p-4">
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full
                                    {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('pengguna.edit', $user->id) }}"
                                        class="text-blue-500 hover:text-blue-700 text-sm font-medium transition">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i>Edit
                                    </a>
                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('pengguna.destroy', $user->id) }}" method="POST"
                                            style="display: inline-block;"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 text-sm font-medium transition">
                                                <i class="fa-solid fa-trash mr-1"></i>Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-sm font-medium">
                                            <i class="fa-solid fa-user-shield mr-1"></i>Akun Anda
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach






                </tbody>
            </table>
        </div>

        @if ($users->hasPages())
            <div class="mt-6">
                {{ $users->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
@endsection
