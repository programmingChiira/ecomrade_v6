// Register the Pusher service worker.
self.addEventListener('install', function(event) {
    event.waitUntil(
        navigator.serviceWorker.register('/pusher-worker.js')
    );
});

// Listen for push messages.
self.addEventListener('push', function(event) {
    // Get the notification data.
    var data = JSON.parse(event.data);

    // Create a new notification.
    var notification = new Notification("Hello there comrade!", {
        body: data.message,
        icon: "/logo.png",
        vibrate: [200, 100, 200],
    });

    // Open the notification.
    notification.onclick = function(event) {
        event.preventDefault();
        window.focus();
    };
});
