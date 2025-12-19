<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCoach - Mes Séances</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760;
            --bg-dark: #080808;
            --card-bg: #121212;
            --text-white: #ffffff;
            --text-gray: #888888;
            --danger: #ff4d4d;
            --warning: #ffa502;
            --info: #00d2ff;
            --border: rgba(255, 255, 255, 0.05);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); display: flex; min-height: 100vh; }

        /* --- Sidebar (Identique au Dashboard) --- */
        .sidebar { width: 280px; background: var(--card-bg); border-right: 1px solid var(--border); padding: 40px 25px; position: fixed; height: 100vh; z-index: 100; }
        .logo { font-size: 1.6rem; font-weight: 800; color: var(--primary); letter-spacing: -1px; margin-bottom: 60px; display: flex; align-items: center; gap: 10px; }
        .logo span { background: var(--primary); color: #000; padding: 2px 8px; border-radius: 6px; }
        
        .nav-link { padding: 16px 20px; color: var(--text-gray); text-decoration: none; border-radius: 15px; margin-bottom: 8px; display: flex; align-items: center; gap: 15px; transition: 0.4s; font-weight: 500; }
        .nav-link:hover, .nav-link.active { background: rgba(30, 215, 96, 0.08); color: var(--primary); }

        /* --- Main Content --- */
        .main-content { flex: 1; margin-left: 280px; padding: 40px 50px; }

        .page-header { margin-bottom: 40px; }
        .page-header h1 { font-size: 2rem; margin-bottom: 10px; }

        /* --- Filter Tabs (Nadi Style) --- */
        .filter-tabs { display: flex; gap: 15px; margin-bottom: 30px; background: rgba(255,255,255,0.02); padding: 10px; border-radius: 20px; width: fit-content; border: 1px solid var(--border); }
        .tab { padding: 10px 25px; border-radius: 12px; cursor: pointer; transition: 0.3s; font-size: 0.9rem; font-weight: 500; color: var(--text-gray); }
        .tab:hover { color: #fff; }
        .tab.active { background: var(--primary); color: #000; font-weight: 600; box-shadow: 0 5px 15px rgba(30, 215, 96, 0.3); }

        /* --- Glass Panel Table --- */
        .glass-panel { background: rgba(18, 18, 18, 0.6); backdrop-filter: blur(10px); border-radius: 30px; padding: 30px; border: 1px solid var(--border); animation: fadeInUp 0.5s ease; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 15px; color: var(--text-gray); font-size: 0.8rem; text-transform: uppercase; border-bottom: 1px solid var(--border); }
        td { padding: 20px 15px; border-bottom: 1px solid var(--border); font-size: 0.95rem; vertical-align: middle; }
        tr:last-child td { border: none; }
        tr:hover { background: rgba(255,255,255,0.02); transition: 0.2s; }

        /* --- Status Badges (Nadyin) --- */
        .badge { padding: 6px 14px; border-radius: 10px; font-size: 0.75rem; font-weight: 700; display: inline-block; text-transform: uppercase; letter-spacing: 0.5px; }
        
        .status-accepted { background: rgba(30, 215, 96, 0.1); color: var(--primary); border: 1px solid rgba(30, 215, 96, 0.2); }
        .status-pending { background: rgba(255, 165, 2, 0.1); color: var(--warning); border: 1px solid rgba(255, 165, 2, 0.2); }
        .status-finished { background: rgba(0, 210, 255, 0.1); color: var(--info); border: 1px solid rgba(0, 210, 255, 0.2); }
        .status-refused { background: rgba(255, 77, 77, 0.1); color: var(--danger); border: 1px solid rgba(255, 77, 77, 0.2); }

        .client-cell { display: flex; align-items: center; gap: 12px; }
        .client-avatar { width: 35px; height: 35px; border-radius: 50%; background: #333; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: 600; color: var(--primary); border: 1px solid var(--border); }

        .sport-tag { color: var(--text-gray); font-size: 0.85rem; font-style: italic; }

        /* --- Hidden rows logic --- */
        .session-row { display: table-row; }
        .hidden { display: none; }

    </style>
</head>
<body>



    <aside class="sidebar">
        <div class="logo"><span>FIT</span> COACH</div>
        <a href="../controllers/coach.conttoleur.php" class="nav-link">🏠 Dashboard</a>
        <a href="../controllers/seances_coach.controlleur.php" class="nav-link active">🏋️ Mes Séances</a>
        <a href="../controllers/dispo.contorleurs.php" class="nav-link ">📅 Disponibilités</a>
        <a href="#" class="nav-link">👤 Mon Profil</a>
        <a href="../controllers/logoutContrelleur.php" class="nav-link" ><div  style="margin-top: auto; color: #ff4d4d; cursor: pointer;">🚪 Déconnexion</div></a>
    </aside>



    <main class="main-content">
        <div class="page-header">
            <h1>🏋️ Mes Séances</h1>
            <p style="color: var(--text-gray);">Historique et planning de vos entraînements.</p>
        </div>

        <div class="filter-tabs">
            <div class="tab active" onclick="filterSessions('all', this)">Toutes</div>
            <div class="tab" onclick="filterSessions('accepté', this)">Acceptées</div>
            <div class="tab" onclick="filterSessions('en attente', this)">En attente</div>
            <div class="tab" onclick="filterSessions('terminé', this)">Terminées</div>
            <div class="tab" onclick="filterSessions('refusé', this)">Refusées</div>
        </div>

        <div class="glass-panel">
            <table id="sessionsTable">
                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Discipline</th>
                        <th>Date & Heure</th>
                        <th>Durée</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($seances as $sean): ?>
                    <tr class="session-row" data-status="<?= $sean['type_status'] ?>">
                        <td>
                            <div class="client-cell">
                                <div class="client-avatar">YA</div>
                                <span style="font-weight: 600;"><?= $sean['fulnameClient'] ?></span>
                            </div>
                        </td>
                        <td><span class="sport-tag"><?= $sean['type'] ?></span></td>
                        <td><?= $sean['dateandtime'] ?></td>
                        <td><?= $sean['duree']?>min</td>
                        <td><span class="badge <?= $sean['style'] ?>"><?= $sean['type_status'] ?></span></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </main>

    <script>
        function filterSessions(status, tabElement) {
            // 1. Gérer les onglets actifs
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            tabElement.classList.add('active');

            // 2. Filtrer les lignes du tableau
            const rows = document.querySelectorAll('.session-row');
            
            rows.forEach(row => {
                const rowStatus = row.getAttribute('data-status');
                
                if (status === 'all' || rowStatus === status) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>