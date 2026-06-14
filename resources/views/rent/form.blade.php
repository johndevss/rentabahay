<x-layout>
    <div class="max-w-3xl mx-auto">
        <!-- Back Link -->
        <div class="mb-6">
            <a href="/" class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-gray-900 transition">
                <span>←</span> Back to Dashboard
            </a>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100/80">
            <!-- Header -->
            <div class="mb-8 border-b border-gray-50 pb-5">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">Create New Statement</h2>
                <p class="text-xs text-gray-400 mt-1">Rentabahay Smart Calculator: Computes utility shares based on sub-meters and equal splits.</p>
            </div>
            
            <form action="/generate-receipt" method="POST" class="space-y-8">
                @csrf 

                <!-- Section 1: Tenant & Core Details -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-4 block border-b border-blue-50 pb-1">1. Tenant & Core Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Select Active Tenant</label>
                            <div class="relative">
                                <select name="tenant_id" required class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition appearance-none">
                                    <option value="" disabled selected>-- Choose from your active tenants --</option>
                                    @foreach($tenants as $tenant)
                                        <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Base Rent (PHP)</label>
                            <input type="number" name="base_rent" value="5000" required class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 mb-2">Billing Month</label>
                            <input type="month" name="billing_month" required class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        </div>
                    </div>
                </div>

                <!-- Section 2: Meralco Sub-meter Calculator -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-amber-600 mb-4 block border-b border-amber-50 pb-1">2. Meralco Sub-Meter (Kuntador)</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-2">Total Meralco Bill (PHP)</label>
                            <input type="number" step="0.01" name="meralco_total_bill" placeholder="0.00" required
                                class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                            <span class="text-[10px] text-gray-400 mt-1 block">Grand total on the paper bill (for reference).</span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-2">Rate per kWh (PHP)</label>
                            <input type="number" step="0.0001" name="meralco_rate_per_kwh" placeholder="e.g. 12.3456" required
                                class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                            <span class="text-[10px] text-gray-400 mt-1 block">Found on the Meralco bill breakdown.</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-2">Previous Sub-Meter Reading (kWh)</label>
                            <input type="number" step="0.1" name="tenant_prev_reading" placeholder="e.g. 1240.5" required
                                class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                            <span class="text-[10px] text-gray-400 mt-1 block">Last month's reading from the sub-meter.</span>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-500 mb-2">Current Sub-Meter Reading (kWh)</label>
                            <input type="number" step="0.1" name="tenant_curr_reading" placeholder="e.g. 1285.7" required
                                class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                            <span class="text-[10px] text-gray-400 mt-1 block">This month's reading from the sub-meter.</span>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Maynilad 50/50 Split -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-cyan-600 mb-4 block border-b border-cyan-50 pb-1">3. Maynilad Water (Divided into 2)</h3>
                    <div class="max-w-md">
                        <label class="block text-xs font-bold text-gray-500 mb-2">Total Maynilad Water Bill (PHP)</label>
                        <div class="relative">
                            <input type="number" step="0.01" name="maynilad_total_bill" placeholder="0.00" required class="w-full px-4 py-2.5 bg-gray-50/50 border border-gray-200 rounded-xl shadow-sm text-sm text-gray-900 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        </div>
                        <span class="text-[11px] text-gray-400 mt-1.5 block">System will automatically divide this by 2 for the tenant statement.</span>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="pt-4 border-t border-gray-50 flex justify-end">
                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-3 px-6 rounded-xl shadow-md shadow-blue-500/10 transition duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Calculate & Generate Statement
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>