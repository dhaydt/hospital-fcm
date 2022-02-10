/*
Give the service worker access to Firebase Messaging.
Note that you can only use Firebase Messaging here, other Firebase libraries are not available in the service worker.
*/
importScripts("https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js");
importScripts(
    "https://www.gstatic.com/firebasejs/7.23.0/firebase-messaging.js"
);

/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
* New configuration for app@pulseservice.com
*/
firebase.initializeApp({
    apiKey: "AIzaSyDNHG694SRE2nSW7Dc276dctM2dyPi_w2w",
    authDomain: "fcm-demo-60928.firebaseapp.com",
    projectId: "fcm-demo-60928",
    storageBucket: "fcm-demo-60928.appspot.com",
    messagingSenderId: "94836916481",
    appId: "1:94836916481:web:4f3e73638d139cae1c9b00",
});

/*
Retrieve an instance of Firebase Messaging so that it can handle background messages.
*/
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload
    );
    /* Customize notification here */
    const notificationTitle = "Bidan Ratna Dewi";
    const notificationOptions = {
        body: "Sudah waktunya berobbat.",
        icon: "/assets/front-end/img/logo.jpeg",
    };

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions
    );
});
