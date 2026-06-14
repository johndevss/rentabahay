<x-layout>
    <div class="space-y-8 p-6 max-w-7xl mx-auto bg-gray-50/30 rounded-2xl">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Welcome back!</h2>
                <p class="text-sm text-gray-500 mt-1">Here's the latest overview of your rental property business.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-100/80 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Last Rent Collected</span>
                        <div class="p-2 bg-green-50 rounded-lg text-green-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                    <span class="text-3xl font-bold text-gray-900 tracking-tight">PHP {{ number_format($last_rent ?? 0, 2) }}</span>
                </div>
                <div class="flex items-center gap-1.5 mt-4 text-xs font-medium text-green-600 bg-green-50 w-fit px-2.5 py-1 rounded-full">
                    <span>↑</span> Paid on time
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100/80 shadow-sm hover:shadow-md transition duration-300 flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Avg. Monthly Utilities</span>
                        <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                    <span class="text-3xl font-bold text-gray-900 tracking-tight">PHP {{ number_format($avg_utilities ?? 0, 2) }}</span>
                </div>
                <span class="text-xs text-gray-400 mt-4 block">Calculated from recent receipts</span>
            </div>

            <div class="bg-white p-6 rounded-2xl border-2 border-dashed border-gray-200 shadow-sm flex flex-col justify-center items-center text-center p-6">
                <div class="mb-3 p-3 bg-gray-50 rounded-full text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <h3 class="text-sm font-semibold text-gray-800 mb-1">Ready for this month?</h3>
                <p class="text-xs text-gray-400 mb-4">Generate a brand new tenant record.</p>
                <a href="/form" class="w-full sm:w-auto bg-gray-900 hover:bg-gray-800 text-white text-xs font-semibold py-2.5 px-5 rounded-xl shadow-sm transition duration-200">
                    Create New Receipt
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
            <div class="px-6 py-5 flex items-center justify-between border-b border-gray-50">
                <div>
                    <h3 class="text-lg font-bold text-gray-900">Recent Receipts</h3>
                    <p class="text-xs text-gray-400 mt-0.5">A history of statements generated lately</p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/70 border-b border-gray-100 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                            <th class="py-3.5 px-6">Billing Month</th>
                            <th class="py-3.5 px-6">Base Rent</th>
                            <th class="py-3.5 px-6">Utilities</th>
                            <th class="py-3.5 px-6">Total Due</th>
                            <th class="py-3.5 px-6 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-50">
                        @forelse ($recent_receipts ?? [] as $receipt)
                        <tr class="hover:bg-gray-50/60 transition duration-150">
                            <td class="py-4 px-6">
                                <span class="font-semibold text-gray-900">{{ $receipt->month }}</span>
                            </td>
                            <td class="py-4 px-6 text-gray-500">PHP {{ number_format($receipt->base_rent, 2) }}</td>
                            <td class="py-4 px-6 text-gray-500">PHP {{ number_format($receipt->utilities_total, 2) }}</td>
                            <td class="py-4 px-6">
                                <span class="font-bold text-gray-900">PHP {{ number_format($receipt->total, 2) }}</span>
                            </td>
                            <td class="py-4 px-6 text-right">
                                <a href="/receipt/{{ $receipt->id }}" class="inline-flex items-center justify-center text-xs font-semibold text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded-lg transition duration-150">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center">
                                <div class="max-w-sm mx-auto flex flex-col items-center">
                                    <p class="text-sm font-medium text-gray-900">No receipts generated yet</p>
                                    <p class="text-xs text-gray-400 mt-1 mb-4">Click "Create New Receipt" above to get started.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>