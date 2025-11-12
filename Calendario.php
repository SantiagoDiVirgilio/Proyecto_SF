<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset='utf-8' />
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
  <style>
    body { 
      font-family: Arial, sans-serif;
      /* --- AÑADIDO: Aseguramos que el body ocupe toda la altura y usamos flexbox para el layout --- */
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: auto; 
    }
    
    .modal {
      display: none; /* Oculto por defecto */
      position: fixed; 
      z-index: 1000; 
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5); /* Fondo oscuro semitransparente */
    }
    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
      max-width: 400px;
      border-radius: 10px;
      text-align: center;
    }
    .modal-content input {
      width: calc(100% - 20px);
      padding: 10px;
      margin-top: 10px;
      margin-bottom: 20px;
    }
    .modal-content button {
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    #btnConfirmarReserva { background-color: #28a745; color: white; }
    #btnCancelarReserva { background-color: #dc3545; color: white; }

    /* Regla para quitar el fondo amarillo del día actual */
    .fc-day-today {
      background-color: inherit !important;
    }
    /* Estilos para alinear el texto del evento */
    .evento-reservado .fc-event-title {
      text-align: center; /* Centra el texto horizontalmente */
      width: 100%; /* Asegura que ocupe todo el ancho */
      display: flex;
      align-items: center; /* Centra verticalmente */
      justify-content: center; /* Centra horizontalmente (para flex) */
      height: 100%;
    }
    
    /* Estilos para cuando la página se carga en un modal */
    body.en-modal {
      background-color: transparent; /* Fondo transparente para que se vea el del modal padre */
    }
    body.en-modal #page-header,
    body.en-modal #page-footer {
      display: none; /* Oculta header y footer */
    }
    #btnCerrarModal {
      display: none; /* Oculto por defecto */
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1001;
      padding: 10px 20px;
      background-color: #6c757d;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    #SuperCalendario{
      max-width: 150px;
    }

  </style>
</head>
<?php
  //include("pago.php");
?>

