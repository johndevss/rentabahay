<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Receipt;
use Illuminate\Http\Request;

class RentController extends Controller
{
 
    public function tenantIndex()
    {
        $tenants = Tenant::latest()->get();
        return view('rent.tenants', compact('tenants'));
    }

    /**
     * Save a newly registered tenant
     */
    public function tenantStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tenants,name', // Prevents duplicate name records
        ]);

        Tenant::create($validated);

        return redirect('/tenants')->with('success', 'New tenant registered successfully!');
    }

    public function profileEdit()
    {
        // Grab the single profile row, or return an empty model if none exists yet
        $profile = \App\Models\LandlordProfile::first() ?? new \App\Models\LandlordProfile();

        return view('rent.profile', compact('profile'));
    }

    public function profileUpdate(Request $request)
    {
        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'contact_number' => 'required|string|max:50',
            'email'          => 'required|email|max:255',
        ]);

        // id: 1 means "always update the same single row, create it if first time"
        \App\Models\LandlordProfile::updateOrCreate(['id' => 1], $validated);

        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }

    public function index()
    {
        $latestReceipt = Receipt::latest()->first();
        $last_rent = $latestReceipt ? $latestReceipt->total : 0;

        $receiptsCollection = Receipt::all();
        $avg_utilities = $receiptsCollection->avg(function ($receipt) {
            return $receipt->utilities_total; // Forces Laravel to compute the accessor for every row
        }) ?? 0;

        $recent_receipts = Receipt::latest()->take(10)->get();

        return view('rent.dashboard', compact('last_rent', 'avg_utilities', 'recent_receipts'));
    }


    public function create()
    {
        // Fetch only currently renting people to populate our dropdown select option
        $tenants = Tenant::where('is_active', true)->get();

        return view('rent.form', compact('tenants'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_id'           => 'required|exists:tenants,id', // Checks if ID is real in MySQL
            'base_rent'           => 'required|numeric|min:0',
            'billing_month'       => 'required|string',
            'meralco_total_bill'  => 'required|numeric|min:0',
            'meralco_main_kwh'    => 'required|numeric|min:0',
            'tenant_kuntador_kwh' => 'required|numeric|min:0',
            'maynilad_total_bill' => 'required|numeric|min:0',
        ]);

        Receipt::create($validated);

        return redirect('/')->with('success', 'Statement receipt generated successfully!');
    }

   public function show(string $id)
    {
        $receipt = Receipt::findOrFail($id);
        $profile = \App\Models\LandlordProfile::first();

        return view('rent.show', compact('receipt', 'profile'));
    }

    public function edit(string $id)
    {
        // Fetch the record to populate an edit form layout
        $receipt = Receipt::findOrFail($id);
        
        return view('rent.edit', compact('receipt'));
    }


    public function update(Request $request, string $id)
    {
        $receipt = Receipt::findOrFail($id);

        $validated = $request->validate([
            'base_rent'           => 'required|numeric|min:0',
            'billing_month'       => 'required|string',
            'meralco_total_bill'  => 'required|numeric|min:0',
            'meralco_main_kwh'    => 'required|numeric|min:0',
            'tenant_kuntador_kwh' => 'required|numeric|min:0',
            'maynilad_total_bill' => 'required|numeric|min:0',
        ]);

        $receipt->update($validated);

        return redirect('/')->with('success', 'Receipt updated successfully!');
    }

    public function destroy(string $id)
    {
        $receipt = Receipt::findOrFail($id);
        $receipt->delete();

        return redirect('/')->with('success', 'Receipt entry deleted.');
    }
}