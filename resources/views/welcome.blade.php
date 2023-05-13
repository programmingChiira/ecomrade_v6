<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        }
    </script>
    {{-- <script src="https://unpkg.com/vue-cookies@1.5.12/vue-cookies.js"></script> --}}
    <script src="./assets/newProps/vue-cookies.js"></script>
    <!-- CSS only -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />


    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css'>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Bootstrap-Vue CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-vue@2.21.2/dist/bootstrap-vue.min.css">


    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Files -->
    <link id="pagestyle" href="./assets/css/soft-design-system.css?v=1.0.9" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <meta name="theme-color" content="#189483" />
    <link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Arvo&family=Quicksand:wght@500&display=swap');

        * {
            font-family: 'Arvo', serif;
            font-family: 'Quicksand', sans-serif;
        }

        .full-page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            background-color: #189483ec;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .full-image-page {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            background-color: #189483ec;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div id="app"></div>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
    <!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
    <script src="./assets/js/plugins/countup.min.js"></script>
    <script src="./assets/js/plugins/choices.min.js"></script>
    <script src="./assets/js/plugins/prism.min.js"></script>
    <script src="./assets/js/plugins/highlight.min.js"></script>
    <!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
    <script src="./assets/js/plugins/rellax.min.js"></script>
    <!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
    <script src="./assets/js/plugins/tilt.min.js"></script>
    <!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
    <script src="./assets/js/plugins/choices.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-vue@2.21.2/dist/bootstrap-vue.min.js"></script>


    <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
    <script src="./assets/js/plugins/parallax.min.js"></script>
    <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->

    <script src="./assets/js/soft-design-system.min.js?v=1.0.9" type="text/javascript"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js'></script>
    <script src="./script.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    {{-- <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('9820769533922d6161b6', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            //toastr.success(JSON.stringify(data.message));
            Swal.fire(
                'Hello there comrade!',
                JSON.stringify(data.message),
                'success'
            )

            // alert();
        });
    </script> --}}

    {{-- <script>
        var pusher;

        // Check if the browser is a mobile browser or a PWA.
        var browser = navigator.userAgent.toLowerCase();

        if (browser.indexOf('iphone') > -1 || browser.indexOf('android') > -1 || browser.indexOf('pwa') > -1) {
            // If the browser is a mobile browser or a PWA, use the Pusher service worker.
            pusher = new Pusher('9820769533922d6161b6', {
                cluster: 'ap2',
                useServiceWorker: true
            });
        } else {
            // If the browser is not a mobile browser or a PWA, use the regular Pusher API.
            pusher = new Pusher('9820769533922d6161b6', {
                cluster: 'ap2'
            });
        }

        // Subscribe to the `my-channel` channel.
        var channel = pusher.subscribe('my-channel');

        // Bind an event handler to the `my-event` event.
        channel.bind('my-event', function(data) {
            // Check if notifications are supported.
            if ("Notification" in window) {
                Notification.requestPermission().then(function(permission) {
                    if (permission === "granted") {
                        // If the user grants permission, show the notification.
                        var notification = new Notification("Hello there comrade!", {
                            body: data.message,
                            icon: "/logo.png",
                            vibrate: [200, 100, 200],
                        });
                        notification.onclick = function(event) {
                            event.preventDefault();
                            window.focus();
                        };
                    } else if (
                        Notification.permission !== "denied" &&
                        window.matchMedia("(display-mode: standalone)").matches
                    ) {
                        // If the user hasn't denied permission, and the app is running as a PWA, request permission.
                        Notification.requestPermission().then(function(permission) {
                            if (permission === "granted") {
                                var notification = new Notification("Hello there comrade!", {
                                    body: data.message,
                                    icon: "/logo.png",
                                    vibrate: [200, 100, 200],
                                });
                                notification.onclick = function(event) {
                                    event.preventDefault();
                                    window.focus();
                                };
                            }
                        });
                    }
                });
            } else {
                console.error("This browser does not support desktop notifications");
            }
        });
    </script> --}}

    <script>
        var pusher;

        // Check if the browser is a mobile browser or a PWA.
        var browser = navigator.userAgent.toLowerCase();

        if (browser.indexOf('iphone') > -1 || browser.indexOf('android') > -1 || browser.indexOf('pwa') > -1) {
            // If the browser is a mobile browser or a PWA, use the Pusher service worker.
            const pusherOptions = {
                useServiceWorker: true,
                cluster: 'ap2',
            };
            pusher = new Pusher('9820769533922d6161b6', pusherOptions);

            // Register service worker for handling push notifications
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/pusher-worker.js')
                    .then(function(registration) {
                        console.log('Service worker registered successfully for Pusher');
                        pusherOptions.serviceWorkerRegistration = registration;
                        pusher = new Pusher('9820769533922d6161b6', pusherOptions);
                    })
                    .catch(function(error) {
                        console.error('Failed to register service worker for Pusher', error);
                    });
            }
        } else {
            // If the browser is not a mobile browser or a PWA, use the regular Pusher API.
            pusher = new Pusher('9820769533922d6161b6', {
                cluster: 'ap2'
            });
        }

        // Subscribe to the `my-channel` channel.
        var channel = pusher.subscribe('my-channel');

        // Bind an event handler to the `my-event` event.
        channel.bind('my-event', function(data) {
            // Check if notifications are supported.
            if ("Notification" in window) {
                Notification.requestPermission().then(function(permission) {
                    if (permission === "granted") {
                        // If the user grants permission, show the notification.
                        var notification = new Notification("Hello there comrade!", {
                            body: data.message,
                            icon: "/logo.png",
                            vibrate: [200, 100, 200],
                        });
                        notification.onclick = function(event) {
                            event.preventDefault();
                            window.focus();
                        };
                    } else if (
                        Notification.permission !== "denied" &&
                        window.matchMedia("(display-mode: standalone)").matches
                    ) {
                        // If the user hasn't denied permission, and the app is running as a PWA, request permission.
                        Notification.requestPermission().then(function(permission) {
                            if (permission === "granted") {
                                var notification = new Notification("Hello there comrade!", {
                                    body: data.message,
                                    icon: "/logo.png",
                                    vibrate: [200, 100, 200],
                                });
                                notification.onclick = function(event) {
                                    event.preventDefault();
                                    window.focus();
                                };
                            }
                        });
                    }
                });
            } else {
                console.error("This browser does not support desktop notifications");
            }
        });
    </script>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function(reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
        }
    </script>

    <script>
        function change_image(image) {
            var container = document.getElementById("main-image");
            container.src = image.src;
        }
        document.addEventListener("DOMContentLoaded", function(event) {});
    </script>

    <script>
        function change_view(image) {
            var container = document.getElementById("main-view");
            container.src = image.src;
        }
        document.addEventListener("DOMContentLoaded", function(event) {});
    </script>
    <script src="/pusher-worker.js"></script>

    <script></script>
</body>

</html>
