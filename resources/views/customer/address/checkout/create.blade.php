@extends("customer.layouts.master")
@section("cart-active","bg-white shadow-md")


@section("main")
 {{-- ===========================
     address --}}

<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white rounded-xl shadow-sm p-8">

        <h2 class="text-3xl font-semibold text-gray-900 mb-8">
            Shipping Address
        </h2>

        @if ($errors->any())
    <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
        <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form method="post"  action="{{ route("checkout.address.store") }}" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            @csrf

            <!-- Full Name -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-800 mb-1">
                    Full Name
                </label>
                <input
                   value="{{ old("full_name") }}"
                    type="text"
                    name="full_name"
                    placeholder="full name"
                    class="w-full rounded-lg bg-gray-100 border border-gray-200 px-4 py-3
                           focus:border-purple-500 focus:ring-2 focus:ring-purple-100"
                >
            </div>

            <!-- Phone -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-800 mb-1">
                    Phone Number
                </label>
                <input
                   value="{{ old("phone") }}"
                    type="tel"
                    name="phone"
                    placeholder="+20 10 1234 5678"
                    class="w-full rounded-lg bg-gray-100 border border-gray-200 px-4 py-3
                           focus:border-purple-500 focus:ring-2 focus:ring-purple-100"
                >
            </div>

            <!-- Address -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-800 mb-1">
                    Address 
                </label>
                <input
                   value="{{ old("address") }}"
                    type="text"
                    name="address"
                    placeholder="Street, building, apartment"
                    class="w-full rounded-lg bg-gray-100 border border-gray-200 px-4 py-3
                            focus:border-purple-500 focus:ring-2 focus:ring-purple-100"
                >
            </div>

            <!-- City -->





<!-- State -->
<div>
    <label class="block text-sm font-medium text-gray-800 mb-1">
        Region
    </label>

    <select name="state" id="state"
        class="w-full rounded-lg bg-gray-100 border border-gray-200 px-4 py-3">
        <option value="">Select State</option>

        @foreach ($states as $state)
            <option 
                value="{{ $state->name }}"
                data-cities='@json($state->cities)'
                {{ old("state")==$state->name ? "selected" :" " }}
            >
                {{ $state->name }}
            </option>
        @endforeach
    </select>
</div>

<!-- City -->
<div>
    <label class="block text-sm font-medium text-gray-800 mb-1">
        City
    </label>

    <select name="city" id="city"
        class="w-full rounded-lg bg-gray-100 border border-gray-200 px-4 py-3">
        <option value="">select city</option>
    </select>
</div>


            <!-- State -->
        
  
            <!-- Button -->
            <div class="md:col-span-2 mt-8">
                <button
                    type="submit"
                    class="w-full bg-yellow-400 hover:bg-yellow-500 text-black font-semibold py-4 rounded-xl transition"
                >
                    Continue
                </button>
            </div>

        </form>
    </div>
</div>
<script>
    const stateSelect = document.getElementById('state');
    const citySelect = document.getElementById('city');

    function loadCities(selectedCity = null) {
        const selectedOption = stateSelect.options[stateSelect.selectedIndex];
        const cities = JSON.parse(selectedOption.dataset.cities || '[]');

        citySelect.innerHTML = '<option value="">Select City</option>';

        cities.forEach(city => {
            const option = document.createElement('option');
            option.value = city.name;
            option.textContent = city.name;

            if (selectedCity && selectedCity === city.name) {
                option.selected = true;
            }

            citySelect.appendChild(option);
        });
    }

    stateSelect.addEventListener('change', function () {
        loadCities();
    });

    // 🔹 CREATE PAGE: restore old values
    document.addEventListener('DOMContentLoaded', function () {
        if ("{{ old('state') }}") {
            loadCities(@json(old('city')));
        }
    });
</script>


@endsection

