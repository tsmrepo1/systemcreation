    var firebaseConfig = {
        apiKey: 'AIzaSyDWqw62Uv2RipJeQ0sovobhg06LHvRdbGY',
        authDomain: 'dominion-fcm-8a90e.firebaseapp.com',
        databaseURL: 'https://project-id.firebaseio.com',
        projectId: 'dominion-fcm-8a90e',
        storageBucket: "dominion-fcm-8a90e.appspot.com",
        messagingSenderId: "617817943890",
        appId: "1:617817943890:web:a4c7714b5653716f17548b",
        measurementId: "G-EXG5LTTCYW"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    const route = "http://localhost:8000/app/device-token";

    function startFCM() {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(token) {
                axios.post(route, {
                    'device_token': token,
                    'type' : "fcm"
                })
                .then(res => {
                })
                .catch(err => {
                    $("#pushNotificationAlert").show();
                });

            }).catch(function(error) {
                $("#pushNotificationAlert").show();
            });
    }
    messaging.onMessage(function(payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });

    function notifyMe() {
        if (!("Notification" in window)) {
          alert("This browser does not support desktop notification");
        } else if (Notification.permission === "default") {
            startFCM();
        } else if (Notification.permission === "denied") {
            $("#pushNotificationAlert").show();
        }
    }
    $("#pushNotificationAlert").hide();
    notifyMe();
      