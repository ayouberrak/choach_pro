<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Réservations - FitCoach</title>
    <link rel="stylesheet" href="../../public/includs/header.css">
    <link rel="stylesheet" href="../../public/includs/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1ed760; 
            --bg-dark: #0a0a0a; 
            --card-bg: #151515; 
            --text-white: #ffffff;
            --text-gray: #a0a0a0;
            --danger: #ff4757;
            --warning: #ffa502;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-white);
            margin: 0;
            padding-top: 100px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .page-title {
            margin-bottom: 30px;
            border-left: 4px solid var(--primary);
            padding-left: 15px;
        }

        .page-title h2 { font-size: 1.8rem; margin: 0; }
        .page-title p { color: var(--text-gray); font-size: 0.9rem; }

        /* --- Style dyal Table --- */
        .table-container {
            background: var(--card-bg);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #222;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead {
            background: #1f1f1f;
        }

        th {
            padding: 20px;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary);
            font-weight: 700;
        }

        td {
            padding: 18px 20px;
            border-bottom: 1px solid #222;
            font-size: 0.9rem;
            color: #eee;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover { background: rgba(30, 215, 96, 0.03); transition: 0.3s; }

        /* --- Status Badges --- */
        .status-badge {
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            background: rgba(255, 165, 2, 0.1);
            color: var(--warning);
            border: 1px solid var(--warning);
        }

        /* --- Action Buttons --- */
        .btn-action {
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 8px 12px;
            border-radius: 8px;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .btn-edit {
            background: rgba(30, 215, 96, 0.1);
            color: var(--primary);
            margin-right: 10px;
        }
        .btn-edit:hover { background: var(--primary); color: #000; }

        .btn-delete {
            background: rgba(255, 71, 87, 0.1);
            color: var(--danger);
        }
        .btn-delete:hover { background: var(--danger); color: #fff; }

        @media (max-width: 900px) {
            .table-container { overflow-x: auto; }
            th, td { padding: 15px; min-width: 120px; }
        }
    </style>
</head>
<body>
    <?php include_once __DIR__ .'/../../public/includs/header.php'; ?>

    <main class="container">
        <div class="page-title">
            <h2>Mes Réservations</h2>
            <p>Gérez vos séances et suivez vos progrès avec vos coachs.</p>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Coach</th>
                        <th>Date de la séance</th>
                        <th>Durée</th>
                        <th>Heure Début</th>
                        <th>Sport</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($reservation as $seances): ?>
                        <tr>
                            <td style="font-weight: 600; color: #fff;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 35px; height: 35px; background: #333; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; color: var(--primary); border: 1px solid var(--primary);">
                                        <?= strtoupper(substr($seances['fullname'], 0, 1)) ?>
                                    </div>
                                    <?= htmlspecialchars($seances['fullname']) ?>
                                </div>
                            </td>
                            <td class="js-date-formatter" data-raw-date="<?= $seances['date_seances'] ?>">
                                <?= htmlspecialchars($seances['date_seances']) ?>
                            </td>
                            <td><span style="color: var(--text-gray);"><?= htmlspecialchars($seances['duree']) ?> min</span></td>
                            <td><strong><?= htmlspecialchars($seances['debut']) ?></strong></td>
                            <td>
                                <span style="background: rgba(255,255,255,0.05); padding: 4px 10px; border-radius: 6px; font-size: 0.8rem;">
                                    <?= htmlspecialchars($seances['id_sport']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="status-badge">En attente</span>
                            </td>
                            <td>
                                <a href="edit_reservation.php?id=<?= $seances['id_secances'] ?>" class="btn-action btn-edit">
                                    ✏️ Modifier
                                </a>
                                <a href="delete_reservation.php?id=<?= $seances['id_secances'] ?>" class="btn-action btn-delete" onclick="return confirm('Voulez-vous vraiment annuler?')">
                                    🗑️ Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include_once __DIR__ .'/../../public/includs/footer.php'; ?>
    
    <script src="../../public/js/navbar.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // N-cheddo ga3 les cellules li fihom date
            const dateCells = document.querySelectorAll('.js-date-formatter');
            
            dateCells.forEach(cell => {
                let sqlDate = cell.getAttribute('data-raw-date');
                if (sqlDate) {
                    let dateObj = new Date(sqlDate);
                    
                    // Options dial l-formatage (français)
                    let options = { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' };
                    let formatted = dateObj.toLocaleDateString('fr-FR', options);
                    
                    // N-upper-i l-7erf l-awel
                    cell.innerText = formatted.charAt(0).toUpperCase() + formatted.slice(1);
                }
            });
        });
    </script>
</body>
</html>