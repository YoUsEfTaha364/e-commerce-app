<!DOCTYPE html>
<html lang="en">
  <!-- Import FawryPay CSS Library-->
<link rel="stylesheet" href="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/css/fawrypay-payments.css">
 @include("customer.partials.head")
<body class="min-h-screen">
  @include("customer.partials.header")

  @include("customer.partials.nav")
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
       @yield("main")
    </main>

  @include("customer.partials.footer")
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>