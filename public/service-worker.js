self.addEventListener('push', function(event) {
    console.log('Push Notification Received');

    const title = 'Push Notification';
    const options = {
        body: event.data.text(),
        icon: '/images/KPK_Police_Logo.svg',
        badge: '/images/KPK_Police_Logo.svg'
    };

    event.waitUntil(self.registration.showNotification(title, options));
});
