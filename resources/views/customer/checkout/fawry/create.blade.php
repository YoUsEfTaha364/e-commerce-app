@extends("customer.layouts.master")
@section("cart-active","bg-white shadow-md")


@section("main")
 {{-- ===========================
     address --}}

<div class="max-w-4xl mx-auto mt-10">
    <div class="bg-white rounded-xl shadow-sm p-8">


        <form method="post"  action="{{ route("checkout.address.store") }}" class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            @csrf
              <!-- FawryPay Checkout Button -->
<input type="image" onclick="checkout();" src="https://www.atfawry.com/assets/img/FawryPayLogo.jpg"
 alt="pay-using-fawry" id="fawry-payment-btn"/>
     
        </form>
    </div>
</div>




<!-- Import FawryPay Staging JavaScript Library-->
{{-- <script type="text/javascript" src="https://atfawry.fawrystaging.com/atfawry/plugin/assets/payments/js/fawrypay-payments.js">


</script> --}}

<!-- Import FawryPay Production JavaScript Library -->
{{-- <script type="text/javascript" src="https://www.atfawry.com/atfawry/plugin/assets/payments/js/fawrypay-payments.js"></script> --}}

<script>
    function checkout() {
            const configuration = {
                locale : "en",  //default en
                mode: DISPLAY_MODE.POPUP,  //required, allowed values [POPUP, INSIDE_PAGE, SIDE_PAGE , SEPARATED]
            };
    FawryPay.checkout(buildChargeRequest(), configuration);
}
</script>
@endsection

