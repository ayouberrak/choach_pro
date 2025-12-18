<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCoach - Elite Dashboard</title>
    <link rel="stylesheet" href="../../public/includs/header.css">
    <link rel="stylesheet" href="../../public/includs/footer.css">
        <script src="../../public/js/navbar.js" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #1ed760; 
            --bg-dark: #070707; 
            --sidebar-bg: rgba(15, 15, 15, 0.95);
            --card-bg: #121212; 
            --text-white: #ffffff;
            --text-gray: #888888;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-white);
            margin: 0;
            padding-top: 80px;
        }

        /* --- Sidebar Premium (Glassmorphism) --- */
        .sidebar {
            position: fixed;
            top: 0;
            left: -350px; 
            width: 320px;
            height: 100vh;
            background: var(--sidebar-bg);
            z-index: 2000;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1); /* Animation wa3ra */
            padding: 120px 40px;
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar.active {
            left: 0;
            box-shadow: 20px 0 50px rgba(0, 0, 0, 0.8);
        }

        /* --- Floating Toggle Button (Nadi) --- */
        .filter-trigger {
            position: fixed;
            bottom: 40px;
            left: 40px;
            width: 65px;
            height: 65px;
            background: var(--primary);
            border: none;
            border-radius: 20px;
            cursor: pointer;
            z-index: 2100;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.4s;
            box-shadow: 0 10px 30px rgba(30, 215, 96, 0.3);
        }

        .filter-trigger:hover {
            transform: scale(1.1) translateY(-5px);
            box-shadow: 0 15px 40px rgba(30, 215, 96, 0.5);
        }

        .filter-trigger svg {
            color: black;
            transition: 0.5s;
        }

        .sidebar.active ~ .filter-trigger {
            left: 280px; /* Kiy-t-jrr m3a sidebar */
            background: #fff;
        }

        /* --- Overlay --- */
        .body-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 1900;
            display: none;
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: 0.4s;
        }

        .body-overlay.active {
            display: block;
            opacity: 1;
        }

        /* --- Input Fields --- */
        .filter-item { margin-bottom: 35px; }
        .filter-item label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--primary);
            margin-bottom: 15px;
            display: block;
            font-weight: 700;
        }

        .custom-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid #222;
            padding: 15px;
            border-radius: 12px;
            color: white;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .custom-input:focus {
            border-color: var(--primary);
            background: rgba(30, 215, 96, 0.05);
            outline: none;
        }

        /* --- Disponibilité Toggle --- */
        .avail-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.03);
            padding: 15px;
            border-radius: 12px;
        }

        .switch {
            width: 45px; height: 22px;
            background: #333;
            border-radius: 50px;
            position: relative;
            cursor: pointer;
            transition: 0.4s;
        }

        .switch::before {
            content: '';
            position: absolute;
            width: 16px; height: 16px;
            background: white;
            border-radius: 50%;
            top: 3px; left: 3px;
            transition: 0.4s;
        }

        input:checked + .switch { background: var(--primary); }
        input:checked + .switch::before { left: 26px; }

        /* --- Main & Grid --- */
        .main-content {
            padding: 20px 5%;
            transition: 0.5s;
        }

        .coaches-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 40px;
        }

        .coach-card {
            background: var(--card-bg);
            border-radius: 30px;
            overflow: hidden;
            border: 1px solid #1a1a1a;
            transition: 0.4s;
        }

        .coach-card:hover { transform: translateY(-12px); border-color: var(--primary); }

        .img-box { height: 380px; position: relative; }
        .img-box img { width: 100%; height: 100%; object-fit: cover; }
        
        .overlay-text {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            padding: 30px;
            background: linear-gradient(transparent, rgba(0,0,0,0.9));
        }

        .btn-action {
            width: 100%;
            background: var(--primary);
            color: #000;
            border: none;
            padding: 16px;
            border-radius: 18px;
            font-weight: 800;
            cursor: pointer;
            transition: 0.3s;
        }
    </style>
</head>
<body>

    <?php include_once __DIR__ .'/../../public/includs/header.php'; ?>

    <div class="body-overlay" id="overlay"></div>

    <aside class="sidebar" id="sidebar">
        <div class="filter-item">
            <label>Recherche</label>
            <input type="text" class="custom-input" placeholder="Nom du coach...">
        </div>

        <div class="filter-item">
            <label>Discipline</label>
            <select class="custom-input">
                <option>Tous les sports</option>
                <option>Musculation</option>
                <option>Cardio</option>
                <option>Yoga</option>
            </select>
        </div>

        <div class="filter-item">
            <label>Statut</label>
            <div class="avail-box">
                <span style="font-size: 0.8rem; color: #aaa;">Disponible aujourd'hui</span>
                <label style="margin: 0;">
                    <input type="checkbox" hidden id="availCheck">
                    <div class="switch"></div>
                </label>
            </div>
        </div>

        <button class="btn-action" style="margin-top: 20px;">Filtrer</button>
    </aside>

    <button class="filter-trigger" id="toggleSidebar">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="2" y1="14" x2="6" y2="14"></line><line x1="10" y1="8" x2="14" y2="8"></line><line x1="18" y1="16" x2="22" y2="16"></line></svg>
    </button>

    <main class="main-content">
        <div style="margin-bottom: 50px;">
            <h1 style="font-size: 3rem; font-weight: 800; margin: 0;">Nos <span style="color: var(--primary);">Coachs</span></h1>
            <p style="color: var(--text-gray);">L'élite du sport, à votre portée.</p>
        </div>

        <div class="coaches-grid">
            <?php foreach ($chaoch as $coach): ?>
                <?php 
                    $pathPhoto = (!empty($coach['photo']) && file_exists('../../public/uploadss/' . $coach['photo'])) 
                                 ? '../../public/uploadss/' . basename($coach['photo']) 
                                 : '../../public/uploadss/default.jpeg'; 
                ?>
                <div class="coach-card">
                    <div class="img-box">
                        <img src="<?= $pathPhoto ?>" alt="Coach">
                        <div class="overlay-text">
                            <span style="color: var(--primary); font-size: 0.7rem; font-weight: 800; letter-spacing: 2px;">PRO COACH</span>
                            <h3 style="font-size: 1.6rem; margin: 5px 0;"><?= htmlspecialchars($coach['nom']) ?> <?= htmlspecialchars($coach['prenom']) ?></h3>
                        </div>
                    </div>
                    <div style="padding: 25px;">
                        <div style="display: flex; gap: 20px; margin-bottom: 20px; font-size: 0.8rem; color: #888;">
                            <span>⚡ <strong><?= htmlspecialchars($coach['annees_experiance']) ?></strong> Ans</span>
                            <span>🏅 <strong>Certifié</strong></span>
                            <span>👥 <strong><?= htmlspecialchars($coach['nb_clients'] ?? '150') ?>+</strong> Clients</span>
                        </div>
                        <a href="reservationControlleurs.php?id=<?= $coach['id_coach'] ?>" style="text-decoration: none;">
                            <button class="btn-action">Réserver maintenant</button>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include_once __DIR__ .'/../../public/includs/footer.php'; ?>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleBtn = document.getElementById('toggleSidebar');

        function toggle() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        }

        toggleBtn.addEventListener('click', toggle);
        overlay.addEventListener('click', toggle);
    </script>
</body>
</html>