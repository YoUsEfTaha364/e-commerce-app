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
      <h2 class="text-xl font-semibold text-gray-800">Create Role</h2>

      <a
        href="#"
        class="px-4 py-2 rounded-lg bg-gray-700 text-white text-sm font-medium hover:bg-gray-800 transition"
      >
        Back
      </a>
    </div>

    <!-- Form -->
    <form action="{{ route("admin.roles.store") }}" method="POST" class="space-y-6">
      <!-- Role Name -->
      @csrf
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          Role Name
        </label>

        <input
          type="text"
          name="name"
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
          @foreach ( $permissions as $permission )
                       <label class="flex items-center gap-2 p-3 rounded-lg border border-gray-100 bg-gray-50 hover:bg-gray-100 transition cursor-pointer">
            <input type="checkbox" name="permissions[]" value="{{$permission->name}}" class="w-4 h-4" />
            <span class="text-sm text-gray-700">{{$permission->name}}</span>
          </label>

          
          @endforeach


  

        </div>
      </div>

      <!-- Submit -->
      <div class="flex items-center gap-3 pt-4">
        <button
          type="submit"
          class="px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition"
        >
          Save Role
        </button>

        <button
          type="reset"
          class="px-5 py-2.5 rounded-lg bg-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-300 transition"
        >
          Reset
        </button>
      </div>
    </form>

  </div>
</div>

@endsection