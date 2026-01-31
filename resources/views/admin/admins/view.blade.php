@extends("admin.layouts.master")
@section("admin-active","active")


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
      <h2 class="text-xl font-semibold text-gray-800">View Admin</h2>

      <a
        href="#"
        class="px-4 py-2 rounded-lg bg-gray-700 text-white text-sm font-medium hover:bg-gray-800 transition"
      >
        Back
      </a>
    </div>

    <!-- Admin Info -->
    <div class="space-y-5">
      <!-- Name -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          Name
        </label>

        <input
          readonly
          type="text"
          value="{{$admin->name}}"
          class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
        />
      </div>

      <!-- Email -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          Email
        </label>

        <input
          readonly
          type="email"
          value="{{$admin->email}}"
          class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
        />
      </div>

      <!-- Role -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          Role
        </label>

        <input
          readonly
          type="text"
          value="{{$admin->getRoleNames()[0]}}"
          class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-gray-50 outline-none"
        />
      </div>
    </div>

    <!-- Permissions -->
    <div class="mt-8">
      <label class="block text-sm font-medium text-gray-700 mb-3">
        Permissions
      </label>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
        <!-- Test permissions -->
           @foreach ( $permissions as $permission )
                <label class="flex items-center gap-2 p-3 rounded-lg border border-gray-100 bg-gray-50">
          <input disabled type="checkbox" {{ $admin->hasPermissionTo($permission["name"]) ? "checked" : "" }}  class="w-4 h-4" />
          <span class="text-sm text-gray-700">{{$permission["name"]}}</span>
        </label>
           @endforeach
   

      </div>
    </div>

  </div>
</div>

@endsection