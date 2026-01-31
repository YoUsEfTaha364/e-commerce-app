@extends("admin.layouts.master")
@section("roles-active","active")


@section("main")

{{-- @if (session('add_product'))
    <div class="alert alert-success">
        {{ session('add_product') }}
    </div>
@endif --}}
<div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
  <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg border border-gray-100 p-6 sm:p-8">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-semibold text-gray-800">show Role</h2>

      <a
        href="#"
        class="px-4 py-2 rounded-lg bg-gray-700 text-white text-sm font-medium hover:bg-gray-800 transition"
      >
        Back
      </a>
    </div>

   <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          Role Name
        </label>

        <input
        readonly
          type="text"
          name="name"
          value="{{$role->name }}"
          placeholder="Enter role name..."
          class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
        />
      </div>

      <!-- Permissions -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-3">
          Permissions
        </label>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
          <!-- Test Permissions -->
          @foreach ( $Allpermissions as $permission )
          
                       <label class="flex items-center gap-2 p-3 rounded-lg border border-gray-100 bg-gray-50 hover:bg-gray-100 transition cursor-pointer">
            <input disabled {{ in_array($permission['name'], $Rolepermissions) ? 'checked' : '' }} type="checkbox"   class="w-4 h-4" />
            <span class="text-sm text-gray-700">{{$permission["name"]}}</span>
          </label>

          
          @endforeach


  

        </div>
      </div>



  </div>
</div>

@endsection