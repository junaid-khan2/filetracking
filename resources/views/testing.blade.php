<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FCM Token Retrieval</title>
</head>
<body>
    <h1>FCM Token Retrieval</h1>
    <p>Click the button below to retrieve your FCM token:</p>
    <button onclick="retrieveFCMToken()">Get FCM Token</button>

    <script type="module">
        function retrieveFCMToken() {
            // Check if the browser supports Firebase messaging
            if ('Notification' in window && 'serviceWorker' in navigator && 'firebase' in window) {
                const messaging = firebase.messaging();

                // Assuming 'messaging' is already initialized and 'userId' is defined
                messaging.getToken({
                    vapidKey: "BOJng6QHxqjF5YnV-1XZ3n4i790EBFf6oWqYCeRDw5W4peHEYVUzymR797tHcuyTTdB8CdK1pcdHqnReEVQtPEA"
                })
                .then((currentToken) => {
                    if (currentToken) {
                        // Now, send this token to your server for storage
                        // This part should be done from server-side code, not here
                        console.log("FCM Token:", currentToken);
                        // You can send 'currentToken' to your server using AJAX or fetch
                    } else {
                        console.log("No registration token available. Request permission to generate one.");
                        // Handle the case where permission is not granted
                    }
                })
                .catch((err) => {
                    console.log("An error occurred while retrieving token. ", err);
                });
            } else {
                console.log('Firebase Messaging is not supported in this browser.');
            }
        }
    </script>

    <!-- Firebase JavaScript SDK -->
    <script = src="https://www.gstatic.com/firebasejs/9.5.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.5.0/firebase-messaging.js"></script>
    <script type="module">
        // Firebase configuration
        var firebaseConfig = {
            apiKey: "AIzaSyB-bU11RFqxNI37HWYCEs5rHEkzYsxchoM",
            authDomain: "laravel-adc68.firebaseapp.com",
            databaseURL: "https://laravel-adc68-default-rtdb.firebaseio.com",
            projectId: "laravel-adc68",
            storageBucket: "laravel-adc68.appspot.com",
            messagingSenderId: "854070326902",
            appId: "1:854070326902:web:a85a2b3ca1c6ce2a665157",
            measurementId: "G-D3HP6SZPJZ"
        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
    </script>
</body>
</html>
