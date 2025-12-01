<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockPilot Texto Limpio</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* 1. ESTILOS DEL CONTENEDOR (HEADER) */
        .header-limpio {
            /* IMPORTANTE: No hay background-color o imagen aquí */
            height: 80px; /* Define la altura donde se centrará el texto */
            width: 100%;
            
            /* Configuraciones de FLEXBOX para CENTRADO PERFECTO */
            display: flex;
            align-items: center; /* Centrado Vertical */
            justify-content: center; /* Centrado Horizontal */
            
            /* El fondo real del recuadro azul lo manejará tu CSS principal o tu framework. 
               Aquí forzamos la transparencia total: */
            background: none; 
            background-color: transparent; 
            border: none;
            box-shadow: none;
        }

        /* 2. ESTILO DEL TEXTO "StockPilot" */
        .titulo-cabecera-final {
            font-family: 'Lato', sans-serif; /* Fuente limpia y legible */
            
            /* Color de texto blanco (asumiendo que el fondo de tu cabecera es oscuro) */
            color: #ffffff; 
            
            /* Tamaño: Visible pero elegante (2.8em) */
            font-size: 2.8em; 
            font-weight: 700; /* Negrita para buen impacto visual */
            
            /* Espaciado para un look refinado */
            letter-spacing: 4px; 
            
            /* Sombra de texto SUTIL, para que el texto "flote" sobre el fondo azul 
               sin tener un fondo propio (simula un PNG sin fondo) */
            text-shadow: 0 0 5px rgba(0, 0, 0, 0.4); 
            
            margin: 0;
            padding: 0;
            line-height: 1; /* Asegura que no haya espacio extra vertical */
        }

    </style>
</head>
<body>

    <header class="header-limpio">
        <h1 class="titulo-cabecera-final">StockPilot</h1>
    </header>

</body>
</html>