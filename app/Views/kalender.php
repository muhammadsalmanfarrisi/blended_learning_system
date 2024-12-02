<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Interaktif</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        /* Basic styles for the calendar */
        .calendar-container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .calendar-header h2 {
            font-size: 2rem;
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
            font-weight: 600;
        }

        /* Calendar grid layout */
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
        }

        /* Styling for date cells */
        .date-cell {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            font-size: 1rem;
            color: #495057;
        }

        .date-cell:hover,
        .date-cell.active {
            background-color: #007bff;
            color: white;
            transform: scale(1.05);
        }

        .day-number {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .event {
            margin-top: 5px;
            padding: 8px;
            font-size: 0.875rem;
            background-color: #007bff;
            color: #fff;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            cursor: pointer;
            margin-bottom: 5px;
        }

        .event:hover {
            background-color: #0056b3;
        }

        /* Styles for the event form */
        #eventForm {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 25px;
        }

        #eventDescription {
            flex: 1;
            font-size: 1rem;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        /* Styles for the footer */
        footer {
            margin-top: 30px;
            text-align: center;
            color: #adb5bd;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .calendar-grid {
                grid-template-columns: repeat(7, 1fr);
                gap: 5px;
            }

            #eventForm {
                flex-direction: column;
            }
        }

        /* Styling for weekdays header */
        .calendar-weekdays {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            text-align: center;
            font-weight: bold;
            color: #495057;
            margin-bottom: 10px;
        }

        .weekday {
            padding: 10px;
            background-color: #f1f1f1;
            border-radius: 8px;
            font-size: 1rem;
        }

        /* Styling for the days of the week (Sun, Mon, Tue, etc.) */
        .day-name {
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background-color: #f1f1f1;
            color: #343a40;
            border-radius: 8px;
        }

        /* Styling for the date cells */
        .date-cell {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            font-size: 1rem;
            color: #495057;
        }

        /* Styling for active date cells */
        .date-cell:hover,
        .date-cell.active {
            background-color: #007bff;
            color: white;
            transform: scale(1.05);
        }

        /* Adjust the day name font color */
        .day-name {
            background-color: #ddd;
            color: #495057;
        }
    </style>
</head>

