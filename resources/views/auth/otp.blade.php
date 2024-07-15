<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File Tracking</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <style>
        .login-page {
            background-image: url("{{ asset('images/FTS-bg.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>File</b>Tracking</a>
            </div>
            <div class="card-body">


                <form action="{{ route('otp.verify.submit') }}" method="post">
                    @csrf

                    <p>An OTP has been sent to your recovery email.</p>
                    <p>Please enter the OTP below:</p>

                    <input type="number" name="otp" required>
                    @error('otp')
                        {{ $message }}
                    @enderror

                    <button class="btn btn-primary" type="submit">Verify OTP</button>

                    <p class="text-danger d-none" id="expiry-time">{{ Auth::user()->otp_expiry }}</p>
                    <p class="text-danger" id="countdown"></p>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <script>
        let countdownInterval; // Declare countdownInterval variable outside the function scope

        // Function to update countdown timer
        function updateCountdown() {
            // Get the OTP expiry time from the DOM
            let expiryTime = document.getElementById('expiry-time').textContent;

            // Calculate the remaining time in milliseconds
            let now = new Date().getTime();
            let expiryTimestamp = new Date(expiryTime).getTime();
            let distance = expiryTimestamp - now;

            // Check if distance is NaN or negative (expired)
            if (isNaN(distance) || distance < 0) {
                clearInterval(countdownInterval);
                document.getElementById('countdown').innerHTML = "<a href='{{ route('otp.verify.resend') }}'>Resend</a>";
                return;
            }

            // Calculate remaining minutes and seconds
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Update the countdown timer element
            document.getElementById('countdown').innerHTML = "Time remaining: " + minutes + "m " + seconds + "s";
        }

        // Update countdown initially and every second
        updateCountdown();
        countdownInterval = setInterval(updateCountdown, 1000); // Initialize countdownInterval here
    </script>




</body>

</html>
