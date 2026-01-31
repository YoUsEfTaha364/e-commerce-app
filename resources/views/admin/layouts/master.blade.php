<!DOCTYPE html>
<html lang="en">
  {{-- head --}}
@include("admin.partials.head")
<body>
    
    <div class="flex min-h-screen">
        
        <!-- 1. SIDEBAR NAVIGATION -->
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0 hidden md:block shadow-2xl">
            <div class="flex flex-col h-full">
                <!-- Logo/Brand Area -->
              @include("admin.partials.logo")
                <!-- Navigation Links -->
                @include("admin.partials.nav")
              
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-grow flex flex-col">
            
            <!-- 2. HEADER BAR -->
           @include("admin.partials.header")
            <!-- 3. MAIN DASHBOARD CONTENT -->
            <main class="p-4 sm:p-6 lg:p-8 flex-grow">
              @yield("main")
                
                
          
            </main>
        </div>
    </div>

</body>
</html>