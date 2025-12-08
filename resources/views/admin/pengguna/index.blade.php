@extends('layouts.app')

@section('title', 'Pengguna') @section('subtitle', '')

@section('content')
    <div class="bg-white rounded-xl shadow-[0_2px_10px_-3px_rgba(6,81,237,0.1)] border border-gray-100 p-6">
        
        <div class="mb-6">
            <div class="relative w-full max-w-md">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" 
                       class="w-full border border-gray-200 rounded-lg py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" 
                       placeholder="Input">
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100 text-xs text-gray-500 uppercase font-semibold tracking-wider">
                        <th class="p-4 w-10 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </th>
                        <th class="p-4">Name</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="p-4 text-gray-700 font-medium">John Brown</td>
                        <td class="p-4 text-gray-500">johnbrown@gmail.com</td>
                        <td class="p-4 text-green-500 font-medium text-sm">Active</td>
                        <td class="p-4">
                            <button class="text-red-500 hover:text-red-700 text-sm font-medium transition">Delete</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="p-4 text-gray-700 font-medium">Jim Green</td>
                        <td class="p-4 text-gray-500">jimgreen@gmail.com</td>
                        <td class="p-4 text-green-500 font-medium text-sm">Active</td>
                        <td class="p-4">
                            <button class="text-red-500 hover:text-red-700 text-sm font-medium transition">Delete</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="p-4 text-gray-700 font-medium">Joe Black</td>
                        <td class="p-4 text-gray-500">joeblack@gmail.com</td>
                        <td class="p-4 text-green-500 font-medium text-sm">Active</td>
                        <td class="p-4">
                            <button class="text-red-500 hover:text-red-700 text-sm font-medium transition">Delete</button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 transition">
                        <td class="p-4 text-center">
                            <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        </td>
                        <td class="p-4 text-gray-700 font-medium">Edward King</td>
                        <td class="p-4 text-gray-500">edwardking@gmail.com</td>
                        <td class="p-4 text-green-500 font-medium text-sm">Active</td>
                        <td class="p-4">
                            <button class="text-red-500 hover:text-red-700 text-sm font-medium transition">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection