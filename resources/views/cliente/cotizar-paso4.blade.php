<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización Generada - Aseguradora Pankej</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Orbitron:wght@700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* TODO EL CSS ANTERIOR - SIN CAMBIOS */
        :root {
            --pankej-blue: #1e3a8a;
            --pankej-orange: #f59e0b;
            --pankej-light: #e3f2fd;
            --white: #ffffff;
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

        .step-header {
            background: linear-gradient(135deg, var(--pankej-blue), #3b82f6);
            color: white;
            border-radius: 20px 20px 0 0;
        }

        .step-number.completed {
            background: #10b981;
        }

        .pdf-container {
            background: var(--white);
            border-radius: 0 0 20px 20px;
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

        .auto-xkm {
            background: var(--pankej-orange);
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

        .paquete-info {
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

        .caracteristicas {
            padding: 1.5rem;
            background: var(--white);
            border-top: 3px solid var(--pankej-blue);
            border-bottom: 3px solid var(--pankej-blue);
        }

        .carac-title {
            text-align: center;
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--pankej-blue);
            margin-bottom: 1.5rem;
        }

        .carac-grid {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .carac-item {
            flex: 1;
            text-align: center;
        }

        .carac-circle {
            width: 50px;
            height: 50px;
            background: var(--pankej-orange);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            margin: 0 auto 0.5rem;
        }

        .carac-text {
            font-weight: 600;
            margin-bottom: 0.3rem;
            font-size: 0.85rem;
        }

        .carac-desc {
            font-size: 0.7rem;
            color: #374151;
            line-height: 1.3;
        }

        .mapa-section {
            background: var(--pankej-light);
            padding: 1rem;
            text-align: center;
        }

        .mapa-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 0.5rem 0;
        }

        .mapa-point {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--pankej-blue);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.8rem;
        }

        .mapa-label {
            font-weight: 600;
            color: var(--pankej-blue);
            font-size: 0.8rem;
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

        .pago-section {
            padding: 1.5rem;
            background: #f8fafc;
        }

        .pago-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .pago-box {
            border: 2px solid var(--pankej-blue);
            padding: 1rem;
            border-radius: 8px;
            background: var(--white);
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
    </style>
</head>

<body>
    <!-- TODO EL HTML ANTERIOR - SIN CAMBIOS -->
    <section class="step-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- CONTENIDO PDF - ID PARA CAPTURA -->
                    <div class="pdf-container" id="pdf-content">
                        <!-- HEADER PÁNKEJ -->
                        <div class="pdf-header">
                            <div class="logo-pankej">P</div>
                            <div class="header-title">ASEGURADORA PÁNKEJ</div>
                            <div class="auto-xkm">Auto x km</div>
                        </div>

                        <!-- TÍTULO -->
                        <div class="pdf-title-section">
                            <div class="pdf-title-main">UNA PÓLIZA QUE</div>
                            <div class="pdf-title-main" style="color: var(--pankej-orange);">SE ADAPTA A TI</div>
                            <div class="d-flex justify-content-center mt-3">
                                <div class="paquete-info">
                                    <div>Paquete Km</div>
                                    <div>{{ request('paquete_km') }} km</div>
                                </div>
                                <div class="paquete-info">
                                    <div>Valor asegurado</div>
                                    <div>Bs 27.500,00</div>
                                </div>
                            </div>
                        </div>

                        <!-- SLIP CONTRATANTE -->
                        <div class="slip-section">
                            <div class="section-title">SLIP DE COTIZACIÓN</div>
                            <div class="form-grid">
                                <div>
                                    <div class="form-field">{{ request('nombres') }} {{ request('apellidos') }}</div>
                                    <div class="field-label">Nombre Contratante</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ request('ci') }}</div>
                                    <div class="field-label">C.I.</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ request('email') }}</div>
                                    <div class="field-label">Email</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ request('celular') }}</div>
                                    <div class="field-label">Celular</div>
                                </div>
                            </div>
                        </div>

                        <!-- VEHÍCULO -->
                        <div class="slip-section">
                            <div class="section-title">DATOS DEL VEHÍCULO</div>
                            <div class="form-grid vehiculo-grid">
                                <div>
                                    <div class="form-field">{{ request('marca') }}</div>
                                    <div class="field-label">Marca</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ request('tipo_vehiculo') }}</div>
                                    <div class="field-label">Tipo</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ request('modelo') }}</div>
                                    <div class="field-label">Modelo</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ request('placa') }}</div>
                                    <div class="field-label">Placa</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ request('anio') }}</div>
                                    <div class="field-label">Año</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ request('color') }}</div>
                                    <div class="field-label">Color</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ request('procedencia') }}</div>
                                    <div class="field-label">Procedencia</div>
                                </div>
                                <div>
                                    <div class="form-field">{{ request('pasajeros') }}</div>
                                    <div class="field-label">N° pasajeros</div>
                                </div>
                            </div>
                        </div>

                        <!-- CARACTERÍSTICAS + MAPA -->
                        <div class="caracteristicas">
                            <div class="carac-title">PRINCIPALES CARACTERÍSTICAS</div>
                            <div class="carac-grid">
                                <div class="carac-item">
                                    <div class="carac-circle">1</div>
                                    <div class="carac-text">Control de km recorridos</div>
                                    <div class="carac-desc">Dispositivo instalado en la cabina del vehículo y puede
                                        controlar los km recorridos desde la app Pankej</div>
                                </div>
                                <div class="carac-item">
                                    <div class="carac-circle">2</div>
                                    <div class="carac-text">Las vigencias se inician en fechas indicadas</div>
                                    <div class="carac-desc">en los contratos y finalizan un año después, sin considerar
                                        días extras que surjan del control de km</div>
                                </div>
                                <div class="carac-item">
                                    <div class="carac-circle">3</div>
                                    <div class="carac-text">Sección voluntaria para causas de partes</div>
                                    <div class="carac-desc">Se contrata la cobertura para las partes del vehículo que
                                        excedan los km pactados de uso anual</div>
                                </div>
                            </div>

                            <div class="mapa-section">
                                <div class="mapa-line">
                                    <div class="mapa-point">C</div>
                                    <div style="flex: 1; height: 2px; background: var(--pankej-blue);"></div>
                                    <div class="mapa-point">O</div>
                                    <div style="flex: 1; height: 2px; background: var(--pankej-blue);"></div>
                                    <div class="mapa-point">G</div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <div class="mapa-label">CASA</div>
                                    <div class="mapa-label">OFICINA</div>
                                    <div class="mapa-label">GYM</div>
                                </div>
                            </div>
                        </div>

                        <!-- COBERTURAS -->
                        <div class="coberturas">
                            <div class="cobertura-box">
                                <div class="cobertura-title">COBERTURAS PARA EL VEHÍCULO</div>
                                <div class="cobertura-item">Daños materiales 70% del valor del vehículo</div>
                                <div class="cobertura-item">Robo total con encaro de 20%</div>
                                <div class="cobertura-item">Daños a terceros hasta Bs 100.000</div>
                            </div>
                            <div class="cobertura-box">
                                <div class="cobertura-title">COBERTURAS PARA OCUPANTES Y TERCEROS</div>
                                <div class="cobertura-item">Gastos médicos hasta Bs 70.000 por fallecimiento</div>
                                <div class="cobertura-item">Beneficio por muerte y/o incapacidad total y permanente
                                </div>
                            </div>
                        </div>

                        <!-- FORMA DE PAGO -->
                        <div class="pago-section">
                            @php
                                $precios = [
                                    2500 => ['contado' => 380.0, 'credito' => 190.0],
                                    5000 => ['contado' => 474.82, 'credito' => 237.41],
                                    7500 => ['contado' => 587.46, 'credito' => 293.73],
                                    10000 => ['contado' => 699.87, 'credito' => 349.94],
                                ];
                                $paquete = request('paquete_km');
                                $precio = $precios[$paquete] ?? $precios[2500];
                            @endphp
                            <div class="section-title">FORMA DE PAGO</div>
                            <div class="pago-grid">
                                <div class="pago-box">
                                    <div><strong>Pago al contado:</strong></div>
                                    <div class="fs-4 fw-bold text-success">Bs
                                        {{ number_format($precio['contado'], 2, ',', '.') }}</div>
                                </div>
                                <div class="pago-box">
                                    <div><strong>Pago al crédito:</strong></div>
                                    <div>Cuota inicial (50%) Bs {{ number_format($precio['credito'], 2, ',', '.') }} +
                                        1 pago</div>
                                </div>
                            </div>

                            <div class="vigencia-grid">
                                <div class="vigencia-field">Vigencia desde: {{ date('d/m/Y') }}</div>
                                <div class="vigencia-field">Vigencia hasta: {{ date('d/m/Y', strtotime('+1 year')) }}
                                </div>
                            </div>
                            <div class="vigencia-field" style="grid-column: 1 / -1;">Lugar y fecha: Santa Cruz
                                {{ date('d/m/Y') }}</div>
                            <small class="text-muted d-block mt-2">La presente cotización tiene validez de 30 días a
                                partir de la presente fecha.</small>
                        </div>

                        <!-- FOOTER PÁNKEJ -->
                        <div class="footer-section">
                            <div class="footer-grid">
                                <div class="footer-item">
                                    <div>800 10 911</div>
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
                                    <div>Santa Cruz</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BOTÓN DESCARGAR (FUERA DEL PDF) -->
                    <div class="p-4 text-center">
                        <button onclick="descargarPDF()" class="btn btn-descargar">
                            <i class="fas fa-download me-2"></i>DESCARGAR COTIZACIÓN PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LIBRERÍAS PDF PROFESIONAL -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        function descargarPDF() {
            // MOSTRAR CARGA
            const btn = document.querySelector('.btn-descargar');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Generando PDF...';
            btn.disabled = true;

            // CAPTURAR EXACTO EL CONTENIDO VISUAL
            const element = document.getElementById('pdf-content');

            html2canvas(element, {
                scale: 2,
                useCORS: true,
                allowTaint: true,
                backgroundColor: '#ffffff',
                width: element.scrollWidth,
                height: element.scrollHeight,
                logging: false
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const {
                    jsPDF
                } = window.jspdf;
                const pdf = new jsPDF({
                    orientation: 'portrait',
                    unit: 'mm',
                    format: 'a4'
                });

                // DIMENSIONES A4
                const imgWidth = 210;
                const pageHeight = 295;
                const imgHeight = (canvas.height * imgWidth) / canvas.width;
                let heightLeft = imgHeight;

                // AGREGAR IMAGEN
                let position = 0;
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                // SI SOBREPASA PÁGINA, AGREGAR MÁS PÁGINAS
                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                // DESCARGAR
                pdf.save(`Cotizacion_Auto_x_Km_Pankej_${{ request('nombres') }}_${{ request('ci') }}.pdf`);

                // RESTAURAR BOTÓN
                btn.innerHTML = '<i class="fas fa-download me-2"></i>DESCARGAR COTIZACIÓN PDF';
                btn.disabled = false;
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al generar PDF. Intenta de nuevo.');
                btn.innerHTML = '<i class="fas fa-download me-2"></i>DESCARGAR COTIZACIÓN PDF';
                btn.disabled = false;
            });
        }
    </script>
</body>

</html>
