@extends("admin.layouts.master")
@section("roles-active","active")
@section("main")

<div class="p-4 sm:p-6 bg-gray-50 min-h-screen">
  <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-lg border border-gray-100">

    <!-- Header -->
    <div class="flex items-center justify-between p-6 border-b border-gray-100">
      <h2 class="text-xl font-semibold text-gray-800">Roles</h2>

      <a
        href="{{ route("admin.roles.create") }}"
        class="px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition"
      >
        Add Role
      </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto p-6">
      <table class="min-w-full border border-gray-100 rounded-lg overflow-hidden">
        <thead class="bg-gray-50">
          <tr>
            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-700">
              Name
            </th>

            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-700">
              View
            </th>

            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-700">
              Edit
            </th>

            <th class="text-left px-6 py-3 text-sm font-semibold text-gray-700">
              Delete
            </th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
            @foreach ($roles as $role )

                        <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4 text-sm text-gray-800">{{$role->name}}</td>

            <td class="px-6 py-4 text-sm">
              <a
                href="{{ route("admin.roles.view",$role) }}"
                class="px-3 py-1.5 rounded-lg bg-gray-700 text-white text-xs font-medium hover:bg-gray-800 transition"
              >
                View
              </a>
            </td>

            <td class="px-6 py-4 text-sm">
              <a
                href="{{ route("admin.roles.edit",$role) }}"
                class="px-3 py-1.5 rounded-lg bg-green-600 text-white text-xs font-medium hover:bg-green-700 transition"
              >
                Edit
              </a>
            </td>

            <td class="px-6 py-4 text-sm">
              <form action="{{ route("admin.roles.delete",$role) }}" method="post">
                @csrf
                @method("delete")
              <button
                type="button"
                class="px-3 py-1.5 rounded-lg bg-red-600 text-white text-xs font-medium hover:bg-red-700 transition"
              >
                Delete
              </button>
              </form>
            </td>
          </tr>

            
            @endforeach


        </tbody>
      </table>
    </div>

  </div>
</div>

@endsection