<body class="d-flex flex-column" style="min-height: 100vh;">
    <?= view('layout/header'); ?>

    <div class="card container-fluid bg-primary text-white py-5" style="background-image: url('<?= base_url('images/bg_modul.jpg'); ?>'); background-size: cover; background-position: center;">
        <div class="container text-center">
            <h1 class="display-3 font-weight-bold mb-4" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); background-color: rgba(0, 0, 0, 0.5); padding: 10px;">
                Kalender Kegiatan
            </h1>
            <p class="lead mb-4" style="font-size: 1.25rem; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); background-color: rgba(0, 0, 0, 0.5); padding: 8px;">
                Ingat Kegiatan Setiap Hari
            </p>
            <div class="d-flex justify-content-center">
                <a href="#kalender" class="btn btn-primary btn-lg mx-2" style="text-transform: uppercase; padding: 12px 30px; font-size: 1.1rem;">
                    Lihat Jadwal Kegiatan
                </a>
            </div>
        </div>
    </div><br>

    <div class="container flex-grow-1">
        <div id="kalender" class="calendar-container">
            <div class="calendar-header">
                <button id="prevMonth" class="btn btn-secondary">Previous</button>
                <h2 id="currentMonth"><?= strftime('%B %Y'); ?></h2>
                <button id="nextMonth" class="btn btn-secondary">Next</button>
            </div>
            <div class="calendar-grid">
                <div class="day-name">Sun</div>
                <div class="day-name">Mon</div>
                <div class="day-name">Tue</div>
                <div class="day-name">Wed</div>
                <div class="day-name">Thu</div>
                <div class="day-name">Fri</div>
                <div class="day-name">Sat</div>
            </div><br>


            <!-- Calendar grid with dates -->
            <div class="calendar-grid" id="calendarGrid">
                <!-- Dates will be dynamically populated here -->
            </div>
            <?php if (in_groups('admin')) : ?>
                <!-- Form for adding events -->
                <form id="eventForm" method="post" action="<?= base_url('/calendar/addEvent') ?>">
                    <h5 class="card-title">Tambah/Edit Event</h5>
                    <input type="hidden" id="eventDate" name="date">
                    <input type="text" class="form-control" id="eventDescription" name="description" placeholder="Deskripsi event">
                    <button type="submit" class="btn btn-primary">Simpan Event</button>
                </form>
            <?php endif; ?>



        </div>
    </div>
    <div class="container flex-grow-1">
        <div id="kalender" class="calendar-container">
            <h2>Event Bulan Ini</h2><br>
            <ul class="list-group">
                <?php if (!empty($month_events)) : ?>
                    <?php foreach ($month_events as $event) : ?>
                        <li class="list-group-item">
                            <strong><?= date('d M Y', strtotime($event['event_date'])); ?></strong>:
                            <?= htmlspecialchars($event['event_description']); ?>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <li class="list-group-item">Tidak ada event untuk bulan ini.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <!-- Footer -->
    <?= view('layout/footer'); ?>

    <script>
        function updateEventList() {
            const month = currentDate.getMonth(); // Bulan saat ini (0-11)
            const year = currentDate.getFullYear(); // Tahun saat ini

            // Filter event berdasarkan bulan dan tahun
            const eventsThisMonth = events.filter(event => {
                const eventDate = new Date(event.event_date);
                return eventDate.getMonth() === month && eventDate.getFullYear() === year;
            });

            // Ambil elemen untuk daftar event
            const eventList = document.getElementById('eventList');
            eventList.innerHTML = ''; // Kosongkan daftar event sebelumnya

            if (eventsThisMonth.length > 0) {
                // Tampilkan setiap event dalam daftar
                eventsThisMonth.forEach(event => {
                    const listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = `${event.event_date}: ${event.event_description}`;
                    eventList.appendChild(listItem);
                });
            } else {
                // Tampilkan pesan jika tidak ada event
                const noEventItem = document.createElement('li');
                noEventItem.className = 'list-group-item text-muted text-center';
                noEventItem.textContent = 'Tidak ada event pada bulan ini.';
                eventList.appendChild(noEventItem);
            }
        }
        // Simpan data event ke dalam variabel JavaScript dalam format JSON
        // Simpan data event ke dalam variabel JavaScript dalam format JSON
        const events = <?= json_encode($events); ?>;

        let currentDate = new Date();

        function updateCalendar() {
            const month = currentDate.getMonth();
            const year = currentDate.getFullYear();
            const monthName = currentDate.toLocaleString('id-ID', {
                month: 'long'
            });
            document.getElementById('currentMonth').textContent = `${monthName} ${year}`;

            // Generate the dates for the calendar grid
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const firstDayOfWeek = firstDay.getDay(); // Get day index (0=Sunday, 6=Saturday)
            const lastDate = lastDay.getDate(); // Get total days in the month
            const calendarGrid = document.getElementById('calendarGrid');
            calendarGrid.innerHTML = '';

            // Add empty cells for days before the first day of the month
            for (let i = 0; i < firstDayOfWeek; i++) {
                calendarGrid.innerHTML += '<div class="date-cell"></div>';
            }

            // Add actual date cells
            for (let day = 1; day <= lastDate; day++) {
                const date = new Date(year, month, day);
                const dateString = date.toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                }).split('/').reverse().join('-'); // Format menjadi YYYY-MM-DD


                // Find events matching this date
                const eventForDay = events.filter(event => event.event_date === dateString);
                let eventDescription = '';
                if (eventForDay.length > 0) {
                    eventDescription = eventForDay[0].event_description;
                }

                // Render date and event
                calendarGrid.innerHTML += `
            <div class="date-cell" data-date="${dateString}">
                <span class="day-number">${day}</span>
                ${eventDescription ? `<div class="event">${eventDescription}</div>` : ''}
            </div>
        `;
            }

            // Add event listeners for newly created date cells
            document.querySelectorAll('.date-cell').forEach(cell => {
                cell.addEventListener('click', function() {
                    const date = this.getAttribute('data-date');
                    document.getElementById('eventDate').value = date;

                    // Find event matching the date
                    const eventForDay = events.find(event => event.event_date === date);

                    // If event exists, fill the input with its description
                    if (eventForDay) {
                        document.getElementById('eventDescription').value = eventForDay.event_description;
                    } else {
                        document.getElementById('eventDescription').value = ''; // Clear input if no event
                    }

                    document.getElementById('eventDescription').focus();
                });
            });
        }

        // Initialize calendar
        updateCalendar();

        document.getElementById('prevMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            updateCalendar();
        });

        document.getElementById('nextMonth').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            updateCalendar();
        });



        // Event handling for date cell clicks
        document.querySelectorAll('.date-cell').forEach(cell => {
            cell.addEventListener('click', function() {
                const date = this.getAttribute('data-date');
                document.getElementById('eventDate').value = date;
                document.getElementById('eventDescription').focus();
            });
        });

        // Add event listeners for newly created date cells
        document.querySelectorAll('.date-cell').forEach(cell => {
            cell.addEventListener('click', function() {
                const date = this.getAttribute('data-date');
                document.getElementById('eventDate').value = date;

                // Cari event yang cocok dengan tanggal ini
                const eventForDay = events.find(event => event.event_date === date);

                // Jika ada deskripsi event, isi ke input eventDescription
                if (eventForDay) {
                    document.getElementById('eventDescription').value = eventForDay.event_description;
                } else {
                    document.getElementById('eventDescription').value = ''; // Kosongkan jika tidak ada event
                }

                // Fokus pada input deskripsi
                document.getElementById('eventDescription').focus();
            });
        });
    </script>


</body>

</html>