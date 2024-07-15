importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-app.js");

importScripts("https://www.gstatic.com/firebasejs/8.2.0/firebase-messaging.js");



const firebaseConfig = {

  apiKey: "AIzaSyB-bU11RFqxNI37HWYCEs5rHEkzYsxchoM",

  authDomain: "laravel-adc68.firebaseapp.com",

  databaseURL: "https://laravel-adc68-default-rtdb.firebaseio.com",

  projectId: "laravel-adc68",

  storageBucket: "laravel-adc68.appspot.com",

  messagingSenderId: "854070326902",

  appId: "1:854070326902:web:1ccd89f7204b337c665157",

  measurementId: "G-SM918FX5ZD"

};



firebase.initializeApp(firebaseConfig);



const messaging = firebase.messaging();



// Handle background messages

messaging.setBackgroundMessageHandler(function(payload) {

  // Customize the behavior for background messages here

  const { title, body } = payload.notification;

  return self.registration.showNotification(title, {

    icon: 'https://complaint.test/vendors/images/apple-touch-icon.png',

    image: 'https://complaint.thecodefixer.com/vendors/images/map_img.png',

    data: {

      url: 'https://complaint.thecodefixer.com/admin/alert/location'

    }

  });

});



// Handle notification click event

self.addEventListener('notificationclick', function(event) {

  event.notification.close(); // Close the notification



  const redirectUrl = event.notification.data.url || 'https://filetracking.xtremespos.com/';



  // Open the specified URL in a new tab or focus on an existing tab

  event.waitUntil(

    clients.matchAll({ type: 'window' }).then(clientsArr => {

      for (const client of clientsArr) {

        if ('navigate' in client) {

          return client.navigate(redirectUrl);

        }

      }

      if (clients.openWindow) {

        return clients.openWindow(redirectUrl);

      }

    })

  );

});
