<x-layout>
    <div class="max-w-6xl mx-auto space-y-8">
        <div>
            <a href="/" class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-gray-900 transition mb-3">
                <span>←</span> Back to Dashboard
            </a>
            <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Tenant Directory</h2>
            <p class="text-sm text-gray-500 mt-1">Manage permanent house rentees and register new ones.</p>
        </div>

        @if(session('success'))
            <div class="p-4 bg-green-50 border border-green-200 text-green-700 text-sm font-medium rounded-xl shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            {{-- ── TENANT LIST ── --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100/80 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50">
                    <h3 class="font-bold text-gray-900">Active Rentees</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/70 border-b border-gray-100 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                <th class="py-3.5 px-6">Tenant & Profile Details</th>
                                <th class="py-3.5 px-6">Occupants</th>
                                <th class="py-3.5 px-6">Status</th>
                                <th class="py-3.5 px-6 text-right">Registered Date</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-50">
                            @forelse($tenants as $tenant)
                                <tr class="hover:bg-gray-50/50 transition">
                                    <td class="py-4 px-6">
                                        <div class="font-semibold text-gray-900">{{ $tenant->name }}</div>
                                        <div class="text-xs text-gray-500 mt-0.5">{{ $tenant->occupation ?? 'No occupation specified' }}</div>
                                        <div class="text-[11px] text-gray-400 font-mono mt-1">{{ $tenant->address ?? 'No address' }}</div>
                                    </td>
                                    <td class="py-4 px-6 text-gray-700 font-medium">
                                        {{ $tenant->occupants_count ?? 1 }} {{ Str::plural('person', $tenant->occupants_count ?? 1) }}
                                    </td>
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center text-xs font-medium text-green-700 bg-green-50 px-2.5 py-0.5 rounded-full">
                                            Active
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-gray-500 text-right text-xs">
                                        {{ $tenant->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-8 text-center text-gray-400 text-xs">
                                        No tenants registered yet. Use the form to add one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ── ADD TENANT FORM ── --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100/80">
                <h3 class="font-bold text-gray-900 border-b border-gray-50 pb-3 mb-4">Add New Tenant</h3>
                
                <form action="/tenants" method="POST" class="space-y-4">
                    @csrf
                    
                    {{-- Full Name --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Full Name</label>
                        <input type="text" name="name" placeholder="e.g. Juan Dela Cruz" required class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                    </div>

                    {{-- Occupation --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Occupation</label>
                        <input type="text" name="occupation" placeholder="e.g. Software Engineer, Student" class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                    </div>

                    {{-- Number of Occupants --}}
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Total Number of Occupants</label>
                        <input type="number" name="occupants_count" min="1" value="1" required class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                    </div>

                    {{-- Rental Unit Address --}}
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500">Rental Address</label>
                            <span class="text-[10px] text-gray-400 italic">Defaults to home address</span>
                        </div>
                        <textarea name="address" rows="2" placeholder="e.g. 123 Rizal Ave, Caloocan City (or same as your household address)" class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition"></textarea>
                    </div>

                    <button type="submit" class="w-full bg-gray-900 hover:bg-gray-800 text-white text-xs font-semibold py-3 px-4 rounded-xl shadow-sm transition duration-200">
                        + Register Tenant
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>