<body id="calendario-body">
  <div id="page-header">
    <?php
      // Si tienes un NAV.php o header, debería ir aquí.
      // include("NAV.php"); 
    ?>
  </div>
  <div id="page-container">
  <div id='calendar' class="superCalendario"></div>

  <!-- HTML del Modal para confirmar la reserva -->
  <div id="reservaModal" class="modal">
    <div class="modal-content">
      <h3>Confirmar Reserva</h3>
      <p id="infoReserva"></p>      
        <input type="text" id="nombreCliente" placeholder="Ingrese su nombre">     
        <input type="text" id="telefonoCliente" placeholder="Ingrese su telefono">      
        <button id="btnConfirmarReserva" id="walletBrick_container">Reservar</button>      
        <button id="btnCancelarReserva" 
        type="button">Cancelar</button>     
    </div>
  </div>
  </div>

  <button id="btnCerrarModal">Cerrar</button>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    // No se necesita aquí, se define más abajo

    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById('reservaModal');
    const infoReservaEl = document.getElementById('infoReserva');
    const nombreClienteInput = document.getElementById('nombreCliente');
    const telefonoClienteInput = document.getElementById('telefonoCliente');
    const btnConfirmar = document.getElementById('btnConfirmarReserva');
    const btnCancelar = document.getElementById('btnCancelarReserva');
    let selectionInfo = null; // Para guardar la información de la selección

    const urlParams = new URLSearchParams(window.location.search); // Declaración única
    const esModal = urlParams.get('modal') === 'true';
    const idCancha = urlParams.get('id_cancha') || '1';
    
    if (esModal) {
        document.body.classList.add('en-modal');
        const btnCerrar = document.getElementById('btnCerrarModal');
        btnCerrar.style.display = 'block';
        btnCerrar.onclick = function() {
            // Llama a la función para cerrar el modal en la ventana padre
            if (window.parent && typeof window.parent.closeCalendarioModal === 'function') {
                window.parent.closeCalendarioModal();
            }
        };
    }

     const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGrid7Day',
      headerToolbar: {
        left: '',
        center: 'title',
        right: '',      
      },
      selectable: true,
      unselectAuto: true,
      selectMirror: true,
      
      views: {
        timeGrid7Day: {
          type: 'timeGrid',
          duration: { days: 8 },
          buttonText: '7 días'
        }
      },
      allDaySlot: false,
      slotMinTime: '08:00:00',
      slotMaxTime: '24:00:00',
      slotDuration: '01:00:00',
      height: 'auto',
      locale: 'es',
    //formato del dia
      dayHeaderFormat: {
        weekday: 'long',
        day: 'numeric',
        month: 'numeric'
      },
      //selectOverlap: false,
      // Permite la selección solo si es de exactamente 1 hora
      selectAllow: function(selectInfo) {
        let duration = selectInfo.end.getTime() - selectInfo.start.getTime();
        // La duración de una hora en milisegundos es 3600000
        return duration == 3600000;
      },

      eventSources: [   
        {
          url: `obtener_reservas.php?id_cancha=${idCancha}`,
          failure: function() {
            alert('Error al cargar las reservas desde el servidor.');
          }
        },
        {
          events: [
            {
              daysOfWeek: [ 0, 1, 2, 3, 4, 5, 6 ], 
              startTime: '08:00:00',
              endTime: '24:00:00',   
              display: 'background', 
              backgroundColor: '#00ff3cff' // Un verde más suave y legible
            }         
          ]
        }
      ],
      select: function(info) {
        // Guardar la información de la selección
        selectionInfo = info;

        // Formatear y mostrar la fecha y hora en el modal
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        const fechaInicio = info.start.toLocaleDateString('es-ES', options);
        infoReservaEl.innerText = `Horario seleccionado: ${fechaInicio}`;
        
        // Limpiar el input y mostrar el modal
        nombreClienteInput.value = '';
        telefonoClienteInput.value='';
        modal.style.display = "block";
      }
    });
    // Lógica de los botones del modal
    btnConfirmar.onclick = function(event) { 
      // Prevenir que el formulario se envíe de la forma tradicional
      event.preventDefault();

      const nombreCliente = nombreClienteInput.value;
      const numeroTelefono = telefonoClienteInput.value;

      if (!nombreCliente || !numeroTelefono) {
        alert("Por favor, ingrese su nombre y teléfono.");
        return;
      }
      if (!selectionInfo) return;

      // Preparar los datos para enviar
      const formData = new FormData();
      formData.append('nombre', nombreCliente);
      formData.append('telefono', numeroTelefono);
      // Extraemos los datos de fecha y hora del objeto 'selectionInfo'
      formData.append('fecha_reserva', selectionInfo.start.toISOString().split('T')[0]); // Formato YYYY-MM-DD
      formData.append('hora_inicio', selectionInfo.start.getHours()); // Formato 24h (ej: 18)
      formData.append('hora_fin', selectionInfo.end.getHours()); // Formato 24h (ej: 19)
      // Datos que asumimos o hardcodeamos por ahora
      formData.append('id_cancha', idCancha);

      // Enviar los datos al servidor usando fetch (AJAX)
      fetch('registro_reserva.php', {
        method: 'POST',
        body: new URLSearchParams(formData) // Usamos URLSearchParams para formato x-www-form-urlencoded
      })
      .then(response => response.json())
      .then(reservaData => {
        if (reservaData.success && reservaData.id_reserva) {
          // 1. La reserva se creó en nuestra BD. Ahora creamos la preferencia de pago en Mercado Pago.
          const urlPreferencia = new URL('crear_preferencia.php', window.location.origin + window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/')) + '/');
          urlPreferencia.searchParams.append('id_cancha', idCancha);
          urlPreferencia.searchParams.append('id_reserva', reservaData.id_reserva);

          // 2. Llamamos a crear_preferencia.php para obtener el link de pago.
          return fetch(urlPreferencia);
        } else {
          // Si la creación de la reserva falló, lanzamos un error.
          throw new Error('Error al guardar la reserva: ' + reservaData.message);
        }
      })
      .then(response => response.json())
      .then(preferenciaData => {
        if (preferenciaData.init_point) {
          // 3. Si obtuvimos el link de pago (init_point), redirigimos al usuario a Mercado Pago.
          window.location.href = preferenciaData.init_point;
        } else {
          // Si la creación de la preferencia falló, lanzamos un error.
          throw new Error('Error al crear la preferencia de pago.');
        }
      })
      .catch(error => {
        console.error('Error en el proceso de reserva y pago:', error);
        alert('Ocurrió un error: ' + error.message);
        // Cerramos el modal si algo falla para que el usuario pueda intentarlo de nuevo.
        modal.style.display = "none";
        calendar.unselect();
      });
    }

    btnCancelar.onclick = function() {
      modal.style.display = "none";
      calendar.unselect();
    }
    calendar.render();
  });
  </script>
</body>
</html>
     