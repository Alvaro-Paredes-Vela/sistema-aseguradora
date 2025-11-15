<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Factura {{ $factura->nro_factura }} - PANKEJ</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 25px;
            font-size: 12px;
            color: #000;
            background: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #1e40af;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 8px 0;
            font-size: 22px;
            font-weight: 700;
            color: #1e40af;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header .subtitle {
            font-size: 14px;
            color: #1e40af;
            font-weight: 600;
        }

        .info {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 11px;
        }

        .info td {
            padding: 6px 10px;
            vertical-align: top;
        }

        .label {
            font-weight: 700;
            width: 35%;
            color: #1e40af;
        }

        .detail-table {
            width: 100%;
            border: 1.5px solid #1e40af;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 11px;
        }

        .detail-table th,
        .detail-table td {
            border: 1px solid #1e40af;
            padding: 10px;
            text-align: left;
        }

        .detail-table th {
            background: #dbeafe;
            font-weight: 700;
            color: #1e40af;
            text-transform: uppercase;
            font-size: 10px;
        }

        .text-right {
            text-align: right;
        }

        .total {
            font-weight: 700;
            font-size: 15px;
            background: #eff6ff !important;
            color: #1e40af;
        }

        .control {
            margin: 18px 0;
            font-size: 11px;
        }

        .control strong {
            color: #1e40af;
        }

        .footer {
            margin-top: 40px;
            font-size: 9px;
            text-align: center;
            color: #6b7280;
            line-height: 1.4;
        }

        .company-info {
            text-align: center;
            margin-bottom: 15px;
            font-size: 10px;
            color: #4b5563;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>ASEGURADORA PANKEJ</h1>
        <div class="subtitle">Seguros y Reaseguros Personales</div>
    </div>

    <div class="company-info">
        <strong>PANKEJ S.R.L.</strong> | NIT: 123456789 | Av. Principal #123, Santa Cruz - Bolivia<br>
        Tel: (+591) 693-34868 | Email: info@pankej.com | www.pankej.com
    </div>

    <table class="info">
        <tr>
            <td class="label">NRO. FACTURA:</td>
            <td><strong>{{ str_pad($factura->nro_factura, 6, '0', STR_PAD_LEFT) }}</strong></td>
            <td class="label">FECHA EMISIÓN:</td>
            @php
                $fechaEmision = \Carbon\Carbon::hasFormat($factura->fecha_emision, 'Y-m-d')
                    ? \Carbon\Carbon::parse($factura->fecha_emision)
                    : now();
            @endphp
            <td>{{ $fechaEmision->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td class="label">CLIENTE:</td>
            <td colspan="3"><strong>{{ $factura->razon_social }}</strong></td>
        </tr>
        <tr>
            <td class="label">NIT / C.I.:</td>
            <td colspan="3">{{ $factura->pago->venta->cliente->CI ?? '—' }}</td>
        </tr>
    </table>

    <h3 style="text-align: center; margin: 20px 0; color: #1e40af; font-size: 14px; font-weight: 700;">
        DETALLE DE SERVICIO
    </h3>

    <table class="detail-table">
        <thead>
            <tr>
                <th>DESCRIPCIÓN</th>
                <th class="text-right">IMPORTE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $factura->descripcion }}</td>
                <td class="text-right">Bs. {{ number_format($factura->monto) }}</td>
            </tr>
            <tr class="total">
                <td class="text-right"><strong>TOTAL A PAGAR:</strong></td>
                <td class="text-right"><strong>Bs. {{ number_format($factura->monto) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div style="margin: 25px 0; font-size: 12px;">
        <strong>SON:</strong> {{ $factura->son_letras }}
    </div>

    <div class="control">
        <strong>CÓDIGO DE CONTROL:</strong> {{ $factura->codigo_control }}
    </div>

    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-top: 20px;">
        <div style="font-size: 10px; max-width: 70%;">
            @php
                $fechalimite = \Carbon\Carbon::hasFormat($factura->fecha_limite_emision, 'Y-m-d')
                    ? \Carbon\Carbon::parse($factura->fecha_limite_emision)
                    : now();
            @endphp
            <strong>FECHA LÍMITE DE EMISIÓN:</strong> {{ $fechalimite->format('d/m/Y') }}<br><br>
            <em>
                "ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAÍS, EL USO ILÍCITO DE ESTA SERÁ SANCIONADO DE ACUERDO A
                LEY"<br>
                Ley N° 453: La interrupción del servicio debe comunicarse con anterioridad a las autoridades.
            </em>
        </div>
        <div class="qr">
            <!-- QR opcional -->
        </div>
    </div>

    <div class="footer">
        <strong>PANKEJ</strong> - Tu seguridad es nuestra prioridad.<br>
        Gracias por confiar en nosotros.
    </div>

</body>

</html>
