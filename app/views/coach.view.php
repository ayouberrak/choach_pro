<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCoach - Dashboard Elite</title>
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
            --gradient: linear-gradient(135deg, #1ed760 0%, #1db954 100%);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); display: flex; min-height: 100vh; overflow-x: hidden; }

        /* --- Sidebar --- */
        .sidebar { width: 280px; background: var(--card-bg); border-right: 1px solid var(--border); padding: 40px 25px; position: fixed; height: 100vh; z-index: 100; }
        .logo { font-size: 1.6rem; font-weight: 800; color: var(--primary); letter-spacing: -1px; margin-bottom: 60px; display: flex; align-items: center; gap: 10px; }
        .logo span { background: var(--primary); color: #000; padding: 2px 8px; border-radius: 6px; }
        
        .nav-link { padding: 16px 20px; color: var(--text-gray); text-decoration: none; border-radius: 15px; margin-bottom: 8px; display: flex; align-items: center; gap: 15px; transition: 0.4s; font-weight: 500; }
        .nav-link:hover, .nav-link.active { background: rgba(30, 215, 96, 0.08); color: var(--primary); }

        /* --- Main Content --- */
        .main-content { flex: 1; margin-left: 280px; padding: 30px 50px; }

        /* --- Top Bar --- */
        .top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; background: rgba(255,255,255,0.02); padding: 15px 30px; border-radius: 20px; border: 1px solid var(--border); }
        .search-box { background: #1a1a1a; border-radius: 12px; padding: 10px 20px; display: flex; align-items: center; width: 300px; border: 1px solid transparent; transition: 0.3s; }
        .search-box:focus-within { border-color: var(--primary); }
        .search-box input { background: none; border: none; color: white; margin-left: 10px; outline: none; width: 100%; }
        .user-profile { display: flex; align-items: center; gap: 15px; }
        .user-avatar { width: 45px; height: 45px; background: var(--gradient); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; color: #000; }

        /* --- Welcome Section --- */
        .welcome-hero { margin-bottom: 40px; }
        .welcome-hero h1 { font-size: 2.2rem; margin-bottom: 5px; }
        .welcome-hero span { color: var(--primary); }
        .digital-clock { font-size: 0.9rem; color: var(--text-gray); font-family: monospace; }

        /* --- Stats Row --- */
        .stats-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px; }
        .stat-card { background: var(--card-bg); padding: 25px; border-radius: 24px; border: 1px solid var(--border); position: relative; overflow: hidden; }
        .stat-card::after { content: ''; position: absolute; top: 0; right: 0; width: 5px; height: 100%; background: var(--primary); opacity: 0; transition: 0.3s; }
        .stat-card:hover::after { opacity: 1; }
        .stat-card h4 { color: var(--text-gray); font-size: 0.8rem; text-transform: uppercase; margin-bottom: 10px; }
        .stat-card p { font-size: 1.8rem; font-weight: 700; }

        /* --- Section Container --- */
        .glass-panel { background: rgba(18, 18, 18, 0.6); backdrop-filter: blur(10px); border-radius: 30px; padding: 35px; border: 1px solid var(--border); margin-bottom: 40px; }
        .panel-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
        .panel-header h3 { font-size: 1.3rem; display: flex; align-items: center; gap: 10px; }
        .pulse-icon { width: 10px; height: 10px; background: var(--primary); border-radius: 50%; box-shadow: 0 0 10px var(--primary); animation: pulse 2s infinite; }

        @keyframes pulse { 0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(30, 215, 96, 0.7); } 70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(30, 215, 96, 0); } 100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(30, 215, 96, 0); } }

        /* --- Table Style --- */
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 15px; color: var(--text-gray); font-size: 0.8rem; border-bottom: 1px solid var(--border); }
        td { padding: 20px 15px; border-bottom: 1px solid var(--border); font-size: 0.95rem; }
        tr:last-child td { border: none; }
        
        .client-name { font-weight: 600; color: #fff; }
        .sport-badge { background: rgba(255,255,255,0.05); padding: 6px 14px; border-radius: 10px; font-size: 0.8rem; }

        /* --- Buttons --- */
        .btn-group { display: flex; gap: 10px; }
        .action-btn { width: 40px; height: 40px; border-radius: 12px; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: 0.3s; font-size: 1.1rem; }
        .btn-check { background: rgba(30, 215, 96, 0.15); color: var(--primary); }
        .btn-check:hover { background: var(--primary); color: #000; }
        .btn-x { background: rgba(255, 77, 77, 0.15); color: var(--danger); }
        .btn-x:hover { background: var(--danger); color: #fff; }

        .status-pill { padding: 6px 15px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; background: rgba(30, 215, 96, 0.1); color: var(--primary); border: 1px solid rgba(30, 215, 96, 0.2); }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><span>FIT</span> COACH</div>
        <a href="../controllers/coach.conttoleur.php" class="nav-link active">🏠 Dashboard</a>
        <a href="../controllers/seances_coach.controlleur.php" class="nav-link">🏋️ Mes Séances</a>
        <a href="../controllers/dispo.contorleurs.php" class="nav-link ">📅 Disponibilités</a>
        <a href="#" class="nav-link">👤 Mon Profil</a>
        <a href="../controllers/logoutContrelleur.php" class="nav-link" ><div  style="margin-top: auto; color: #ff4d4d; cursor: pointer;">🚪 Déconnexion</div></a>
    </aside>


    <main class="main-content">
        <div class="top-bar">
            <div class="search-box">
                🔍 <input type="text" placeholder="Rechercher un client...">
            </div>
            <div class="user-profile">
                <div class="digital-clock" id="clock">22:05:37</div>
                <div class="user-avatar">A</div>
            </div>
        </div>

        <div class="welcome-hero">
            <h1>Bienvenue, <span>Coach <?= $nom ?></span></h1>
            <p style="color: var(--text-gray);">Prêt pour vos prochaines séances de sport ?</p>
        </div>

        <div class="stats-row">
            <div class="stat-card"><h4>Séances Totales</h4><p>128</p></div>
            <div class="stat-card"><h4>Nouveaux</h4><p>+12</p></div>
            <div class="stat-card"><h4>En Attente</h4><p id="pending-count">2</p></div>
            <div class="stat-card"><h4>Revenus</h4><p>8,450 DH</p></div>
        </div>

        <div class="glass-panel">
            <div class="panel-header">
                <h3><div class="pulse-icon"></div> Demandes de réservation</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Discipline</th>
                        <th>Date & Heure</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="pending-list">
                    <?php foreach($resutlt as $res): ?>
                        <tr>
                            <td class="client-name"><?= $res['fulnameClient']?></td>
                            <td><span class="sport-badge"><?= $res['type']?></span></td>
                            <td><?= $res['dateandtime']?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="../controllers/accepteSeances.controleur.php?id=<?= $res['id_secances'] ?>"><button class="action-btn btn-check" onclick="confirmRow(this)" title="Confirmer">✓</button></a>
                                    <a href="../controllers/refuseSeances.controleur.php?id=<?= $res['id_secances'] ?>"><button class="action-btn btn-x" onclick="deleteRow(this)" title="Supprimer">✕</button></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

        <div class="glass-panel">
            <div class="panel-header">
                <h3>📅 Séances déjà confirmées</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Discipline</th>
                        <th>Date & Heure</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody id="confirmed-list">
                    <?php foreach($resutltAcc as $ress): ?>
                        <tr>
                            <td class="client-name"><?= $ress['fulnameClient']?></td>
                            <td><span class="sport-badge"><?= $ress['type']?></span></td>
                            <td><?= $ress['dateandtime']?></td>
                            <td><span class="status-pill"><?= $ress['type_status']?></span></td>
                        </tr>
                    <?php endforeach ?> 
                </tbody>
            </table>
        </div>
    </main>

    <script>
        // Real-time Clock logic
        function updateClock() {
            const now = new Date();
            document.getElementById('clock').innerText = now.toLocaleTimeString();
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Confirmation Logic with Animation
        function confirmRow(btn) {
            const row = btn.closest('tr');
            const confirmedTable = document.getElementById('confirmed-list');
            
            // Get data
            const name = row.querySelector('.client-name').innerText;
            const sport = row.querySelector('.sport-badge').innerText;
            const time = row.cells[2].innerText;

            // Animate and Remove
            row.style.transform = "scale(0.8)";
            row.style.opacity = "0";
            row.style.transition = "0.4s";

            setTimeout(() => {
                const newRow = `
                    <tr>
                        <td class="client-name">${name}</td>
                        <td><span class="sport-badge">${sport}</span></td>
                        <td>${time}</td>
                        <td><span class="status-pill">SÉANCE VALIDÉE</span></td>
                    </tr>
                `;
                confirmedTable.insertAdjacentHTML('afterbegin', newRow);
                row.remove();
                
                // Update stats counter
                const pending = document.getElementById('pending-count');
                pending.innerText = Math.max(0, parseInt(pending.innerText) - 1);
            }, 400);
        }

        // Delete Logic
        function deleteRow(btn) {
            if(confirm("Supprimer cette demande de réservation ?")) {
                const row = btn.closest('tr');
                row.style.opacity = "0";
                row.style.transform = "translateX(-20px)";
                row.style.transition = "0.3s";
                setTimeout(() => { 
                    row.remove();
                    const pending = document.getElementById('pending-count');
                    pending.innerText = Math.max(0, parseInt(pending.innerText) - 1);
                }, 300);
            }
        }
    </script>
</body>
</html>