<!DOCTYPE html>
<html lang='es'>
<head>
  <meta charset='utf-8' />
  <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/main.min.css' rel='stylesheet' />
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
  <style>
    #calendar {
      max-width: 1100px;
      margin: 40px auto;
    }
  </style>
</head>
<body>
  <div id='calendar'></div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const calendarEl = document.getElementById('calendar');

      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGrid7Day',
        selectable: true,
        unselectAuto: true,
        selectMirror: true,

        // Vista personalizada de 7 días
        views: {
          timeGrid7Day: {
            type: 'timeGrid',
            duration: { days: 7 },
            buttonText: '7 días'
          }
        },

        allDaySlot: false,
        slotMinTime: '08:00:00',
        slotMaxTime: '22:00:00',
        slotDuration: '01:00:00',
        locale: 'es',

        // 🟢 Ejemplo de eventos “disponible” y “reservado”
        events: [
          {
            title: 'Disponible',
            start: '2025-11-01T08:00:00',
            end: '2025-11-01T12:00:00',
            backgroundColor: '#b7e4c7', // verde claro
            borderColor: '#95d5b2'
          },
          {
            title: 'Reservado',
            start: '2025-11-01T13:00:00',
            end: '2025-11-01T16:00:00',
            backgroundColor: '#f8d7da', // rojo claro
            borderColor: '#f5c2c7'
          },
          {
            title: 'Disponible',
            start: '2025-11-02T09:00:00',
            end: '2025-11-02T18:00:00',
            backgroundColor: '#b7e4c7'
          }
        ],

        // 🖱️ Si querés que el usuario seleccione un horario y cambie el estado
        select: function(info) {
          const estado = prompt("Escribí 'reservado' o 'disponible':");
          if (!estado) return;

          let color;
          if (estado.toLowerCase() === 'reservado') {
            color = '#f8d7da';
          } else if (estado.toLowerCase() === 'disponible') {
            color = '#b7e4c7';
          } else {
            alert('Estado inválido.');
            return;
          }

          calendar.addEvent({
            title: estado.charAt(0).toUpperCase() + estado.slice(1),
            start: info.start,
            end: info.end,
            backgroundColor: color,
            borderColor: color
          });
        }
      });

      calendar.render();
    });
  </script>
</body>
</html>
     

