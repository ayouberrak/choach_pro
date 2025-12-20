<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCoach - Elite Profile Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760;
            --primary-glow: rgba(30, 215, 96, 0.4);
            --bg-dark: #050505;
            --card-bg: rgba(18, 18, 18, 0.85);
            --text-white: #ffffff;
            --text-gray: #b0b0b0;
            --border: rgba(255, 255, 255, 0.08);
            --input-bg: rgba(255, 255, 255, 0.04);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); display: flex; min-height: 100vh; overflow-x: hidden; }

        /* --- Sidebar Style --- */
        .sidebar { width: 280px; background: #0a0a0a; border-right: 1px solid var(--border); padding: 40px 25px; position: fixed; height: 100vh; z-index: 100; }
        .logo { font-size: 1.6rem; font-weight: 800; color: var(--primary); margin-bottom: 60px; display: flex; align-items: center; gap: 10px; }
        .logo span { background: var(--primary); color: #000; padding: 2px 8px; border-radius: 6px; }
        .nav-link { padding: 16px 20px; color: var(--text-gray); text-decoration: none; border-radius: 15px; margin-bottom: 8px; display: flex; align-items: center; gap: 15px; transition: 0.4s; }
        .nav-link.active { background: rgba(30, 215, 96, 0.1); color: var(--primary); font-weight: 600; box-shadow: inset 0 0 10px rgba(30, 215, 96, 0.1); }

        /* --- Main Content Layout --- */
        .main-content { flex: 1; margin-left: 280px; padding: 50px 60px; position: relative; }
        
        /* Background Decor */
        .main-content::before {
            content: ''; position: absolute; top: -150px; right: -150px; width: 600px; height: 600px;
            background: radial-gradient(circle, var(--primary-glow) 0%, transparent 70%); z-index: -1;
        }

        .header-page { margin-bottom: 40px; }
        .header-page h1 { font-size: 2.5rem; font-weight: 800; letter-spacing: -1.5px; text-transform: uppercase; }
        .header-page span { color: var(--primary); text-shadow: 0 0 15px var(--primary-glow); }

        .profile-wrapper { display: grid; grid-template-columns: 350px 1fr; gap: 40px; align-items: start; }

        /* --- ID CARD (ELITE) --- */
        .id-card {
            background: var(--card-bg); backdrop-filter: blur(25px); border: 1px solid var(--border);
            border-radius: 45px; padding: 60px 30px; text-align: center; position: sticky; top: 40px;
            box-shadow: 0 40px 100px rgba(0,0,0,0.6); overflow: hidden;
            transition: 0.4s ease;
        }
        .id-card::after {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .avatar-box {
            position: relative; width: 180px; height: 180px; margin: 0 auto 30px;
            padding: 5px; background: linear-gradient(135deg, var(--primary), transparent); border-radius: 50%;
            animation: pulse-glow 3s infinite alternate;
        }
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 10px rgba(30, 215, 96, 0.1); }
            100% { box-shadow: 0 0 30px rgba(30, 215, 96, 0.3); }
        }

        .avatar-box img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 5px solid #0a0a0a; }
        
        .upload-btn {
            position: absolute; bottom: 8px; right: 8px; background: var(--primary); color: #000;
            width: 45px; height: 45px; border-radius: 50%; display: flex; align-items: center;
            justify-content: center; cursor: pointer; border: 4px solid #111; transition: 0.3s ease;
        }
        .upload-btn:hover { transform: scale(1.1) rotate(15deg); background: #fff; }

        .id-card h2 { font-size: 1.8rem; font-weight: 800; margin-bottom: 8px; background: linear-gradient(to bottom, #fff, #999); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .coach-tag { background: rgba(30, 215, 96, 0.1); color: var(--primary); padding: 6px 16px; border-radius: 50px; font-size: 0.75rem; font-weight: 700; letter-spacing: 1px; border: 1px solid rgba(30, 215, 96, 0.2); }

        /* --- SETTINGS FORM --- */
        .settings-card {
            background: var(--card-bg); backdrop-filter: blur(25px); border: 1px solid var(--border);
            border-radius: 45px; padding: 50px; box-shadow: 0 40px 80px rgba(0,0,0,0.4);
        }

        .section-title {
            display: flex; align-items: center; gap: 15px; margin: 40px 0 25px;
            padding-bottom: 15px; border-bottom: 1px solid var(--border);
        }
        .section-title::before { content: ''; width: 4px; height: 20px; background: var(--primary); border-radius: 10px; box-shadow: 0 0 10px var(--primary); }
        .section-title h3 { font-size: 1.2rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 25px; }
        .full { grid-column: 1 / -1; }

        .input-group { display: flex; flex-direction: column; gap: 10px; }
        .input-group label { font-size: 0.85rem; color: var(--text-gray); font-weight: 600; padding-left: 8px; }

        .modern-input, .modern-select {
            background: var(--input-bg); border: 1px solid var(--border);
            border-radius: 20px; padding: 18px 25px; color: #fff; font-family: inherit;
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1); font-size: 1rem; width: 100%;
        }
        .modern-select option { background: #111; }
        .modern-input:focus { border-color: var(--primary); outline: none; background: rgba(30, 215, 96, 0.03); box-shadow: 0 0 20px rgba(30, 215, 96, 0.1); }

        #otherSportContainer { margin-top: 15px; display: none; animation: slideDown 0.4s ease-out; }
        @keyframes slideDown { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }

        .btn-save {
            background: linear-gradient(135deg, var(--primary), #17b950);
            color: #000; border: none; padding: 22px 60px; border-radius: 25px;
            font-weight: 800; font-size: 1.1rem; cursor: pointer; transition: 0.4s ease;
            margin-top: 40px; text-transform: uppercase; letter-spacing: 2px; width: 100%;
            box-shadow: 0 15px 35px var(--primary-glow);
        }
        .btn-save:hover { transform: translateY(-5px); box-shadow: 0 25px 50px var(--primary-glow); }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-dark); }
        ::-webkit-scrollbar-thumb { background: #222; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><span>FIT</span> COACH</div>
        <a href="../controllers/coach.conttoleur.php" class="nav-link">🏠 Dashboard</a>
        <a href="../controllers/seances_coach.controlleur.php" class="nav-link">🏋️ Mes Séances</a>
        <a href="../controllers/dispo.contorleurs.php" class="nav-link">📅 Disponibilités</a>
        <a href="../controllers/profile_coach.controleur.php" class="nav-link active">👤 Mon Profil</a>
        <div style="position: absolute; bottom: 30px; width: 80%;">
            <a href="../controllers/logoutContrelleur.php" class="nav-link" style="color: #ff4d4d;">🚪 Déconnexion</a>
        </div>
    </aside>

    <main class="main-content">
        <div class="header-page">
            <h1>Profil <span>Coach Elite</span></h1>
            <p style="color: var(--text-gray); margin-top: 5px;">Optimisez vos informations pour attirer plus d'athlètes.</p>
        </div>

        <?php 
            $pathPhoto = (!empty($coach['photo']) && file_exists('../../public/uploadss/' . $coach['photo'])) 
                         ? '../../public/uploadss/' . basename($coach['photo']) 
                         : '../../public/uploadss/default.jpeg'; 
        ?>

        <div class="profile-wrapper">
            <div class="id-card">
                <div class="avatar-box">
                    <img src="<?= $pathPhoto ?>" id="profileDisplay">
                    <label for="avatarInput" class="upload-btn">📷</label>
                </div>
                <h2><?= htmlspecialchars($coach['nom'] . ' ' . $coach['prenom']) ?></h2>
                <span class="coach-tag">Coach Partenaire Certifié</span>
                
                <div style="margin-top: 40px; border-top: 1px solid var(--border); padding-top: 30px; display: flex; justify-content: space-around;">
                    <div><p style="font-size: 1.2rem; font-weight: 700;"><?= $coach['annees_experiance'] ?>+</p><span style="font-size: 0.6rem; color: var(--text-gray); text-transform: uppercase;">Années EXP</span></div>
                    <div><p style="font-size: 1.2rem; font-weight: 700;">4.9</p><span style="font-size: 0.6rem; color: var(--text-gray); text-transform: uppercase;">Rating</span></div>
                </div>
            </div>

            <div class="settings-card">
                <form action="  " method="POST" enctype="multipart/form-data">
                    <input type="file" id="avatarInput" name="photo" hidden accept="image/*" onchange="previewImage(this)">
                    
                    <div class="section-title"><h3>Identité & Compte</h3></div>
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Nom</label>
                            <input type="text" class="modern-input" name="nom" value="<?= htmlspecialchars($coach['nom']) ?>">
                        </div>
                        <div class="input-group">
                            <label>Prénom</label>
                            <input type="text" class="modern-input" name="prenom" value="<?= htmlspecialchars($coach['prenom']) ?>">
                        </div>
                        <div class="input-group full">
                            <label>Email Professionnel</label>
                            <input type="email" class="modern-input" name="email" value="<?= htmlspecialchars($coach['email']) ?>">
                        </div>
                        <div class="input-group full">
                            <label>Nouveau Mot de Passe (Optionnel)</label>
                            <input type="password" class="modern-input" name="password" placeholder="Laissez vide pour conserver l'actuel">
                        </div>
                    </div>

                    <div class="section-title"><h3>Expertise & Expérience</h3></div>
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Années d'expérience</label>
                            <input type="number" class="modern-input" name="experience" value="<?= $coach['annees_experiance'] ?>">
                        </div>
                        
                        <div class="input-group full">
                            <label>Certifications & Diplômes</label>
                            <input type="text" class="modern-input" name="certificats" value="<?= htmlspecialchars($coach['certification']) ?>" placeholder="Ex: Master STAPS, BPJEPS...">
                        </div>
                        <div class="input-group full">
                            <label>Ma Philosophie de Coaching (Bio)</label>
                            <textarea class="modern-input" name="bio" rows="5"><?= htmlspecialchars($coach['biographie']) ?></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-save">Sauvegarder les modifications</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        function toggleOtherSport() {
            const select = document.getElementById('sportSelect');
            const otherContainer = document.getElementById('otherSportContainer');
            if (select.value === 'autres') {
                otherContainer.style.display = 'block';
            } else {
                otherContainer.style.display = 'none';
            }
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileDisplay').src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>