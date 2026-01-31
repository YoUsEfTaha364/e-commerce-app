@extends("admin.layouts.master")
@section("admin-active","active")


@section("main")


<div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
  <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg border border-gray-100 p-6 sm:p-8">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-xl font-semibold text-gray-800">update Admin</h2>

      <a
        href="#"
        class="px-4 py-2 rounded-lg bg-gray-700 text-white text-sm font-medium hover:bg-gray-800 transition"
      >
        Back
      </a>
    </div>
   @if (session('update-admin'))
    <div class="alert alert-success">
        {{ session('update-admin') }}
    </div>
@endif 
    <!-- Form -->

    @if ($errors->any())
    <div class="mb-6 p-4 rounded-lg border border-red-200 bg-red-50">
        <h3 class="text-sm font-semibold text-red-700 mb-2">
            Something went wrong:
        </h3>

        <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route("admin.admins.update",$admin) }}" method="POST" class="space-y-6">
      <!-- Name -->
      @csrf
      @method("patch")
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          Name
        </label>

        <input
          type="text"
          name="name"
          value="{{ $admin->name }}"
          placeholder="Enter admin name..."
          class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
        />
      </div>

      <!-- Email -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          Email
        </label>

        <input
          type="email"
          name="email"
          value="{{ $admin->email }}"
          placeholder="Enter admin email..."
          class="w-full px-4 py-2.5 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
        />
      </div>
  
      <!-- Role -->
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">
          Role
        </label>

        <select
          name="role"
          class="w-full px-4 py-2.5 rounded-lg border border-gray-200 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
        >
          <option  value="" selected disabled>Select a role</option>
          <!-- Test options -->
          @if(count($roles)>0)
             @foreach ($roles as $role )
                <option {{ $admin->getRoleNames()[0]==$role->name ? "selected" : "" }} value="{{ $role->name }}">{{$role->name}}</option>
             @endforeach
          @endif

        </select>
      </div>

      <!-- Submit -->
      <div class="flex items-center gap-3 pt-4">
        <button
          type="submit"
          class="px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition"
        >
          update Admin
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