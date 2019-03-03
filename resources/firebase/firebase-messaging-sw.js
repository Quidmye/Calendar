importScripts('https://www.gstatic.com/firebasejs/5.8.5/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/5.8.5/firebase-messaging.js');

// Initialize the Firebase app in the service worker by passing in the
// messagingSenderId.
firebase.initializeApp({
   'messagingSenderId': '828731257045'
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
