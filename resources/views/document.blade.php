{{-- <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recetario</title>
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
            max-width: 60%;
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
            <img src="{{ public_path('img/banner.jpg') }}" alt="Logo de la Clínica">
        </header>
        <div class="content">
            <h3>Reposo</h3>
            <h6>Nro: {{ $numero_recetario }}</h6>

            <div class="info-group">
                <label>Fecha de Consulta:</label>
                <p>{{ $fecha_consulta }}</p>
            </div>
            <div class="info-group">
                <label>Nombre del Paciente:</label>
                <p>{{ $nombre_paciente }}</p>
            </div>
            <div class="info-group">
                <label>Días de Reposo:</label>
                <p>{{ $dias_reposo }}</p>
            </div>
            <div class="info-group">
                <label>Horario de Reposo:</label>
                <p>{{ $horario_reposo }}</p>
            </div>
            <div class="info-group">
                <label>Recomendaciones:</label>
                <p>{{ $recomendaciones }}</p>
            </div>
            <div class="info-group">
                <label>Próxima Consulta:</label>
                <p>{{ $proxima_consulta }}</p>
            </div>
        </div>
        <footer>
            <div class="footer-content">
                <p>Si algo no va bien en tu vida, está bien llorar. Recuerda que las lágrimas son oraciones que llegan a Dios cuando no puedes hablar.</p>
                <p>Dirección: Pampa Galana</p>
                <p>Teléfono: +591 72978758</p>
                <p>Email: fcalvariodelmilagro@gmail.com</p>
            </div>
        </footer>
    </div>
</body>
</html> --}}


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
            max-width: 60%;
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
            <img src="{{ public_path('img/banner.jpg') }}" alt="{{ __('Clinic Logo') }}">
        </header>
        <div class="content">
            <h3>{{ __('Rest') }}</h3>
            <h6>{{ __('Prescription_Number') }}: {{ $number_prescription }}</h6>

            <div class="info-group">
                <label>{{ __('Consultation_Date') }}:</label>
                <p>{{ $date_consulting }}</p>
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
                <label>{{ __('Next_Consultation') }}:</label>
                <p>{{ $next_consultation }}</p>
            </div>
        </div>
        <footer>
            <div class="footer-content">
                <p>{{ __('Footer_Message') }}</p>
                <p>{{ __('Address') }}: {{ $clinic_address }}</p>
                <p>{{ __('Phone') }}: {{ $clinic_phone }}</p>
                <p>{{ __('Email') }}: {{ $clinic_email }}</p>
            </div>
        </footer>
    </div>
</body>
</html>
