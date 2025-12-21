<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCoach - Elite Planning</title>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760;
            --primary-glow: rgba(30, 215, 96, 0.4);
            --bg-dark: #050505;
            --card-bg: rgba(18, 18, 18, 0.9);
            --text-white: #ffffff;
            --text-gray: #b0b0b0;
            --danger: #ff4d4d;
            --border: rgba(255, 255, 255, 0.08);
            --input-bg: rgba(255, 255, 255, 0.04);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); display: flex; min-height: 100vh; }

        /* --- Sidebar --- */
        .sidebar { width: 280px; background: #0a0a0a; border-right: 1px solid var(--border); padding: 40px 25px; position: fixed; height: 100vh; z-index: 100; }
        .logo { font-size: 1.6rem; font-weight: 800; color: var(--primary); margin-bottom: 60px; display: flex; align-items: center; gap: 10px; }
        .logo span { background: var(--primary); color: #000; padding: 2px 8px; border-radius: 6px; }
        .nav-link { padding: 16px 20px; color: var(--text-gray); text-decoration: none; border-radius: 15px; margin-bottom: 8px; display: flex; align-items: center; gap: 15px; transition: 0.4s; }
        .nav-link.active { background: rgba(30, 215, 96, 0.1); color: var(--primary); font-weight: 600; }

        /* --- Main Content --- */
        .main-content { flex: 1; margin-left: 280px; padding: 40px 50px; }
        .header-page { margin-bottom: 30px; }
        .header-page h1 { font-size: 2.2rem; font-weight: 800; text-transform: uppercase; }
        .header-page h1 span { color: var(--primary); }

        /* --- Fast Add Form --- */
        .add-box {
            background: var(--card-bg); border: 1px solid var(--border); padding: 25px;
            border-radius: 25px; margin-bottom: 30px; display: flex; gap: 20px; align-items: flex-end;
            backdrop-filter: blur(10px);
        }
        .input-group { display: flex; flex-direction: column; gap: 8px; flex: 1; }
        .input-group label { font-size: 0.7rem; color: var(--text-gray); font-weight: 700; text-transform: uppercase; }
        .form-control {
            background: var(--input-bg); border: 1px solid var(--border);
            border-radius: 15px; padding: 12px 18px; color: white; outline: none; transition: 0.3s;
        }
        .form-control:focus { border-color: var(--primary); background: rgba(30, 215, 96, 0.05); }
        .btn-add {
            background: var(--primary); color: #000; border: none; padding: 13px 35px;
            border-radius: 15px; font-weight: 800; cursor: pointer; text-transform: uppercase; transition: 0.3s;
        }
        .btn-add:hover { transform: translateY(-3px); box-shadow: 0 10px 20px var(--primary-glow); }

        /* --- Custom Calendar Styling --- */
        .calendar-card {
            background: var(--card-bg); border: 1px solid var(--border);
            padding: 25px; border-radius: 30px; box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        }

        /* FullCalendar Overrides */
        .fc { --fc-border-color: rgba(255,255,255,0.05); }
        .fc-theme-standard td, .fc-theme-standard th { border: 1px solid rgba(255,255,255,0.05); }
        .fc-toolbar-title { font-size: 1.4rem !important; font-weight: 700; color: #fff; }
        .fc-button-primary { background: #1a1a1a !important; border: 1px solid var(--border) !important; font-weight: 600 !important; }
        .fc-button-active { background: var(--primary) !important; color: #000 !important; border: none !important; }
        
        /* Hour/Slot Styling */
        .fc-timegrid-slot { height: 50px !important; border-bottom: 1px solid rgba(255,255,255,0.02) !important; }
        .fc-timegrid-slot-label-cushion { color: var(--text-gray); font-size: 0.75rem; font-weight: 500; }
        .fc-col-header-cell { padding: 12px 0 !important; background: rgba(255,255,255,0.02); }
        .fc-col-header-cell-cushion { color: var(--primary); font-size: 0.85rem; font-weight: 700; text-transform: uppercase; }

        /* Event Design */
        .fc-v-event {
            background: linear-gradient(135deg, #1ed760 0%, #159a43 100%) !important;
            border: none !important; border-radius: 8px !important; padding: 4px !important;
            box-shadow: 0 5px 15px rgba(30, 215, 96, 0.2);
        }
        .fc-event-title { font-weight: 800; font-size: 0.8rem; color: #000; }
        .fc-event-time { color: rgba(0,0,0,0.7); font-weight: 600; font-size: 0.7rem; }

        /* Scrollbar */
        .fc-scroller::-webkit-scrollbar { width: 6px; }
        .fc-scroller::-webkit-scrollbar-thumb { background: #333; border-radius: 10px; }

    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><span>FIT</span> COACH</div>
        <a href="../controllers/coach.conttoleur.php" class="nav-link">🏠 Dashboard</a>
        <a href="../controllers/seances_coach.controlleur.php" class="nav-link">🏋️ Mes Séances</a>
        <a href="../controllers/dispo.contorleurs.php" class="nav-link active">📅 Disponibilités</a>
        <a href="../controllers/profile_coach.controleur.php" class="nav-link">👤 Mon Profil</a>
        <div style="margin-top: auto;">
            <a href="../controllers/logoutContrelleur.php" class="nav-link" style="color: var(--danger);">🚪 Déconnexion</a>
        </div>
    </aside>

    <main class="main-content">
        <div class="header-page">
            <h1>PLANNING <span>PRO</span></h1>
            <p style="color: var(--text-gray); font-size: 0.9rem;">Plage horaire autorisée : 08:00 — 17:00</p>
        </div>

        <form id="dispoForm" action="" method="POST" onsubmit="return validateHours()">
            <div class="add-box">
                <div class="input-group">
                    <label>Date</label>
                    <input type="date" id="dayInput" class="form-control" name="jour" required>
                </div>
                <div class="input-group">
                    <label>Heure Début</label>
                    <input type="time" id="startTime" class="form-control" name="debut" required>
                </div>
                <div class="input-group">
                    <label>Heure Fin</label>
                    <input type="time" id="endTime" class="form-control" name="fin" required>
                </div>
                <button class="btn-add" type="submit">Ajouter</button>
            </div>
        </form>

        <div class="calendar-card">
            <div id="calendar"></div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek', 
                locale: 'fr',
                slotMinTime: '08:00:00',
                slotMaxTime: '18:00:00',
                allDaySlot: false,
                height: 'auto',
                nowIndicator: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'timeGridWeek,timeGridDay,dayGridMonth'
                },
                buttonText: {
                    today: 'Aujourd\'hui',
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour'
                },
                events: [
                    <?php foreach($dispo as $dis): ?>
                    {
                        title: 'SESSION LIBRE',
                        start: '<?= $dis['jour'] ?>T<?= $dis['heures_debut'] ?>',
                        end: '<?= $dis['jour'] ?>T<?= $dis['heures_fin'] ?>',
                        extendedProps: { id_dispo: '<?= $dis['id_dispo'] ?>' }
                    },
                    <?php endforeach; ?>
                ],
                eventClick: function(info) {
                    if(confirm("Supprimer ce créneau disponible ?")) {
                        window.location.href = "../controllers/deleteDispo.contoleur.php?id=" + info.event.extendedProps.id_dispo;
                    }
                }
            });
            
            calendar.render();
            
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('dayInput').setAttribute('min', today);
        });

        function validateHours() {
            const start = document.getElementById('startTime').value;
            const end = document.getElementById('endTime').value;
            
            const minTime = "08:00";
            const maxTime = "17:00";

            if (start < minTime || start > maxTime || end < minTime || end > maxTime) {
                alert(" Erreur : Les séances doivent être comprises entre 08:00 et 17:00.");
                return false;
            }

            if (start >= end) {
                alert("Erreur : L'heure de fin doit être après l'heure de début.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>