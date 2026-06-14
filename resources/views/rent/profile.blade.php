<x-layout>
    <div class="bg-white p-10 rounded-xl shadow-lg border border-gray-200">

        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Landlord Profile</h2>
            <p class="text-gray-500 text-sm mt-1">This information will appear on every generated receipt.</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="/profile" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input 
                    type="text" 
                    name="full_name" 
                    value="{{ old('full_name', $profile->full_name) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="e.g. Juan Dela Cruz"
                >
                @error('full_name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                <input 
                    type="text" 
                    name="address" 
                    value="{{ old('address', $profile->address) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="e.g. 123 Rizal St., Caloocan City"
                >
                @error('address')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                <input 
                    type="text" 
                    name="contact_number" 
                    value="{{ old('contact_number', $profile->contact_number) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="e.g. 09XX XXX XXXX"
                >
                @error('contact_number')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $profile->email) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="e.g. landlord@email.com"
                >
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg text-sm shadow">
                    Save Profile
                </button>
            </div>
        </form>
    </div>
</x-layout>