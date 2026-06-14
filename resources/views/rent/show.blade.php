<x-layout>
    <div class="max-w-3xl mx-auto space-y-6">
        <div class="flex items-center justify-between no-print">
            <a href="/" class="inline-flex items-center gap-2 text-xs font-semibold text-gray-500 hover:text-gray-900 transition">
                <span>←</span> Back to Dashboard
            </a>
            
            <button onclick="window.print()" class="inline-flex items-center gap-2 bg-gray-900 hover:bg-gray-800 text-white text-xs font-semibold py-2 px-4 rounded-xl shadow-sm transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print Receipt
            </button>
        </div>

        <div class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100/80 relative overflow-hidden print:border-0 print:shadow-none">
            
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-blue-500 to-indigo-600"></div>

            <div class="flex flex-col sm:flex-row justify-between items-start gap-4 border-b border-gray-100 pb-8">
                <div>
                    <h1 class="text-2xl font-black text-gray-900 tracking-tight">renta<span class="text-blue-600 font-medium">bahay</span></h1>
                    <p class="text-xs text-gray-400 mt-1">Official Rent & Utility Statement</p>
                </div>
                <div class="sm:text-right">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400">Billing Period</span>
                    <h2 class="text-lg font-bold text-gray-900 mt-0.5">{{ $receipt->month }}</h2>
                    <p class="text-xs text-gray-500">Issued: {{ $receipt->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 py-8 border-b border-gray-100">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 block mb-1">Billed To:</span>
                    <h3 class="text-base font-bold text-gray-900">{{ $receipt->tenant->name }}</h3>
                    <p class="text-xs text-gray-500 mt-0.5">Primary House Rentee</p>
                </div>
                <div class="sm:text-right">
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-400 block mb-1">Statement ID:</span>
                    <span class="text-sm font-mono font-bold text-gray-700">#RBN-{{ str_pad($receipt->id, 5, '0', STR_PAD_LEFT) }}</span>
                </div>
            </div>

            <div class="py-8">
                <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400 mb-4">Charge Breakdown</h4>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2">
                        <div>
                            <p class="text-sm font-bold text-gray-900">Base House Rent</p>
                            <p class="text-xs text-gray-400">Fixed monthly space allocation agreement</p>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">PHP {{ number_format($receipt->base_rent, 2) }}</span>
                    </div>

                    <div class="flex justify-between items-start py-2 border-t border-gray-50 pt-4">
                        <div>
                            <p class="text-sm font-bold text-gray-900">Meralco Power Share (Sub-meter)</p>
                            <p class="text-xs text-gray-400 mt-0.5 max-w-md leading-relaxed">
                                Computed from sub-meter: <span class="font-medium text-gray-700">{{ $receipt->tenant_kuntador_kwh }} kWh</span> 
                                out of <span class="font-medium text-gray-700">{{ $receipt->meralco_main_kwh }} kWh</span> total household consumption 
                                (Total Paper Bill: PHP {{ number_format($receipt->meralco_total_bill, 2) }})
                            </p>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">PHP {{ number_format($receipt->meralco_bill, 2) }}</span>
                    </div>

                    <div class="flex justify-between items-start py-2 border-t border-gray-50 pt-4">
                        <div>
                            <p class="text-sm font-bold text-gray-900">Maynilad Water Share (50/50 Split)</p>
                            <p class="text-xs text-gray-400 mt-0.5">
                                Evenly divided by 2 (Total Paper Bill: PHP {{ number_format($receipt->maynilad_total_bill, 2) }})
                            </p>
                        </div>
                        <span class="text-sm font-semibold text-gray-900">PHP {{ number_format($receipt->maynilad_bill, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="mt-4 bg-gray-50 rounded-2xl p-6 flex justify-between items-center border border-gray-100">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-gray-500 block">Total Due Amount</span>
                    <span class="text-[11px] text-green-600 font-medium mt-0.5 block">Status: Pending Payment</span>
                </div>
                <div class="text-right">
                    <span class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">
                        PHP {{ number_format($receipt->total, 2) }}
                    </span>
                </div>
            </div>

            <div class="mt-16 pt-8 border-t border-gray-100 grid grid-cols-2 gap-8 text-center text-xs text-gray-400">
                <div>
                    <div class="h-12 border-b border-gray-200/60 max-w-[180px] mx-auto mb-2"></div>
                    <p>Prepared By (Landlord)</p>
                </div>
                <div>
                    <div class="h-12 border-b border-gray-200/60 max-w-[180px] mx-auto mb-2"></div>
                    <p>Received By (Tenant)</p>
                </div>
            </div>

        </div>
    </div>

    <style>
        @media print {
            .no-print { display: none !important; }
            body { background-color: #ffffff !important; padding: 0 !important; }
        }
    </style>
</x-layout>