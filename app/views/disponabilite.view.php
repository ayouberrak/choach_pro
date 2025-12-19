<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCoach - Gestion Disponibilités</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760;
            --bg-dark: #080808;
            --card-bg: #121212;
            --text-white: #ffffff;
            --text-gray: #a0a0a0;
            --danger: #ff4d4d;
            --border: rgba(255, 255, 255, 0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); display: flex; min-height: 100vh; }

        /* --- Sidebar --- */
        .sidebar { width: 280px; background: var(--card-bg); border-right: 1px solid var(--border); padding: 40px 25px; position: fixed; height: 100vh; z-index: 100; }
        .logo { font-size: 1.6rem; font-weight: 800; color: var(--primary); margin-bottom: 60px; display: flex; align-items: center; gap: 10px; }
        .logo span { background: var(--primary); color: #000; padding: 2px 8px; border-radius: 6px; }
        .nav-link { padding: 16px 20px; color: var(--text-gray); text-decoration: none; border-radius: 15px; margin-bottom: 8px; display: flex; align-items: center; gap: 15px; transition: 0.4s; }
        .nav-link:hover, .nav-link.active { background: rgba(30, 215, 96, 0.1); color: var(--primary); }

        /* --- Main Content --- */
        .main-content { flex: 1; margin-left: 280px; padding: 40px 50px; }
        .header-page { margin-bottom: 40px; }
        .header-page h1 { font-size: 2.2rem; margin-bottom: 8px; font-weight: 700; }
        
        /* --- Error Zone --- */
        #error-msg { 
            background: rgba(255, 77, 77, 0.15); 
            color: var(--danger); 
            padding: 15px; 
            border-radius: 15px; 
            margin-bottom: 25px; 
            display: none; 
            border: 1px solid var(--danger);
            font-weight: 500;
        }

        /* --- Form Card (Glassmorphism) --- */
        .add-dispo-card {
            background: rgba(18, 18, 18, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            padding: 35px;
            border-radius: 30px;
            margin-bottom: 50px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .form-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr auto; gap: 20px; align-items: end; }
        .input-group { display: flex; flex-direction: column; gap: 10px; }
        .input-group label { font-size: 0.8rem; color: var(--text-gray); text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px; }
        
        .form-control {
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 15px;
            padding: 15px;
            color: white;
            outline: none;
            transition: 0.3s;
            font-size: 0.95rem;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 15px rgba(30, 215, 96, 0.1); }
        input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); cursor: pointer; }

        .btn-add {
            background: var(--primary);
            color: black;
            border: none;
            padding: 15px 35px;
            border-radius: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
        }
        .btn-add:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(30, 215, 96, 0.4); }

        /* --- List Styling --- */
        .dispo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 25px; }
        
        .dispo-item {
            background: var(--card-bg);
            border: 1px solid var(--border);
            padding: 25px;
            border-radius: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
        }
        .dispo-item:hover { border-color: var(--primary); transform: scale(1.02); }

        .dispo-info h4 { color: var(--primary); font-size: 1.2rem; margin-bottom: 6px; font-weight: 700; }
        .dispo-info p { color: var(--text-white); font-weight: 500; letter-spacing: 1px; }
        
        .btn-delete { 
            background: rgba(255, 77, 77, 0.1); 
            color: var(--danger); 
            border: 1px solid rgba(255, 77, 77, 0.2); 
            width: 45px; 
            height: 45px; 
            border-radius: 15px; 
            cursor: pointer; 
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }
        .btn-delete:hover { background: var(--danger); color: white; }

        .empty-msg { color: var(--text-gray); font-style: italic; }
    </style>
</head>
<body>


    <aside class="sidebar">
        <div class="logo"><span>FIT</span> COACH</div>
        <a href="../controllers/coach.conttoleur.php" class="nav-link active">🏠 Dashboard</a>
        <a href="../controllers/seances_coach.controlleur.php" class="nav-link">🏋️ Mes Séances</a>
        <a href="../controllers/dispo.contorleurs.php" class="nav-link active ">📅 Disponibilités</a>
        <a href="../controllers/profile_coach.controleur.php" class="nav-link">👤 Mon Profil</a>
        <a href="../controllers/logoutContrelleur.php" class="nav-link" ><div  style="margin-top: auto; color: #ff4d4d; cursor: pointer;">🚪 Déconnexion</div></a>
    </aside>


    <main class="main-content">
        <div class="header-page">
            <h1>📅 Mes Disponibilités</h1>
            <p style="color: var(--text-gray);">Configurez vos créneaux horaires pour recevoir des réservations.</p>
        </div>

        <div id="error-msg"></div>

        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="add-dispo-card">
                <div class="form-grid">
                    <div class="input-group">
                        <label>📅 Date du jour</label>
                        <input type="date" id="dayInput" class="form-control" name="jour">
                    </div>
                    <div class="input-group">
                        <label>🕒 Heure Début</label>
                        <input type="time" id="startTime" class="form-control" name="debut">
                    </div>
                    <div class="input-group">
                        <label>🕒 Heure Fin</label>
                        <input type="time" id="endTime" class="form-control" name="fin">
                    </div>
                    <button class="btn-add" type="submit">Ajouter</button>
                </div>
            </div>
        </form>

        <h3 style="margin-bottom: 25px;">Vos créneaux actuels</h3>
        <div class="dispo-grid" id="dispoContainer">
            <?php if(!empty($dispo)): ?>
                <?php foreach($dispo as $dis): ?>
                    <div class="dispo-item">
                        <div class="dispo-info">
                            <h4>📅 <?= date('d/m/Y', strtotime($dis['jour'])) ?></h4>
                            <p>🕒 <?= date('H:i', strtotime($dis['heures_debut'])) ?> - <?= date('H:i', strtotime($dis['heures_fin'])) ?></p>
                        </div>
                        <a href="../controllers/deleteDispo.contoleur.php?id=<?= $dis['id_dispo'] ?>"><button class="btn-delete" title="Supprimer">✕</button></a>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <p class="empty-msg">Aucun créneau enregistré pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>

    <script>
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('dayInput').setAttribute('min', today);

        function showError(msg) {
            const errorDiv = document.getElementById('error-msg');
            errorDiv.innerText = "⚠️ " + msg;
            errorDiv.style.display = 'block';
            window.scrollTo(0, 0);
            setTimeout(() => { errorDiv.style.display = 'none'; }, 4000);
        }

        function validateForm() {
            const day = document.getElementById('dayInput').value;
            const start = document.getElementById('startTime').value;
            const end = document.getElementById('endTime').value;

            if(!day || !start || !end) {
                showError("Veuillez remplir tous les champs.");
                return false;
            }

            if (start >= end) {
                showError("L'heure de fin doit être supérieure à l'heure de début.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>