<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCoach - Elite Disponibilités</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760;
            --primary-glow: rgba(30, 215, 96, 0.4);
            --bg-dark: #050505;
            --card-bg: rgba(18, 18, 18, 0.85);
            --text-white: #ffffff;
            --text-gray: #b0b0b0;
            --danger: #ff4d4d;
            --border: rgba(255, 255, 255, 0.08);
            --input-bg: rgba(255, 255, 255, 0.04);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); display: flex; min-height: 100vh; overflow-x: hidden; }

        /* --- Sidebar --- */
        .sidebar { width: 280px; background: #0a0a0a; border-right: 1px solid var(--border); padding: 40px 25px; position: fixed; height: 100vh; z-index: 100; }
        .logo { font-size: 1.6rem; font-weight: 800; color: var(--primary); margin-bottom: 60px; display: flex; align-items: center; gap: 10px; }
        .logo span { background: var(--primary); color: #000; padding: 2px 8px; border-radius: 6px; }
        .nav-link { padding: 16px 20px; color: var(--text-gray); text-decoration: none; border-radius: 15px; margin-bottom: 8px; display: flex; align-items: center; gap: 15px; transition: 0.4s; }
        .nav-link.active { background: rgba(30, 215, 96, 0.1); color: var(--primary); font-weight: 600; box-shadow: inset 0 0 10px rgba(30, 215, 96, 0.1); }

        /* --- Main Content --- */
        .main-content { flex: 1; margin-left: 280px; padding: 50px 60px; position: relative; }
        
        .main-content::before {
            content: ''; position: absolute; top: -150px; left: -150px; width: 600px; height: 600px;
            background: radial-gradient(circle, var(--primary-glow) 0%, transparent 70%); z-index: -1;
        }

        .header-page { margin-bottom: 50px; }
        .header-page h1 { font-size: 2.8rem; font-weight: 800; letter-spacing: -1.5px; text-transform: uppercase; }
        .header-page h1 span { color: var(--primary); text-shadow: 0 0 15px var(--primary-glow); }

        /* --- Error Zone --- */
        #error-msg { 
            background: rgba(255, 77, 77, 0.1); border: 1px solid var(--danger);
            color: var(--danger); padding: 20px; border-radius: 20px; margin-bottom: 30px;
            display: none; animation: shake 0.5s ease; font-weight: 600;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        /* --- Form Card (Glassmorphism) --- */
        .add-dispo-card {
            background: var(--card-bg); backdrop-filter: blur(25px); border: 1px solid var(--border);
            padding: 45px; border-radius: 40px; margin-bottom: 60px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.5); position: relative; overflow: hidden;
        }

        .add-dispo-card::after {
            content: ''; position: absolute; top: 0; right: 0; width: 100px; height: 100px;
            background: var(--primary); filter: blur(100px); opacity: 0.2;
        }

        .form-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr auto; gap: 25px; align-items: flex-end; }
        .input-group { display: flex; flex-direction: column; gap: 12px; }
        .input-group label { font-size: 0.75rem; color: var(--text-gray); text-transform: uppercase; font-weight: 700; letter-spacing: 1.5px; margin-left: 5px; }
        
        .form-control {
            background: var(--input-bg); border: 1px solid var(--border);
            border-radius: 20px; padding: 18px 25px; color: white; outline: none;
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1); font-size: 1rem;
        }
        .form-control:focus { border-color: var(--primary); background: rgba(30, 215, 96, 0.05); box-shadow: 0 0 20px rgba(30, 215, 96, 0.1); }
        
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator { filter: invert(1); cursor: pointer; }

        .btn-add {
            background: linear-gradient(135deg, var(--primary), #17b950);
            color: black; border: none; padding: 18px 40px; border-radius: 22px;
            font-weight: 800; cursor: pointer; transition: 0.4s ease;
            text-transform: uppercase; letter-spacing: 1px; box-shadow: 0 10px 25px var(--primary-glow);
        }
        .btn-add:hover { transform: translateY(-5px); box-shadow: 0 15px 35px var(--primary-glow); }

        /* --- List Styling --- */
        .section-header { display: flex; align-items: center; gap: 15px; margin-bottom: 35px; }
        .section-header h3 { font-size: 1.5rem; font-weight: 700; }
        .section-header .line { flex: 1; height: 1px; background: var(--border); }

        .dispo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 30px; }
        
        .dispo-item {
            background: var(--card-bg); backdrop-filter: blur(15px); border: 1px solid var(--border);
            padding: 30px; border-radius: 35px; display: flex; justify-content: space-between;
            align-items: center; transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative; overflow: hidden;
        }

        .dispo-item::before {
            content: ''; position: absolute; left: 0; top: 0; height: 100%; width: 4px;
            background: var(--primary); box-shadow: 0 0 15px var(--primary); opacity: 0; transition: 0.3s;
        }

        .dispo-item:hover { 
            border-color: rgba(30, 215, 96, 0.3); transform: translateY(-8px); 
            background: rgba(25, 25, 25, 0.9);
        }
        .dispo-item:hover::before { opacity: 1; }

        .dispo-info h4 { color: #fff; font-size: 1.3rem; margin-bottom: 8px; font-weight: 700; letter-spacing: -0.5px; }
        .dispo-info p { 
            color: var(--primary); font-weight: 700; font-size: 0.9rem;
            background: rgba(30, 215, 96, 0.1); padding: 5px 15px; border-radius: 12px;
            display: inline-block;
        }
        
        .btn-delete { 
            background: rgba(255, 77, 77, 0.05); color: var(--danger);
            border: 1px solid rgba(255, 77, 77, 0.1); width: 50px; height: 50px;
            border-radius: 20px; cursor: pointer; transition: 0.3s ease;
            display: flex; align-items: center; justify-content: center; font-size: 1.1rem;
        }
        .btn-delete:hover { background: var(--danger); color: white; transform: rotate(90deg); box-shadow: 0 0 20px rgba(255, 77, 77, 0.3); }

        .empty-msg { 
            grid-column: 1 / -1; text-align: center; padding: 60px;
            background: var(--input-bg); border: 2px dashed var(--border); border-radius: 30px;
            color: var(--text-gray); font-style: italic;
        }

        /* Responsive */
        @media (max-width: 1000px) {
            .form-grid { grid-template-columns: 1fr 1fr; }
            .btn-add { grid-column: 1 / -1; }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><span>FIT</span> COACH</div>
        <a href="../controllers/coach.conttoleur.php" class="nav-link">🏠 Dashboard</a>
        <a href="../controllers/seances_coach.controlleur.php" class="nav-link">🏋️ Mes Séances</a>
        <a href="../controllers/dispo.contorleurs.php" class="nav-link active">📅 Disponibilités</a>
        <a href="../controllers/profile_coach.controleur.php" class="nav-link">👤 Mon Profil</a>
        <div style="margin-top: auto; padding-top: 20px;">
            <a href="../controllers/logoutContrelleur.php" class="nav-link" style="color: var(--danger);">🚪 Déconnexion</a>
        </div>
    </aside>

    <main class="main-content">
        <div class="header-page">
            <h1>GESTION <span>DISPO</span></h1>
            <p style="color: var(--text-gray);">Définissez vos créneaux pour permettre aux membres de réserver vos séances.</p>
        </div>

        <div id="error-msg"></div>

        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="add-dispo-card">
                <div class="form-grid">
                    <div class="input-group">
                        <label>📅 Date du créneau</label>
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
                    <button class="btn-add" type="submit">Ajouter au planning</button>
                </div>
            </div>
        </form>

        <div class="section-header">
            <h3>PLANNING ACTUEL</h3>
            <div class="line"></div>
        </div>

        <div class="dispo-grid" id="dispoContainer">
            <?php if(!empty($dispo)): ?>
                <?php foreach($dispo as $dis): ?>
                    <div class="dispo-item">
                        <div class="dispo-info">
                            <h4>📅 <?= date('d M Y', strtotime($dis['jour'])) ?></h4>
                            <p>🕒 <?= date('H:i', strtotime($dis['heures_debut'])) ?> — <?= date('H:i', strtotime($dis['heures_fin'])) ?></p>
                        </div>
                        <a href="../controllers/deleteDispo.contoleur.php?id=<?= $dis['id_dispo'] ?>">
                            <button class="btn-delete" title="Supprimer le créneau">✕</button>
                        </a>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <div class="empty-msg">
                    <p>🚀 Aucun créneau enregistré. Commencez par en ajouter un ci-dessus !</p>
                </div>
            <?php endif; ?>
        </div>
    </main>

    <script>
        // Bloquer les dates passées
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('dayInput').setAttribute('min', today);

        function showError(msg) {
            const errorDiv = document.getElementById('error-msg');
            errorDiv.innerText = "⚠️ " + msg;
            errorDiv.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
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
                showError("L'heure de fin doit être strictement supérieure à l'heure de début.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>