<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Prescription') }}</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            width: 100mm;
            height: 145mm;
            box-sizing: border-box;
            background-color: #f4f4f9;
        }
        .container {
            padding: 2mm;
            border: 1px solid #ccc;
            height: 100%;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background-color: #fff;
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
        }
        header, footer {
            text-align: center;
        }
        header img {
            max-width: 40%;
            height: auto;
        }
        .content {
            flex: 1;
            margin: 2mm 0;
        }
        h3 {
            font-size: 1em;
            margin-bottom: 2mm;
            color: #333;
            text-align: center;
            display: inline-block;
            width: 100%;
            margin: 0;
        }
        h6 {
            font-size: 0.7em;
            margin-bottom: 2mm;
            margin: 0;
            color: #333;
            text-align: right;
            display: inline-block;
            width: 100%;
        }
        .info-group {
            margin-bottom: 2mm;
        }
        .info-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 1mm;
            color: #555;
            font-size: 0.7em;
        }
        .info-group p {
            margin: 0;
            padding: 1mm;
            border: 1px solid #ddd;
            border-radius: 1mm;
            background-color: #f9f9f9;
            color: #333;
            font-size: 0.7em;
        }
        .inline-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2mm; /* Espacio entre los elementos */
        }
        .inline-group .info-group {
            flex: 1;
            margin-bottom: 0; /* Eliminar el margen inferior para alineación en línea */
        }
        .footer-content {
            font-size: 0.6em;
            color: #777;
        }
        .footer-content p {
            margin: 1mm 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img src="{{ public_path('img/logo.png') }}" alt="{{ __('Clinic Logo') }}">
        </header>
        <div class="content">
            <h3>{{ __('Rest') }}</h3>
            <h6>{{ __('Prescription_Number') }}: {{ $number_prescription }}</h6>

            <div class="inline-group">
                <div class="info-group">
                    <label>{{ __('Consultation_Date') }}:</label>
                    <p>{{ $date_consulting }}</p>
                </div>
                <div class="info-group">
                    <label>{{ __('Next_Consultation') }}:</label>
                    <p>{{ $next_consultation }}</p>
                </div>
            </div>

            <div class="info-group">
                <label>{{ __('Patient_Name') }}:</label>
                <p>{{ $patient_name }}</p>
            </div>
            <div class="info-group">
                <label>{{ __('Rest_Days') }}:</label>
                <p>{{ $rest_days }}</p>
            </div>
            <div class="info-group">
                <label>{{ __('Rest_Schedule') }}:</label>
                <p>{{ $rest_schedule }}</p>
            </div>
            <div class="info-group">
                <label>{{ __('Recommendations') }}:</label>
                <p>{{ $recommendations }}</p>
            </div>
            <div class="info-group">
                <label>{{ __('Operation') }}:</label>
                <p>{{ $operation }}</p>
            </div>

        </div>
        <footer>
            <div class="footer-content">
                <p>{{ __('Footer_Message') }}</p>
                <p>{{ __('Address') }}: {{ $clinic_address }} / {{ __('Phone') }}: {{ $clinic_phone }}</p>
                <p>{{ __('Email') }}: {{ $clinic_email }}</p>
            </div>
        </footer>
    </div>
</body>
</html>
