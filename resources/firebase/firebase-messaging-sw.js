importScripts('https://www.gstatic.com/firebasejs/3.6.8/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.6.8/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
   'messagingSenderId': '828731257045'
});
