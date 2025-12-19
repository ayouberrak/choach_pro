<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCoach - Mes Disponibilités</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760;
            --bg-dark: #080808;
            --card-bg: #121212;
            --text-white: #ffffff;
            --text-gray: #888888;
            --danger: #ff4d4d;
            --border: rgba(255, 255, 255, 0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); display: flex; min-height: 100vh; }

        /* --- Sidebar --- */
        .sidebar { width: 280px; background: var(--card-bg); border-right: 1px solid var(--border); padding: 40px 25px; position: fixed; height: 100vh; z-index: 100; }
        .logo { font-size: 1.6rem; font-weight: 800; color: var(--primary); margin-bottom: 60px; display: flex; align-items: center; gap: 10px; }
        .logo span { background: var(--primary); color: #000; padding: 2px 8px; border-radius: 6px; }
        .nav-link { padding: 16px 20px; color: var(--text-gray); text-decoration: none; border-radius: 15px; margin-bottom: 8px; display: flex; align-items: center; gap: 15px; transition: 0.4s; cursor: pointer; }
        .nav-link:hover, .nav-link.active { background: rgba(30, 215, 96, 0.08); color: var(--primary); }

        /* --- Main Content --- */
        .main-content { flex: 1; margin-left: 280px; padding: 40px 50px; }
        .header-page { margin-bottom: 40px; }
        .header-page h1 { font-size: 2rem; }

        /* --- Form Card (Glassmorphism) --- */
        .add-dispo-card {
            background: rgba(18, 18, 18, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            padding: 30px;
            border-radius: 25px;
            margin-bottom: 50px;
        }

        .form-grid { display: grid; grid-template-columns: repeat(3, 1fr) auto; gap: 20px; align-items: end; }
        .input-group { display: flex; flex-direction: column; gap: 8px; }
        .input-group label { font-size: 0.8rem; color: var(--text-gray); text-transform: uppercase; letter-spacing: 1px; }
        
        .form-control {
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 12px 15px;
            color: white;
            outline: none;
            transition: 0.3s;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 10px rgba(30, 215, 96, 0.1); }

        .btn-add {
            background: var(--primary);
            color: black;
            border: none;
            padding: 12px 30px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-add:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(30, 215, 96, 0.2); }

        /* --- Slots Display Grid --- */
        .dispo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
        
        .dispo-item {
            background: var(--card-bg);
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: fadeIn 0.5s ease forwards;
        }

        .dispo-info h4 { color: var(--primary); font-size: 1.1rem; margin-bottom: 5px; }
        .dispo-info p { color: var(--text-white); font-weight: 500; font-size: 0.9rem; opacity: 0.9; }

        .btn-delete {
            background: rgba(255, 77, 77, 0.1);
            color: var(--danger);
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .btn-delete:hover { background: var(--danger); color: white; }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .empty-state { grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--text-gray); border: 2px dashed #222; border-radius: 20px; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><span>FIT</span> COACH</div>
        <a href="../controllers/coach.conttoleur.php" class="nav-link">🏠 Dashboard</a>
        <a href="../controllers/seances_coach.controlleur.php" class="nav-link">🏋️ Mes Séances</a>
        <a href="../controllers/dispo.contorleurs.php" class="nav-link active">📅 Disponibilités</a>
        <a href="#" class="nav-link">👤 Mon Profil</a>
        <a href="../controllers/logoutContrelleur.php" class="nav-link" ><div  style="margin-top: auto; color: #ff4d4d; cursor: pointer;">🚪 Déconnexion</div></a>
    </aside>

    <main class="main-content">
        <div class="header-page">
            <h1>📅 Mes Disponibilités</h1>
            <p style="color: var(--text-gray);">Définissez les créneaux horaires où vous êtes disponible pour vos clients.</p>
        </div>

        <div class="add-dispo-card">
            <div class="form-grid">
                <div class="input-group">
                    <label>Jour</label>
                    <select id="dayInput" class="form-control">
                        <option>Lundi</option>
                        <option>Mardi</option>
                        <option>Mercredi</option>
                        <option>Jeudi</option>
                        <option>Vendredi</option>
                        <option>Samedi</option>
                        <option>Dimanche</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Heure Début</label>
                    <input type="time" id="startTime" class="form-control">
                </div>
                <div class="input-group">
                    <label>Heure Fin</label>
                    <input type="time" id="endTime" class="form-control">
                </div>
                <button class="btn-add" onclick="addAvailability()">Ajouter</button>
            </div>
        </div>

        <h3 style="margin-bottom: 20px;">Mes créneaux enregistrés</h3>
        <div class="dispo-grid" id="dispoContainer">
            <div class="empty-state" id="emptyMsg">Aucun créneau enregistré pour le moment.</div>
        </div>
    </main>

    <script>
        function addAvailability() {
            const day = document.getElementById('dayInput').value;
            const start = document.getElementById('startTime').value;
            const end = document.getElementById('endTime').value;
            const container = document.getElementById('dispoContainer');
            const emptyMsg = document.getElementById('emptyMsg');

            if(!start || !end) {
                alert("Veuillez remplir les horaires !");
                return;
            }

            if(start >= end) {
                alert("L'heure de fin doit être après l'heure de début.");
                return;
            }

            // Remove empty message if exists
            if(emptyMsg) emptyMsg.style.display = 'none';

            // Create new card
            const slotCard = document.createElement('div');
            slotCard.className = 'dispo-item';
            slotCard.innerHTML = `
                <div class="dispo-info">
                    <h4>${day}</h4>
                    <p>🕒 ${start} - ${end}</p>
                </div>
                <button class="btn-delete" onclick="removeSlot(this)">✕</button>
            `;

            container.appendChild(slotCard);

            // Reset inputs
            document.getElementById('startTime').value = '';
            document.getElementById('endTime').value = '';
        }

        function removeSlot(btn) {
            const card = btn.closest('.dispo-item');
            card.style.opacity = '0';
            card.style.transform = 'scale(0.8)';
            card.style.transition = '0.3s';
            
            setTimeout(() => {
                card.remove();
                const container = document.getElementById('dispoContainer');
                const items = container.querySelectorAll('.dispo-item');
                if(items.length === 0) {
                    document.getElementById('emptyMsg').style.display = 'block';
                }
            }, 300);
        }
    </script>
</body>
</html>