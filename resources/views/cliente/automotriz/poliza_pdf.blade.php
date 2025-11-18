<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Póliza Automotriz #{{ $poliza->numero_poliza }}</title>
    <style>
        @page {
            margin: 40px 60px;
            size: A4;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            line-height: 1.5;
            background: #f9f9fb;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border: 3px solid #1e3a8a;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        /* ENCABEZADO */
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            color: white;
            padding: 20px 30px;
            text-align: center;
            position: relative;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .header .subtitle {
            font-size: 14px;
            opacity: 0.9;
            margin-top: 5px;
        }

        .logo {
            position: absolute;
            top: 15px;
            left: 30px;
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .logo img {
            width: 60px;
            border-radius: 50%;
        }

        /* NÚMERO DE PÓLIZA */
        .poliza-number {
            background: #fff;
            color: #1e3a8a;
            padding: 8px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: 16px;
            display: inline-block;
            margin-top: 15px;
            box-shadow: 0 4px 10px rgba(30, 58, 138, 0.2);
        }

        /* CUERPO */
        .content {
            padding: 30px;
        }

        .section {
            margin-bottom: 25px;
            padding: 18px;
            background: #f8f9ff;
            border-left: 5px solid #3b82f6;
            border-radius: 0 8px 8px 0;
        }

        .section h3 {
            margin: 0 0 12px 0;
            color: #1e3a8a;
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .section h3 i {
            margin-right: 8px;
            color: #3b82f6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 11px;
        }

        th {
            background: #e0e7ff;
            color: #1e3a8a;
            text-align: left;
            padding: 10px 12px;
            font-weight: 600;
            border-bottom: 2px solid #3b82f6;
        }

        td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        tr:hover td {
            background: #f0f4ff;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-success {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-total {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge-terceros {
            background: #fef3c7;
            color: #92400e;
        }

        /* QR */
        .qr-container {
            text-align: center;
            margin: 25px 0;
        }

        .qr-container img {
            width: 120px;
            height: 120px;
            border: 8px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .qr-text {
            margin-top: 10px;
            font-size: 10px;
            color: #6b7280;
        }

        /* FOOTER */
        .footer {
            background: #1e3a8a;
            color: white;
            padding: 20px 30px;
            text-align: center;
            font-size: 10px;
        }

        .footer .contact {
            margin: 8px 0;
            opacity: 0.9;
        }

        .footer .legal {
            margin-top: 15px;
            font-size: 9px;
            opacity: 0.7;
            line-height: 1.4;
        }

        .text-bold {
            font-weight: 700;
        }

        .text-right {
            text-align: right;
        }

        .mt-1 {
            margin-top: 0.25rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- ENCABEZADO -->
        <div class="header">

            <h1>PÓLIZA DE SEGURO AUTOMOTRIZ</h1>
            <div class="subtitle">Protección Total para tu Vehículo</div>
            <div class="poliza-number">#{{ $poliza->numero_poliza }}</div>
        </div>

        <div class="content">

            <!-- DATOS DEL ASEGURADO -->
            <div class="section">
                <h3><i class="fas fa-user"></i> Asegurado</h3>
                <table>
                    <tr>
                        <th>Nombre Completo</th>
                        <td>{{ $poliza->vehiculo->cliente->nombre }} {{ $poliza->vehiculo->cliente->paterno }}
                            {{ $poliza->vehiculo->cliente->materno ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>CI</th>
                        <td>{{ $poliza->vehiculo->cliente->CI }}</td>
                    </tr>
                    <tr>
                        <th>Teléfono</th>
                        <td>{{ $poliza->vehiculo->cliente->telefono }}</td>
                    </tr>
                    <tr>
                        <th>Correo</th>
                        <td>{{ $poliza->vehiculo->cliente->correo }}</td>
                    </tr>
                </table>
            </div>

            <!-- DATOS DEL VEHÍCULO -->
            <div class="section">
                <h3><i class="fas fa-car"></i> Vehículo Asegurado</h3>
                <table>
                    <tr>
                        <th>Placa</th>
                        <td><strong>{{ $poliza->vehiculo->placa }}</strong></td>
                        <th>Marca / Modelo</th>
                        <td>{{ $poliza->vehiculo->modelo->marca->nombre ?? 'N/A' }}
                            {{ $poliza->vehiculo->modelo->nombre ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Año</th>
                        <td>{{ $poliza->vehiculo->anio_fabricacion }}</td>
                        <th>Color</th>
                        <td>{{ ucfirst($poliza->vehiculo->color) }}</td>
                    </tr>
                    <tr>
                        <th>Chasis</th>
                        <td>{{ $poliza->vehiculo->nro_chasis }}</td>
                        <th>Motor</th>
                        <td>{{ $poliza->vehiculo->nro_motor }}</td>
                    </tr>
                    <tr>
                        <th>Uso</th>
                        <td>{{ ucfirst($poliza->vehiculo->uso_vehiculo) }}</td>
                        <th>Región</th>
                        <td>{{ ucwords(str_replace('_', ' ', $poliza->vehiculo->region)) }}</td>
                    </tr>
                    <tr>
                        <th>Valor Comercial</th>
                        <td><strong>Bs. {{ number_format($poliza->vehiculo->valor_comercial, 2) }}</strong></td>
                        <th>Kilometraje</th>
                        <td>{{ $poliza->vehiculo->kilometraje ? number_format($poliza->vehiculo->kilometraje) . ' km' : 'No especificado' }}
                        </td>
                    </tr>
                </table>
            </div>

            <!-- COBERTURA -->
            <div class="section">
                <h3><i class="fas fa-shield-alt"></i> Cobertura del Seguro</h3>
                <table>
                    <tr>
                        <th>Tipo de Cobertura</th>
                        <td>
                            @if (str_contains($poliza->seguro->nombre, 'Total'))
                                <span class="badge badge-total">COBERTURA TOTAL</span>
                            @else
                                <span class="badge badge-terceros">A TERCEROS</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Prima Total</th>
                        <td><strong style="font-size: 18px; color: #1e3a8a;">Bs.
                                {{ number_format($prima->monto) }}</strong></td>
                    </tr>
                    <tr>
                        <th>Vigencia</th>
                        <td>
                            <strong>Desde:</strong>
                            {{ \Carbon\Carbon::parse($poliza->fecha_emision)->format('d/m/Y') }} <br>
                            <strong>Hasta:</strong>
                            {{ \Carbon\Carbon::parse($poliza->fecha_vencimiento)->format('d/m/Y') }}
                            <span class="badge badge-success" style="margin-left: 10px;">VIGENTE</span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- QR DE VERIFICACIÓN -->
            <div class="qr-container">
                @php
                    $qrText =
                        "Póliza: {$poliza->numero_poliza}\nPlaca: {$poliza->vehiculo->placa}\nVálida hasta: " .
                        \Carbon\Carbon::parse($poliza->fecha_vencimiento)->format('d/m/Y');
                    $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($qrText);
                @endphp
                <img src="{{ $qrUrl }}" alt="QR Póliza">
                <div class="qr-text">Escanea para verificar autenticidad</div>
            </div>

            <!-- NOTA LEGAL -->
            <div class="section" style="background: #fef3c7; border-left-color: #f59e0b;">
                <h3><i class="fas fa-exclamation-triangle"></i> Condiciones Generales</h3>
                <ul style="margin: 10px 0; padding-left: 20px; font-size: 10px;">
                    <li>Esta póliza cubre daños a terceros y/o robo total según cobertura contratada.</li>
                    <li>Exclusiones: conducción bajo efectos del alcohol, uso no autorizado, siniestros fuera de
                        Bolivia.</li>
                    <li>Reportar siniestros en menos de 48 horas al <strong>693-348-68</strong>.</li>
                    <li>La compañía se reserva el derecho de inspección del vehículo.</li>
                </ul>
            </div>

        </div>

        <!-- PIE DE PÁGINA -->
        <div class="footer">
            <div class="contact">
                <strong>Seguros PANK S.A.</strong> | MP6J+HJP Urkupiña, Av. Circunvalacion Noroeste, Montero<br>
                <i class="fas fa-phone"></i> (2) 693-348-68 | <i class="fas fa-envelope"></i> info@pankseguros.com
            </div>
            <div class="legal">
                Documento generado electrónicamente el {{ now()->format('d/m/Y \a \l\a\s H:i') }}<br>
                Validez legal conforme a Ley 453 y normativa de la APS. No requiere firma física.
            </div>
        </div>

    </div>

</body>

</html>
