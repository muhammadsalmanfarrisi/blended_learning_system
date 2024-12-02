<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalender Interaktif</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .calendar {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-header h4 {
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .calendar-header button {
            background-color: #004c8c;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .calendar-header button:hover {
            background-color: #003a6b;
        }

        .calendar-days,
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            justify-items: center;
        }

        .calendar-days div,
        .calendar-grid div {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            padding: 10px;
        }

        .calendar-days div {
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        .calendar-grid div {
            background-color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s, background-color 0.3s;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80px;
        }

        .calendar-grid div:hover {
            transform: scale(1.05);
            background-color: #e3f2fd;
        }

        .day-number {
            font-size: 20px;
            color: #333;
        }

        .event {
            margin-top: 5px;
            font-size: 12px;
            background-color: #ffeb3b;
            color: #000;
            padding: 5px;
            border-radius: 5px;
            display: none;
        }

        /* Animations */
        .calendar-grid {
            opacity: 0;
            transform: translateY(50px);
            animation: fadeIn 0.5s forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .calendar-header h4 {
                font-size: 20px;
            }

            .calendar-days div,
            .calendar-grid div {
                padding: 8px;
                font-size: 14px;
            }
        }

        .navbar {
            background-color: #004c8c;
            padding: 15px 20px;
        }

        .navbar-brand {
            font-size: 1.5rem;
            color: #fff;
            font-weight: bold;
        }

        .navbar-brand img {
            width: 40px;
            /* Adjusted size */
            height: 40px;
            /* Adjusted size */
            margin-right: 10px;
            /* Spacing between logo and text */
        }

        .navbar-nav .nav-link {
            color: #fff;
            margin-left: 15px;
            font-size: 1.1rem;
        }

        .navbar-nav .nav-link:hover {
            color: #ffd700;
        }

        .navbar-toggler-icon {
            background-color: #fff;
        }

        /* Custom Footer Styles */
        footer {
            background-color: #222;
            color: #fff;
            padding: 30px 0;
            text-align: center;
        }

        footer .footer-logo {
            width: 40px;
            /* Adjusted size */
            height: 40px;
            /* Adjusted size */
            margin-bottom: 10px;
        }

        footer .social-icons a {
            color: #fff;
            font-size: 1.5rem;
            margin: 0 10px;
            text-decoration: none;
        }

        footer .social-icons a:hover {
            color: #ffd700;
        }

        footer .footer-text {
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="<?= base_url('images/image.png'); ?>" alt="PKTJ Logo">
                PKTJ TEGAL
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link " aria-current="page" href="/module/kalender/">Beranda</a>
                    <a class="nav-link" href="/module/">Modul Pembelajaran</a>
                    <a class="nav-link" href="/module/grafik/">Statistik</a>
                    <?php if (logged_in()) : ?>
                        <a class="nav-item nav-link" href="/logout">Logout</a>
                    <?php else : ?>
                        <a class="nav-item nav-Link" href="/login">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <?= $this->renderSection('content'); ?>

    <!-- Footer Section -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <div class="container">
        <div class="calendar">
            <!-- Header Kalender -->
            <div class="calendar-header">
                <button id="prevMonth">Prev</button>
                <h4 id="monthYear">November 2024</h4>
                <button id="nextMonth">Next</button>
            </div>

            <!-- Hari dalam Seminggu -->
            <div class="calendar-days">
                <div>Sen</div>
                <div>Sel</div>
                <div>Rab</div>
                <div>Kam</div>
                <div>Jum</div>
                <div>Sab</div>
                <div>Min</div>
            </div>

            <!-- Tanggal dalam Minggu -->
            <div class="calendar-grid" id="calendarGrid">
                <!-- Dynamic dates will be inserted here -->
            </div>
        </div>
    </div>

    <script>
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let currentMonth = new Date().getMonth(); // November is 10
        let currentYear = new Date().getFullYear();

        // Function to update the calendar
        function updateCalendar() {
            const monthYear = document.getElementById('monthYear');
            const calendarGrid = document.getElementById('calendarGrid');

            // Set the month/year text
            monthYear.innerText = `${monthNames[currentMonth]} ${currentYear}`;

            // Clear the previous calendar grid
            calendarGrid.innerHTML = '';

            // Get the first day of the month and the number of days in the month
            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const lastDate = new Date(currentYear, currentMonth + 1, 0).getDate();

            // Generate empty cells for the first few days
            for (let i = 0; i < firstDay; i++) {
                const emptyCell = document.createElement('div');
                calendarGrid.appendChild(emptyCell);
            }

            // Generate the actual date cells
            for (let date = 1; date <= lastDate; date++) {
                const dateCell = document.createElement('div');
                dateCell.classList.add('date-cell');
                dateCell.innerHTML = `
                <span class="day-number">${date}</span>
                <div class="event">Event</div>
            `;
                calendarGrid.appendChild(dateCell);
            }

            // Fade-in animation after the grid is generated
            calendarGrid.style.animation = 'fadeIn 0.5s forwards';
        }

        // Event listeners for the prev/next buttons
        document.getElementById('prevMonth').addEventListener('click', () => {
            currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
            if (currentMonth === 11) currentYear--;
            updateCalendar();
        });

        document.getElementById('nextMonth').addEventListener('click', () => {
            currentMonth = (currentMonth === 11) ? 0 : currentMonth + 1;
            if (currentMonth === 0) currentYear++;
            updateCalendar();
        });

        // Initialize the calendar
        updateCalendar();
    </script>
    <!-- Tambahkan ini setelah HTML kalender -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Edit Acara</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="eventForm">
                        <div class="mb-3">
                            <label for="eventDate" class="form-label">Tanggal</label>
                            <input type="text" class="form-control" id="eventDate" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="eventContent" class="form-label">Isi Acara</label>
                            <textarea class="form-control" id="eventContent" rows="3"></textarea>
                        </div>
                        <button type="button" class="btn btn-primary" id="saveEvent">Simpan Acara</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Menampilkan modal dan mengisi tanggal saat sel tanggal diklik
        document.getElementById('calendarGrid').addEventListener('click', function(event) {
            if (event.target.classList.contains('date-cell') || event.target.closest('.date-cell')) {
                const dateCell = event.target.closest('.date-cell');
                const dayNumber = dateCell.querySelector('.day-number').textContent;
                const fullDate = `${dayNumber} ${monthNames[currentMonth]} ${currentYear}`;
                document.getElementById('eventDate').value = fullDate;
                document.getElementById('eventContent').value = dateCell.querySelector('.event').textContent || '';
                new bootstrap.Modal(document.getElementById('eventModal')).show();
            }
        });

        // Menyimpan isi acara dan memperbarui sel kalender
        document.getElementById('saveEvent').addEventListener('click', function() {
            const eventDate = document.getElementById('eventDate').value;
            const eventContent = document.getElementById('eventContent').value;

            // Mencari sel tanggal untuk diperbarui
            const dateCells = document.querySelectorAll('.calendar-grid .date-cell');
            dateCells.forEach(cell => {
                if (cell.querySelector('.day-number').textContent === eventDate.split(' ')[0]) {
                    const eventDiv = cell.querySelector('.event');
                    eventDiv.textContent = eventContent;
                    eventDiv.style.display = eventContent ? 'block' : 'none';
                }
            });

            // Menutup modal
            bootstrap.Modal.getInstance(document.getElementById('eventModal')).hide();
        });
    </script>

    <footer>
        <div class="container">
            <img src="<?= base_url('images/image.png'); ?>" alt="PKTJ Logo" class="footer-logo">
            <div class="social-icons">
                <a href="#" class="fa fa-facebook"></a>
                <a href="#" class="fa fa-twitter"></a>
                <a href="#" class="fa fa-instagram"></a>
                <a href="#" class="fa fa-linkedin"></a>
            </div>
            <div class="footer-text">
                <p>&copy; 2024 PKTJ TEGAL. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>