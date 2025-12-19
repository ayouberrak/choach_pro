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
        .nav-link.active { background: rgba(30, 215, 96, 0.08); color: var(--primary); }

        /* --- Main Content --- */
        .main-content { flex: 1; margin-left: 280px; padding: 40px 50px; }
        .header-page { margin-bottom: 40px; }
        
        /* --- Alert Messages --- */
        #error-msg { 
            background: rgba(255, 77, 77, 0.1); 
            color: var(--danger); 
            padding: 15px; 
            border-radius: 12px; 
            margin-bottom: 20px; 
            display: none; 
            font-size: 0.9rem;
            border: 1px solid rgba(255, 77, 77, 0.2);
        }

        /* --- Form Card --- */
        .add-dispo-card {
            background: rgba(18, 18, 18, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            padding: 30px;
            border-radius: 25px;
            margin-bottom: 50px;
        }

        .form-grid { display: grid; grid-template-columns: 1.5fr 1fr 1fr auto; gap: 20px; align-items: end; }
        .input-group { display: flex; flex-direction: column; gap: 8px; }
        .input-group label { font-size: 0.75rem; color: var(--text-gray); text-transform: uppercase; font-weight: 600; }
        
        .form-control {
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 14px 15px;
            color: white;
            outline: none;
            transition: 0.3s;
        }
        .form-control:focus { border-color: var(--primary); }
        input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); cursor: pointer; }

        .btn-add {
            background: var(--primary);
            color: black;
            border: none;
            padding: 14px 35px;
            border-radius: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-add:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(30, 215, 96, 0.3); }

        /* --- List --- */
        .dispo-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; }
        .dispo-item {
            background: var(--card-bg);
            border: 1px solid var(--border);
            padding: 20px;
            border-radius: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .dispo-info h4 { color: var(--primary); margin-bottom: 5px; text-transform: capitalize; }
        .btn-delete { background: rgba(255, 77, 77, 0.1); color: var(--danger); border: none; width: 35px; height: 35px; border-radius: 10px; cursor: pointer; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><span>FIT</span> COACH</div>
        <a href="../controllers/coach.conttoleur.php" class="nav-link">🏠 Dashboard</a>
        <a href="../controllers/seances_coach.controlleur.php" class="nav-link">🏋️ Mes Séances</a>
        <a href="../controllers/dispo.contorleurs.php" class="nav-link active">📅 Disponibilités</a>
        <a href="#" class="nav-link">👤 Mon Profil</a>
    </aside>

    <main class="main-content">
        <div class="header-page">
            <h1>📅 Mes Disponibilités</h1>
            <p style="color: var(--text-gray);">Planifiez vos prochaines séances.</p>
        </div>

        <div id="error-msg"></div>

            <div class="add-dispo-card">
                <div class="form-grid">
                    <div class="input-group">
                        <label>📅 Date</label>
                        <input type="date" id="dayInput" class="form-control" >
                    </div>
                    <div class="input-group">
                        <label>🕒 Début</label>
                        <input type="time" id="startTime" class="form-control">
                    </div>
                    <div class="input-group">
                        <label>🕒 Fin</label>
                        <input type="time" id="endTime" class="form-control">
                    </div>
                    <button class="btn-add" onclick="addAvailability()">Ajouter</button>
                </div>
            </div>

        <div class="dispo-grid" id="dispoContainer">
            </div>
    </main>

    <script>
        // 1. Bloquer les dates passées dans le calendrier au chargement
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('dayInput').setAttribute('min', today);

        function showError(msg) {
            const errorDiv = document.getElementById('error-msg');
            errorDiv.innerText = "⚠️ " + msg;
            errorDiv.style.display = 'block';
            setTimeout(() => { errorDiv.style.display = 'none'; }, 4000);
        }

        function addAvailability() {
            const dayInput = document.getElementById('dayInput');
            const startTime = document.getElementById('startTime');
            const endTime = document.getElementById('endTime');
            
            const day = dayInput.value;
            const start = startTime.value;
            const end = endTime.value;

            // --- VALIDATIONS ---

            // A. Champs vides
            if (!day || !start || !end) {
                showError("Veuillez remplir tous les champs.");
                return;
            }

            // B. Validation Date (aujourd'hui ou plus tard)
            const selectedDate = new Date(day);
            const currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0);

            if (selectedDate < currentDate) {
                showError("Vous ne pouvez pas choisir une date passée.");
                return;
            }

            // C. Validation Heures
            if (start >= end) {
                showError("L'heure de fin doit être strictement supérieure à l'heure de début.");
                return;
            }


            // --- ENVOI VERS PHP ---
            fetch("../api/dispo.api.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    day: day,
                    start: start,
                    end: end
                })
            })
            .then(response => response.json())
            .then(data => {

                if (data.status !== "success") {
                    showError(data.message);
                    return;
                }

                // --- AFFICHAGE ---
                const container = document.getElementById('dispoContainer');
                const slotCard = document.createElement('div');
                slotCard.className = 'dispo-item';

                const formattedDate = new Date(day).toLocaleDateString('fr-FR', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long'
                });

                slotCard.innerHTML = `
                    <div class="dispo-info">
                        <h4>${formattedDate}</h4>
                        <p>🕒 ${start} - ${end}</p>
                    </div>
                    <button class="btn-delete" onclick="this.parentElement.remove()">✕</button>
                `;

                container.prepend(slotCard);

                // Reset
                startTime.value = '';
                endTime.value = '';

            })
            .catch(error => {
                console.error(error);
                showError("Erreur serveur, réessayez.");
            });
        }
    </script>
</body>
</html>