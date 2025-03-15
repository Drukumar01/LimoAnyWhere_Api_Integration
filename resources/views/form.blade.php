<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Booking Form</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center mb-4">Book a Ride</h2>
        <form action="/ride-booking" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Pickup Location</label>
                <input type="text" name="pickup_location" class="form-control" placeholder="Enter pickup location" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Drop-off Location</label>
                <input type="text" name="dropoff_location" class="form-control" placeholder="Enter drop-off location" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Add Stop (Optional)</label>
                <input type="text" name="add_stop" class="form-control" placeholder="Enter additional stop">
            </div>

            <div class="mb-3">
                <label class="form-label">Pickup Date</label>
                <input type="date" name="pickup_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pickup Time</label>
                <input type="time" name="pickup_time" class="form-control" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="add_return" class="form-check-input">
                <label class="form-check-label">Add Return</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Passenger Count</label>
                <input type="number" name="passenger_count" class="form-control" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Get Rates</button>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
