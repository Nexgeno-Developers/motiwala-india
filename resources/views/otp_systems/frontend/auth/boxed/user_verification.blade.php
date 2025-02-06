@extends('auth.layouts.authentication')

@section('content')
    <!-- aiz-main-wrapper -->
    <div class="aiz-main-wrapper d-flex flex-column justify-content-md-center bg-white">
        <section class="bg-white overflow-hidden">
            <div class="row">
                <div class="col-xxl-6 col-xl-9 col-lg-10 col-md-7 mx-auto py-lg-4">
                    <div class="card shadow-none rounded-0 border-0">
                        <div class="row no-gutters">
                            <!-- Left Side Image-->
                            <div class="col-lg-6">
                                <img src="{{ uploaded_asset(get_setting('phone_number_verify_page_image')) }}" alt="{{ translate('Phone Number Verify Page Image') }}" class="img-fit h-100">
                            </div>

                            <!-- Right Side -->
                            <div class="col-lg-6 p-4 p-lg-5 border right-content">
                                <!-- Site Icon -->
                                <div class="size-48px mb-3 mx-auto mx-lg-0">
                                    <img src="{{ uploaded_asset(get_setting('site_icon')) }}" alt="{{ translate('Site Icon')}}" class="img-fit h-100">
                                </div>

                                <!-- Titles -->
                                <div class="text-center text-lg-left">
                                    <h1 class="fs-20 fs-md-24 fw-700 text-primary" style="text-transform: uppercase;">{{ translate('Phone Verification')}}</h1>
                                    <h5 class="fs-14 fw-400 text-dark">{{ translate('Verification code has been sent. Please wait a few minutes.')}}</h5>
                                </div>

                                <!-- Login form -->
                                <div class="pt-3">
                                    <div class="text-center">
                                        <a href="{{ route('verification.phone.resend') }}" id="resendBtn" class="btn btn-link">{{translate('Resend Code')}}</a>
                                        <span id="timerText" style="display: none;"></span>
                                        <form class="form-default" role="form" action="{{ route('verification.submit') }}" method="POST">
                                            @csrf

                                            <!-- Verification Code -->
                                            <div class="form-group">
                                                <div class="input-group input-group--style-1">
                                                    <input type="text" class="form-control" name="verification_code">
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="mb-4 mt-4">
                                                <button type="submit" class="btn btn-primary btn-block fw-700 fs-14 rounded-0">{{  translate('Verify') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Go Back -->
                        <div class="mt-3 mr-4 mr-md-0">
                            <a href="{{ url()->previous() }}" class="ml-auto fs-14 fw-700 d-flex align-items-center text-primary" style="max-width: fit-content;">
                                <i class="las la-arrow-left fs-20 mr-1"></i>
                                {{ translate('Back to Previous Page')}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
@section('script')
<script>
    $(document).ready(function(){
        var timerDuration = 60; // seconds

        // Function to start or continue the timer
        function startTimer(seconds) {
            var $resendBtn = $('#resendBtn');
            var $timerText = $('#timerText');

            // Calculate the end time (in ms) and save in localStorage
            var endTime = Date.now() + (seconds * 1000);
            localStorage.setItem('resendTimerEnd', endTime);

            // Hide the button and show the timer text
            $resendBtn.hide();
            $timerText.show().text("Resend in " + seconds + "s");

            // Create an interval that updates every second
            var interval = setInterval(function(){
                var remaining = Math.round((endTime - Date.now()) / 1000);

                if(remaining <= 0){
                    clearInterval(interval);
                    localStorage.removeItem('resendTimerEnd');
                    $timerText.hide();
                    $resendBtn.show();
                } else {
                    $timerText.text("Resend in " + remaining + "s");
                }
            }, 1000);
        }

        // Check if a timer is already running (using localStorage)
        var storedTimer = localStorage.getItem('resendTimerEnd');
        var timerEnd = parseInt(storedTimer, 10) || 0;
        if (timerEnd > Date.now()) {
            var remaining = Math.round((timerEnd - Date.now()) / 1000);
            startTimer(remaining);
        } else {
            // Clear any stale value and start a fresh timer
            localStorage.removeItem('resendTimerEnd');
            $('#resendBtn').show();
            $('#timerText').hide();
            startTimer(timerDuration);
        }

        // Check if a timer is already running (using localStorage)
        // var timerEnd = localStorage.getItem('resendTimerEnd');
        // if (timerEnd) {
        //     var remaining = Math.round((timerEnd - Date.now()) / 1000);
        //     if (remaining > 0) {
        //         startTimer(remaining);
        //     } else {
        //         // Remove stale timer value if time has expired
        //         localStorage.removeItem('resendTimerEnd');

        //     }
        // } else {
        //     // On first load, if OTP has been sent, start the timer.
        //     // Comment out the next line if you don't want the timer to start automatically.
        //     startTimer(timerDuration);
        // }
        // startTimer(timerDuration);
        // When the user clicks the resend button:
        $('#resendBtn').on('click', function(e){
            e.preventDefault();
            console.debug("OTP Resent");
            // (Optional) Send the OTP via AJAX here:

            $.ajax({
                url: $(this).attr('href'),
                method: 'GET',
                success: function(response) {
                    console.log("OTP Resent");
                },
                error: function(error) {
                    console.error("Error resending OTP:", error);
                }
            });


            // Restart the timer for 60 seconds
            startTimer(timerDuration);
        });
    });
  </script>
@endsection

