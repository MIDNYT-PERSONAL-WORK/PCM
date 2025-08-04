<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Delivery Tracking - {{ $order->order_number }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
     @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #tracking-map {
            height: 400px;
            width: 100%;
            z-index: 1;
        }
        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            background: rgba(255, 255, 255, 0.8);
            padding: 1rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        .rider-marker {
            background-color: #3B82F6;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid white;
        }
        .destination-marker {
            background-color: #10B981;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid white;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-blue-600">Order Delivery Tracking</h1>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                    {{ strtoupper($order->status) }}
                </span>
            </div>
            
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Order Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600">Order Number:</p>
                        <p class="font-medium">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Delivery Code:</p>
                        <p class="font-medium">{{ $deliveryCode }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Customer:</p>
                        <p class="font-medium">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600">Total Amount:</p>
                        <p class="font-medium">GHC {{ number_format($order->amount, 2) }}</p>
                    </div>
                </div>
            </div>
            
            @if($order->rider)
            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-2">Rider Information</h2>
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                        @if($order->rider->profile_photo)
                            <img src="{{ asset('storage/'.$order->rider->profile_photo) }}" alt="Rider" class="w-12 h-12 rounded-full">
                        @else
                            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        @endif
                    </div>
                    <div>
                        <p class="font-medium">{{ $order->rider->name }}</p>
                        <p class="text-sm text-gray-600">{{ $order->rider->phone }}</p>
                    </div>
                </div>
            </div>
            @endif
            
            <div class="relative">
                <div id="tracking-map"></div>
                <div id="map-loading" class="loading-spinner">
                    <svg class="animate-spin h-8 w-8 text-blue-600 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <p class="mt-2 text-sm text-gray-600">Loading map...</p>
                </div>
            </div>
            
            <div class="mt-6 bg-blue-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-blue-800 mb-2">Delivery Status</h3>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium">Order Confirmed</p>
                            <p class="text-sm text-gray-500">{{ $order->created_at->format('M j, Y g:i A') }}</p>
                        </div>
                    </div>
                    
                    @if($order->status == 'delivered')
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium">Order Delivered</p>
                            <p class="text-sm text-gray-500">{{ $order->updated_at->format('M j, Y g:i A') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Leaflet Routing Machine -->
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Default coordinates (Accra, Ghana)
        
        const defaultLocation = [5.5600, -0.2057];
        const deliveryLocation = [
            {{ $order->delivery_latitude ?? 5.6037 }}, 
            {{ $order->delivery_longitude ?? -0.1870 }}
        ];

        // Initialize the map
        const map = L.map('tracking-map').setView(defaultLocation, 13);
        
        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add delivery destination marker
        const destinationMarker = L.marker(deliveryLocation, {
            icon: L.divIcon({
                className: 'destination-marker',
                html: '',
                iconSize: [20, 20],
                iconAnchor: [10, 10]
            })
        }).addTo(map);
        destinationMarker.bindPopup("Delivery Location").openPopup();

        // Try to get the user's current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const userLocation = [position.coords.latitude, position.coords.longitude];
                    
                    // Add rider marker
                    const riderMarker = L.marker(userLocation, {
                        icon: L.divIcon({
                            className: 'rider-marker',
                            html: '',
                            iconSize: [20, 20],
                            iconAnchor: [10, 10]
                        })
                    }).addTo(map);
                    riderMarker.bindPopup("Your Location");

                    // Add routing between user and destination
                    L.Routing.control({
                        waypoints: [
                            L.latLng(userLocation[0], userLocation[1]),
                            L.latLng(deliveryLocation[0], deliveryLocation[1])
                        ],
                        routeWhileDragging: false,
                        show: false,
                        lineOptions: {
                            styles: [{color: '#3B82F6', opacity: 0.7, weight: 5}]
                        },
                        createMarker: function() { return null; }
                    }).addTo(map);

                    // Fit map to show both locations
                    map.fitBounds([userLocation, deliveryLocation]);
                    
                    // Hide loading spinner
                    document.getElementById('map-loading').style.display = 'none';
                },
                function(error) {
                    console.error('Geolocation error:', error);
                    // If geolocation fails, just show the destination
                    map.setView(deliveryLocation, 15);
                    document.getElementById('map-loading').style.display = 'none';
                    
                    // Show error message
                    L.marker(deliveryLocation).addTo(map)
                        .bindPopup("Could not get your location. Showing delivery location only.")
                        .openPopup();
                },
                {
                    enableHighAccuracy: true,
                    timeout: 10000
                }
            );
        } else {
            // Browser doesn't support Geolocation
            map.setView(deliveryLocation, 15);
            document.getElementById('map-loading').style.display = 'none';
            
            L.marker(deliveryLocation).addTo(map)
                .bindPopup("Your browser doesn't support geolocation. Showing delivery location.")
                .openPopup();
        }
    });
    // Add this to your customer's tracking page JavaScript
    Echo.connector.socket.on('connect', () => {
        console.log('✅ Connected to WebSocket server');
    });

    Echo.connector.socket.on('disconnect', () => {
        console.log('❌ Disconnected from WebSocket server');
    });
    </script>
</body>
</html>