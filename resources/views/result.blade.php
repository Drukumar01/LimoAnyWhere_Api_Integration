<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ride Rates</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .vehicle-img {
            max-width: 100px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center mb-4">Available Vehicles</h2>

        @if(session('error'))
            <div class="alert alert-danger text-center">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @elseif(empty($rates))
            <div class="alert alert-warning text-center">
                No available vehicles found.
            </div>
        @else
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Vehicle</th>
                        <th>Description</th>
                        <th>Seats</th>
                        <th>Luggage</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rates as $rate)
                        <tr>
                            <td>{{ $rate['vehicle_type_name'] ?? 'Unknown' }}</td>
                            <td>{!! $rate['vehicle_type_description'] ?? 'N/A' !!}</td>
                            <td>{{ $rate['passenger_capacity'] ?? 'N/A' }}</td>
                            <td>{{ $rate['luggage_capacity'] ?? 'N/A' }}</td>
                            <td>
                                @if(!empty($rate['vehicle_type_images'][0]))
                                    <img src="{{ $rate['vehicle_type_images'][0] }}" class="vehicle-img" alt="Vehicle">
                                @else
                                    No Image
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="text-center mt-4">
            <a href="/" class="btn btn-primar
