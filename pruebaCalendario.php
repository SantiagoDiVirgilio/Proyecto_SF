<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset='utf-8' />
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
  <style>
    body { font-family: Arial, sans-serif; }
    /* Estilos para el Modal (Pop-up) */
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
  </style>
</head>
<body>
  <div id='calendar'></div>

  <!-- HTML del Modal para confirmar la reserva -->
  <div id="reservaModal" class="modal">
    <div class="modal-content">
      <h3>Confirmar Reserva</h3>
      <p id="infoReserva"></p>
      <form action="registro_reserva.php" method="POST">
        <input type="text" id="nombreCliente" placeholder="Ingrese su nombre">
        <input type="text" id="telefonoCliente" placeholder="Ingrese su telefono">
        <button id="btnConfirmarReserva">Reservar</button>
        <button id="btnCancelarReserva" type="button">Cancelar</button>
      </form>
      
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById('reservaModal');
    const infoReservaEl = document.getElementById('infoReserva');
    const nombreClienteInput = document.getElementById('nombreCliente');
    const telefonoClienteInput = document.getElementById('telefonoCliente');
    const btnConfirmar = document.getElementById('btnConfirmarReserva');
    const btnCancelar = document.getElementById('btnCancelarReserva');
    let selectionInfo = null; // Para guardar la información de la selección

    const calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'timeGrid7Day',
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
      slotMaxTime: '22:00:00',
      slotDuration: '01:00:00',
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
          url: 'obtener_reservas.php?id_cancha=1', // <-- Corregido: Enviamos el ID de la cancha
          failure: function() {
            alert('Error al cargar las reservas desde el servidor.');
          }
        },
        {
          events: [
            {
              daysOfWeek: [ 0, 1, 2, 3, 4, 5, 6 ], 
              startTime: '08:00:00',
              endTime: '22:00:00',   
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
      formData.append('id_cancha', 1); // Asumimos cancha 1, esto debería ser dinámico
      formData.append('id_pago', 0); // Asumimos 0 si no hay pago aún
      formData.append('monto', 4000.00); // Precio de ejemplo

      // Enviar los datos al servidor usando fetch (AJAX)
      fetch('registro_reserva.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Si el servidor confirma que guardó, añadimos el evento visualmente
          calendar.addEvent({
            title: 'Reservado (' + nombreCliente + ')',
            start: selectionInfo.start,
            end: selectionInfo.end,
            backgroundColor: '#f8d7da',
            borderColor: '#ff0019ff',
            color:'black',
            overlap: false
          });
          alert('¡Reserva guardada con éxito!');
          modal.style.display = "none";
          calendar.unselect();
        } else {
          // Si hay un error, lo mostramos
          alert('Error al guardar la reserva: ' + data.message);
        }
      })
      .catch(error => {
        console.error('Error en la petición fetch:', error);
        alert('Ocurrió un error de conexión. No se pudo guardar la reserva.');
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
     
