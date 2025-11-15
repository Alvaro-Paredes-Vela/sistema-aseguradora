<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Póliza SOAT - {{ $poliza->numero_poliza }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Orbitron:wght@700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pankej-blue: #1e3a8a;
            --pankej-orange: #f59e0b;
            --pankej-light: #e3f2fd;
            --white: #ffffff;
            --success: #10b981;
            --danger: #ef4444;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .step-container {
            background: #f8fafc;
            padding: 2rem 0;
            min-height: 100vh;
        }

        .pdf-container {
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1000px;
            margin: 0 auto;
        }

        .pdf-header {
            background: var(--pankej-blue);
            color: var(--white);
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
        }

        .logo-pankej {
            width: 35px;
            height: 35px;
            background: var(--white);
            color: var(--pankej-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Orbitron', sans-serif;
            font-weight: 900;
            font-size: 1rem;
            margin-right: 0.5rem;
        }

        .header-title {
            font-size: 1.1rem;
            font-weight: 700;
            flex: 1;
        }

        .soat-badge {
            background: var(--success);
            color: var(--white);
            border-radius: 20px;
            padding: 0.2rem 0.8rem;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .pdf-title-section {
            background: var(--pankej-light);
            padding: 1.5rem;
            text-align: center;
        }

        .pdf-title-main {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--pankej-blue);
            margin-bottom: 0.5rem;
        }

        .poliza-info {
            background: var(--white);
            border: 2px solid var(--pankej-orange);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            display: inline-block;
            margin: 0 0.5rem;
            font-weight: 600;
        }

        .slip-section {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--pankej-blue);
            margin-bottom: 1rem;
            text-decoration: underline;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 0.8rem;
            margin-bottom: 1.5rem;
        }

        .form-field {
            border: 2px solid var(--pankej-blue);
            padding: 0.6rem;
            border-radius: 5px;
            background: var(--white);
            min-height: 35px;
            display: flex;
            align-items: center;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .field-label {
            font-size: 0.7rem;
            color: #6b7280;
            margin-top: 0.2rem;
        }

        .vehiculo-grid {
            grid-template-columns: repeat(4, 1fr);
        }

        .coberturas {
            padding: 1.5rem;
        }

        .cobertura-box {
            background: var(--pankej-light);
            border-left: 5px solid var(--pankej-orange);
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .cobertura-title {
            font-weight: 700;
            color: var(--pankej-blue);
            margin-bottom: 0.8rem;
            font-size: 0.95rem;
        }

        .cobertura-item {
            padding-left: 1rem;
            position: relative;
            margin-bottom: 0.3rem;
            font-size: 0.8rem;
        }

        .cobertura-item::before {
            content: '●';
            color: var(--pankej-orange);
            font-size: 1rem;
            position: absolute;
            left: 0;
        }

        .vigencia-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.8rem;
            margin-top: 1rem;
        }

        .vigencia-field {
            border: 2px solid var(--pankej-blue);
            padding: 0.8rem;
            border-radius: 5px;
            background: var(--white);
            font-weight: 500;
        }

        .btn-descargar {
            background: linear-gradient(45deg, var(--pankej-orange), #ef4444);
            color: var(--white);
            border: none;
            padding: 1.2rem;
            font-weight: 700;
            width: 100%;
            font-size: 1.1rem;
            border-radius: 10px;
        }

        .footer-section {
            background: var(--pankej-blue);
            color: var(--white);
            padding: 1.5rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        .footer-item {
            text-align: center;
            font-size: 0.8rem;
        }

        .qr-container {
            text-align: center;
            margin: 1.5rem 0;
        }

        .qr-code {
            width: 150px;
            height: 150px;
            margin: 0 auto;
            border: 8px solid var(--white);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <section class="step-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- CONTENIDO PÓLIZA -->
                    <div class="pdf-container" id="pdf-content">
                        <!-- HEADER -->
                        <div class="pdf-header">
                            <div class="logo-pankej">P</div>
                            <div class="header-title">ASEGURADORA PÁNKEJ</div>
                            <div class="soat-badge">SOAT 2025</div>
                        </div>

                        <!-- TÍTULO -->
                        <div class="pdf-title-section">
                            <div class="pdf-title-main">PÓLIZA SOAT</div>
                            <div class="pdf-title-main" style="color: var(--pankej-orange);">VIGENTE</div>
                            <div class="d-flex justify-content-center mt-3">
                                <div class="poliza-info">
                                    <div>N° Póliza</div>
                                    <div>{{ $poliza->numero_poliza }}</div>
                                </div>
                                <div class="poliza-info">
                                    <div>Monto Pagado</div>
                                    <div>Bs {{ number_format($pago->monto) }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- DATOS DEL VEHÍCULO -->
                        <div class="slip-section">
                            <div class="section-title">DATOS DEL VEHÍCULO</div>
                            <div class="form-grid vehiculo-grid">
                                <div>
                                    <div class="form-field">{{ $poliza->vehiculo->marca->nombre ?? 'N/A' }}</div>
                                    <div class="field-label">Marca</div>
                                </div>
                                <div>
                                    <div class="form-field">
                                        {{ ucwords(str_replace('_', ' ', $poliza->vehiculo->tipo_vehiculo)) }}</div>
                                    <div class="field-label">Tipo</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ $poliza->vehiculo->modelo->nombre ?? 'N/A' }}</div>
                                    <div class="field-label">Modelo</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ $poliza->vehiculo->placa }}</div>
                                    <div class="field-label">Placa</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ $poliza->vehiculo->anio_fabricacion ?? 'N/A' }}</div>
                                    <div class="field-label">Año</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ $poliza->vehiculo->color ?? 'N/A' }}</div>
                                    <div class="field-label">Color</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ $poliza->vehiculo->RUAT ?? 'N/A' }}</div>
                                    <div class="field-label">RUAT</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ $poliza->vehiculo->nro_chasis ?? 'N/A' }}</div>
                                    <div class="field-label">Chasis</div>
                                </div>
                            </div>
                        </div>

                        <!-- DATOS DEL ASEGURADO -->
                        <div class="slip-section">
                            <div class="section-title">DATOS DEL ASEGURADO</div>
                            <div class="form-grid">
                                <div>
                                    <div class="form-field">
                                        {{ trim(collect([$poliza->vehiculo->cliente->nombre, $poliza->vehiculo->cliente->paterno, $poliza->vehiculo->cliente->materno])->filter()->implode(' ')) }}
                                    </div>
                                    <div class="field-label">Nombre Completo</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ $poliza->vehiculo->cliente->CI }}</div>
                                    <div class="field-label">C.I.</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ $poliza->vehiculo->cliente->telefono ?? 'N/A' }}</div>
                                    <div class="field-label">Teléfono</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ $poliza->vehiculo->cliente->email ?? 'N/A' }}</div>
                                    <div class="field-label">Email</div>
                                </div>
                            </div>
                        </div>

                        <!-- VIGENCIA -->
                        <div class="slip-section">
                            <div class="section-title">VIGENCIA DEL SEGURO</div>
                            <div class="vigencia-grid">
                                <div class="vigencia-field">
                                    <strong>Inicio:</strong>
                                    {{ \Carbon\Carbon::parse($poliza->fecha_emision)->format('d/m/Y') }}
                                </div>
                                <div class="vigencia-field">
                                    <strong>Fin:</strong>
                                    {{ \Carbon\Carbon::parse($poliza->fecha_vencimiento)->format('d/m/Y') }}
                                </div>
                            </div>
                            <div class="vigencia-field mt-3"
                                style="grid-column: 1 / -1; background: #d1fae5; color: #065f46; text-align: center;">
                                <strong>SOAT VIGENTE HASTA EL
                                    {{ \Carbon\Carbon::parse($poliza->fecha_vencimiento)->format('d/m/Y') }}</strong>
                            </div>
                        </div>

                        <!-- COBERTURAS -->
                        <div class="coberturas">
                            <div class="cobertura-box">
                                <div class="cobertura-title">COBERTURAS OBLIGATORIAS (Ley 1777)</div>
                                <div class="cobertura-item">Muerte: Bs. 50.000 por persona</div>
                                <div class="cobertura-item">Incapacidad Permanente: Bs. 30.000</div>
                                <div class="cobertura-item">Gastos Médicos: Bs. 5.000 por persona</div>
                                <div class="cobertura-item">Gastos de Sepelio: Bs. 3.000</div>
                            </div>
                            <div class="cobertura-box">
                                <div class="cobertura-title">CONDICIONES Y EXCLUSIONES</div>
                                <div class="cobertura-item">No aplica si el conductor está en estado de ebriedad</div>
                                <div class="cobertura-item">No cubre daños al vehículo asegurado</div>
                                <div class="cobertura-item">Válido solo en territorio boliviano</div>
                            </div>
                        </div>

                        <!-- QR VERIFICACIÓN -->
                        <div class="qr-container">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $poliza->numero_poliza }}"
                                alt="QR Verificación" class="qr-code">
                            <p class="mt-2 text-muted"><small>Escanea para verificar en soat.pankej.bo</small></p>
                        </div>

                        <!-- FOOTER -->
                        <div class="footer-section">
                            <div class="footer-grid">
                                <div class="footer-item">
                                    <div>693 34 868</div>
                                    <div>www.pankej.com.bo</div>
                                </div>
                                <div class="footer-item">
                                    <i class="fab fa-facebook"></i><br>
                                    <i class="fab fa-twitter"></i><br>
                                    <i class="fab fa-instagram"></i>
                                </div>
                                <div class="footer-item">
                                    <div style="font-weight: bold;">ASEGURADORA PÁNKEJ</div>
                                    <div>Seguros y Reaseguros Personales</div>
                                </div>
                                <div class="footer-item">
                                    <div>Santa Cruz - Bolivia</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BOTÓN DESCARGAR -->
                    <div class="p-4 text-center">
                        <button onclick="descargarPDF()" class="btn btn-descargar">
                            <i class="fas fa-download me-2"></i>DESCARGAR PÓLIZA SOAT
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCRIPTS PDF -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        function descargarPDF() {
            const btn = document.querySelector('.btn-descargar');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generando PDF...';
            btn.disabled = true;

            const element = document.getElementById('pdf-content');

            html2canvas(element, {
                scale: 2,
                useCORS: true,
                backgroundColor: '#ffffff'
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const {
                    jsPDF
                } = window.jspdf;
                const pdf = new jsPDF('p', 'mm', 'a4');

                const imgWidth = 210;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

                pdf.save(`SOAT_{{ $poliza->numero_poliza }}_Pankej.pdf`);

                btn.innerHTML = '<i class="fas fa-download me-2"></i>DESCARGAR PÓLIZA SOAT';
                btn.disabled = false;
            }).catch(() => {
                alert('Error al generar PDF');
                btn.innerHTML = '<i class="fas fa-download me-2"></i>DESCARGAR PÓLIZA SOAT';
                btn.disabled = false;
            });
        }
    </script>
</body>

</html>
