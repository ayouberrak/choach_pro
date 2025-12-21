<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations - FitCoach Elite</title>
    <link rel="stylesheet" href="../../public/includs/header.css">
    <link rel="stylesheet" href="../../public/includs/footer.css">
        <script src="../../public/js/navbar.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1ed760; 
            --primary-glow: rgba(30, 215, 96, 0.3);
            --bg-dark: #050505; 
            --card-bg: rgba(18, 18, 18, 0.8); 
            --text-white: #ffffff;
            --text-gray: #b0b0b0;
            --danger: #ff4757;
            --warning: #ffa502;
            --border: rgba(255, 255, 255, 0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-white);
            line-height: 1.6;
            overflow-x: hidden;
            padding-bottom: 50px;
        }

        /* --- Background Glow --- */
        body::before {
            content: ''; position: fixed; top: -10%; right: -10%; width: 400px; height: 400px;
            background: radial-gradient(circle, var(--primary-glow) 0%, transparent 70%); z-index: -1;
        }

        .container {
            max-width: 1200px;
            margin: 120px auto 40px;
            padding: 0 25px;
        }

        .header-section {
            margin-bottom: 45px;
            position: relative;
        }

        .header-section h2 { 
            font-size: 2.5rem; 
            font-weight: 800; 
            letter-spacing: -1.5px; 
            text-transform: uppercase;
        }
        
        .header-section h2 span {
            color: var(--primary);
            text-shadow: 0 0 15px var(--primary-glow);
        }

        .header-section p { 
            color: var(--text-gray); 
            font-size: 1rem;
            margin-top: 5px;
        }

        /* --- Table Styling (Elite Style) --- */
        .table-wrapper {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 35px;
            padding: 20px;
            border: 1px solid var(--border);
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 12px; /* Had l-espace bin les lignes kiy-khliha tban nadiya */
            text-align: left;
        }

        th {
            padding: 15px 25px;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--text-gray);
            font-weight: 700;
        }

        tbody tr {
            background: rgba(255, 255, 255, 0.02);
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        tbody tr:hover {
            background: rgba(30, 215, 96, 0.05);
            transform: scale(1.01);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        td {
            padding: 20px 25px;
            font-size: 0.95rem;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        td:first-child { border-left: 1px solid var(--border); border-radius: 20px 0 0 20px; }
        td:last-child { border-right: 1px solid var(--border); border-radius: 0 20px 20px 0; }

        /* --- Coach Info Style --- */
        .coach-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .coach-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), #111);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #000;
            border: 2px solid #222;
        }

        .sport-tag {
            background: rgba(255, 255, 255, 0.05);
            padding: 6px 14px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #eee;
            border: 1px solid var(--border);
        }

        /* --- Status Badge --- */
        .status-badge {
            padding: 8px 16px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: rgba(255, 165, 2, 0.1);
            color: var(--warning);
            border: 1px solid rgba(255, 165, 2, 0.2);
            display: inline-block;
        }
        .status-accepted { background: rgba(30, 215, 96, 0.1); color: var(--primary); border: 1px solid rgba(30, 215, 96, 0.2); }
        .status-pending { background: rgba(255, 165, 2, 0.1); color: var(--warning); border: 1px solid rgba(255, 165, 2, 0.2); }
        .status-finished { background: rgba(0, 210, 255, 0.1); color: var(--info); border: 1px solid rgba(0, 210, 255, 0.2); }
        .status-refused { background: rgba(255, 77, 77, 0.1); color: var(--danger); border: 1px solid rgba(255, 77, 77, 0.2); }


        /* --- Action Buttons --- */
        .actions-flex {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: 0.3s;
            border: 1px solid var(--border);
        }

        .btn-edit { background: rgba(30, 215, 96, 0.1); color: var(--primary); }
        .btn-edit:hover { background: var(--primary); color: #000; transform: translateY(-3px); }

        .btn-delete { background: rgba(255, 71, 87, 0.1); color: var(--danger); }
        .btn-delete:hover { background: var(--danger); color: #fff; transform: translateY(-3px); }

        @media (max-width: 1024px) {
            .table-wrapper { overflow-x: auto; }
            table { min-width: 900px; }
        }
    </style>
</head>
<body>
    <?php include_once __DIR__ .'/../../public/includs/header.php'; ?>

    <main class="container">
        <div class="header-section">
            <h2>Mes <span>Réservations</span></h2>
            <p>Gérez vos séances et suivez votre évolution avec l'élite.</p>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Coach</th>
                        <th>Date de la séance</th>
                        <th>Détails</th>
                        <th>Sport</th>
                        <th>Statut</th>
                        <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($reservation)): ?>
                        <?php foreach($reservation as $seances): ?>
                            <tr>
                                <td>
                                    <div class="coach-info">
                                        <div class="coach-avatar">
                                            <?= strtoupper(substr($seances['fullname'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div style="font-weight: 700; color: #fff;"><?= htmlspecialchars($seances['fullname']) ?></div>
                                            <div style="font-size: 0.75rem; color: var(--text-gray);">Coach Certifié</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="js-date-formatter" data-raw-date="<?= $seances['date_seances'] ?>" style="font-weight: 600;">
                                        <?= htmlspecialchars($seances['date_seances']) ?>
                                    </div>
                                    <div style="font-size: 0.8rem; color: var(--primary);">🕒 <?= htmlspecialchars($seances['debut']) ?></div>
                                </td>
                                <td>
                                    <div style="color: #fff; font-weight: 500;"><?= htmlspecialchars($seances['duree']) ?> Min</div>
                                    <div style="font-size: 0.75rem; color: var(--text-gray);">Session Intensive</div>
                                </td>
                                <td>
                                    <span class="sport-tag">
                                        <?= htmlspecialchars($seances['id_sport']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge <?= htmlspecialchars($seances['style']) ?>"><?= htmlspecialchars($seances['type_status']) ?></span>
                                </td>
                                <td>
                                    <div class="actions-flex" style="justify-content: center;">
                                        <a href="edit_reservation.php?id=<?= $seances['id_secances'] ?>" class="btn-action btn-edit" title="Modifier">
                                            ✏️
                                        </a>
                                        <a href="delete_reservation.php?id=<?= $seances['id_secances'] ?>" class="btn-action btn-delete" title="Annuler" onclick="return confirm('Voulez-vous vraiment annuler?')">
                                            🗑️
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 50px; color: var(--text-gray);">
                                🚀 Aucune réservation pour le moment.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include_once __DIR__ .'/../../public/includs/footer.php'; ?>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateCells = document.querySelectorAll('.js-date-formatter');
            dateCells.forEach(cell => {
                let sqlDate = cell.getAttribute('data-raw-date');
                if (sqlDate) {
                    let dateObj = new Date(sqlDate);
                    let options = { weekday: 'short', day: 'numeric', month: 'short', year: 'numeric' };
                    let formatted = dateObj.toLocaleDateString('fr-FR', options);
                    cell.innerText = formatted.charAt(0).toUpperCase() + formatted.slice(1);
                }
            });
        });
    </script>
</body>
</html>