<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Dashboard - FitCoach</title>
    <link rel="stylesheet" href="../../public/includs/header.css">
    <link rel="stylesheet" href="../../public/includs/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760; 
            --bg-dark: #0a0a0a; 
            --card-bg: #1a1a1a; 
            --text-white: #ffffff;
            --text-gray: #a0a0a0;
            --nav-bg: rgba(10, 10, 10, 0.98);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-white);
            margin: 0;
            padding-top: 90px;
        }
        /* --- Grid dyal Coachs --- */
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .coaches-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 30px; margin-top: 40px; }
        .coach-card { background: var(--card-bg); border-radius: 25px; overflow: hidden; border: 1px solid #222; transition: 0.4s; }
        .coach-card:hover { transform: scale(1.02); border-color: var(--primary); }
        .image-container { height: 350px; position: relative; }
        .image-container img { width: 100%; height: 100%; object-fit: cover; }
        .card-overlay { position: absolute; bottom: 0; left: 0; right: 0; padding: 25px; background: linear-gradient(transparent, rgba(0,0,0,0.95)); }
        .btn-reserve { width: 100%; background: var(--primary); color: #000; border: none; padding: 14px; border-radius: 15px; font-weight: 700; cursor: pointer; transition: 0.3s; margin-top: 15px; }
        .btn-reserve:hover { box-shadow: 0 0 20px rgba(30, 215, 96, 0.4); }

    </style>
</head>
<body>
<?php include_once __DIR__ .'/../../public/includs/header.php'; ?>


    <main class="container" id="coaches-section">
        <h2 style="font-size: 2rem; margin-bottom: 10px;">Trouvez votre <span style="color: var(--primary);">Coach</span></h2>
        <p style="color: var(--text-gray); margin-bottom: 30px;">Progressez avec les meilleurs experts certifiés.</p>

        <div class="coaches-grid">
            <?php foreach ($chaoch as $coach): ?>
                <?php 
                    $pathPhoto = (!empty($coach['photo']) && file_exists('../../public/uploadss/' . $coach['photo'])) 
                                 ? '../../public/uploadss/' . basename($coach['photo']) 
                                 : '../../public/uploadss/default.jpeg'; 
                ?>
                <div class="coach-card">
                    <div class="image-container">
                        <img src="<?= $pathPhoto ?>" alt="Coach">
                        <div class="card-overlay">
                            <span style="color: var(--primary); font-size: 0.75rem; font-weight: 800; letter-spacing: 1px;"><?= htmlspecialchars($coach['annees_experiance']) ?> ANS D'EXPÉRIENCE</span>
                            <h3 style="margin: 8px 0 0 0; font-size: 1.5rem;"><?= htmlspecialchars($coach['nom']) ?> <?= htmlspecialchars($coach['prenom']) ?></h3>
                        </div>
                    </div>
                    <div class="coach-details" style="padding: 20px;">
                        <p style="color: var(--text-gray); font-size: 0.9rem; line-height: 1.5; margin: 0 0 15px 0; height: 45px; overflow: hidden;">
                            <?= htmlspecialchars($coach['biographie']) ?>
                        </p>
                        <div style="font-size: 0.75rem; color: #777; margin-bottom: 15px;">🏅 <?= htmlspecialchars($coach['certification']) ?></div>
                        <button class="btn-reserve">Réserver une séance</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php include_once __DIR__ .'/../../public/includs/footer.php'; ?>
    </main>
    <script src="../../public/js/navbar.js"></script>
</body>
</html>