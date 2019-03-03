importScripts('https://www.gstatic.com/firebasejs/5.8.5/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/5.8.5/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
   'messagingSenderId': '828731257045'
});
