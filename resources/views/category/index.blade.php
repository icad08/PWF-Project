<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Category List</h2>
                        <p class="text-sm text-gray-500">Manage your category</p>
                    </div>
                    <a href="{{ route('category.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium">
                        + Add Category
                    </a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto border rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">#</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-300">Name</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-300">Total Product</th>
                                <th class="px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-300">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 text-sm font-medium">{{ $category->name }}</td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        <span class="px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800 text-xs font-semibold">
                                            {{ $category->products_count }} Products
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('category.edit', $category->id) }}" class="text-amber-600 hover:underline">Edit</a>
                                            <form action="{{ route('category.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>