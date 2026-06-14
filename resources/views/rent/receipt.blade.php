<x-layout>
    <div class="bg-white p-10 rounded-xl shadow-lg border border-gray-200 relative">
        
        <button onclick="window.print()" class="absolute top-6 right-6 bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded shadow-sm text-sm print:hidden">
            Print / Save PDF
        </button>

        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Monthly Rent Statement</h2>
            <p class="text-gray-500">Billing Period: <span class="font-semibold text-gray-700">{{ $receipt->billing_month }}</span></p>
        </div>

        <div class="space-y-4 mb-8">
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Base Rent</span>
                <span class="font-medium">PHP {{ number_format($receipt->base_rent, 2) }}</span>
            </div>
            
            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Electricity (Meralco)</span>
                <span class="font-medium">PHP {{ number_format($receipt->meralco_bill, 2) }}</span>
            </div>

            <div class="flex justify-between border-b pb-2">
                <span class="text-gray-600">Water (Maynilad)</span>
                <span class="font-medium">PHP {{ number_format($maynilad_bill, 2) }}</span>
            </div>
        </div>

        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-lg">
            <span class="text-lg font-bold text-gray-700">Total Amount Due</span>
            <span class="text-2xl font-bold text-blue-600">PHP {{ number_format($receipt->total_due, 2) }}</span>
        </div>

        <div class="mt-8 text-sm text-gray-400 text-center">
            <p>Please provide the payment on or before the agreed due date. Thank you!</p>
        </div>
    </div>
</x-layout>