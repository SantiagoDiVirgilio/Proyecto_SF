<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset='utf-8' />
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
  <style>
    body { 
      font-family: Arial, sans-serif;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      margin: auto; 
    }
    
    .modal {
      display: none; 
      position: fixed; 
      z-index: 1000; 
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0,0,0,0.5); 
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

    .fc-day-today {
      background-color: inherit !important;
    }
    .evento-reservado .fc-event-title {
      text-align: center; 
      width: 100%; 
      display: flex;
      align-items: center;
      justify-content: center; 
      height: 100%;
    }
    
    body.en-modal {
      background-color: transparent; 
    }
    body.en-modal #page-header,
    body.en-modal #page-footer {
      display: none; 
    }
    #btnCerrarModal {
      display: none; 
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

<body id="calendario-body">
  <div id="page-header">
  </div>
  <div id="page-container">
  <div id='calendar' class="superCalendario"></div>

 
  <div id="reservaModal" class="modal">
    <div class="modal-content">
      <h3>Confirmar Reserva</h3>
      <p id="infoReserva"></p>      
        <input type="text" id="nombreCliente" placeholder="Ingrese su nombre">     
        <input type="text" id="telefonoCliente" placeholder="Ingrese su telefono">      
        <button id="btnConfirmarReserva" >Reservar </button>      
        <button id="btnCancelarReserva" type="button">Cancelar</button>     
    </div>
  </div>
  </div>

  <button id="btnCerrarModal">Cerrar</button>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
  

    const calendarEl = document.getElementById('calendar');
    const modal = document.getElementById('reservaModal');
    const infoReservaEl = document.getElementById('infoReserva');
    const nombreClienteInput = document.getElementById('nombreCliente');
    const telefonoClienteInput = document.getElementById('telefonoCliente');
    const btnConfirmar = document.getElementById('btnConfirmarReserva');
    const btnCancelar = document.getElementById('btnCancelarReserva');
    let selectionInfo = null; 

    const urlParams = new URLSearchParams(window.location.search); 
    const esModal = urlParams.get('modal') === 'true';
    const idCancha = urlParams.get('id_cancha') || '1';
    
    if (esModal) {
        document.body.classList.add('en-modal');
        const btnCerrar = document.getElementById('btnCerrarModal');
        btnCerrar.style.display = 'block';
        btnCerrar.onclick = function() {
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
      titleFormat: {
        month: 'long',
        year: 'numeric'
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
              //display: 'background',
              display: "background", 
              backgroundColor: '#00ff3cff',         
            }         
          ]
        }
      ],
      
      selectAllow: function(selectInfo) {  
        let duration = selectInfo.end.getTime() - selectInfo.start.getTime();
        return duration <= 3600000;
      },
      select: function(info) {
        selectionInfo = info;

        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        const fechaInicio = info.start.toLocaleDateString('es-ES', options);
        infoReservaEl.innerText = `Horario seleccionado: ${fechaInicio}`;    
    
        nombreClienteInput.value = '';
        telefonoClienteInput.value='';
        modal.style.display = "block";
      }
    });
    
    btnConfirmar.onclick = function(event) { 
      
      event.preventDefault();

      const nombreCliente = nombreClienteInput.value;
      const numeroTelefono = telefonoClienteInput.value;

      if (!nombreCliente || !numeroTelefono) {
        alert("Por favor, ingrese su nombre y teléfono.");
        return;
      }
      if (!selectionInfo) return;

      
      const formData = new FormData();
      formData.append('nombre', nombreCliente);
      formData.append('telefono', numeroTelefono);
     
      formData.append('fecha_reserva', selectionInfo.start.toISOString().split('T')[0]); // Formato YYYY-MM-DD
      formData.append('hora_inicio', selectionInfo.start.getHours()); // Formato 24h (ej: 18)
      formData.append('hora_fin', selectionInfo.end.getHours()); // Formato 24h (ej: 19)
      formData.append('id_cancha', idCancha);

      fetch('registro_reserva.php', {
        method: 'POST',
        body: formData 
      })
      .then(response => response.json())
      .then(reservaData => {
        if (reservaData.success && reservaData.id_reserva) {
   
          window.location.href = `pago.php?id_cancha=${idCancha}&id_reserva=${reservaData.id_reserva}`;
        } else {
        
          throw new Error('Error al guardar la reserva: ' + reservaData.message);
        }
      })
      .catch(error => {
        console.error('Error en el proceso de reserva y pago:', error);
        alert('Ocurrió un error: ' + error.message);
     
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
     