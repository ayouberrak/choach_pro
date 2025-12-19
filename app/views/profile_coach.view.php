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
            --card-bg: rgba(15, 15, 15, 0.9);
            --text-white: #ffffff;
            --text-gray: #a0a0a0;
            --border: rgba(255, 255, 255, 0.07);
            --input-bg: rgba(255, 255, 255, 0.03);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); display: flex; min-height: 100vh; }

        /* --- Sidebar (Consistent) --- */
        .sidebar { width: 280px; background: #0a0a0a; border-right: 1px solid var(--border); padding: 40px 25px; position: fixed; height: 100vh; z-index: 100; }
        .logo { font-size: 1.6rem; font-weight: 800; color: var(--primary); margin-bottom: 60px; display: flex; align-items: center; gap: 10px; }
        .logo span { background: var(--primary); color: #000; padding: 2px 8px; border-radius: 6px; }
        .nav-link { padding: 16px 20px; color: var(--text-gray); text-decoration: none; border-radius: 15px; margin-bottom: 8px; display: flex; align-items: center; gap: 15px; transition: 0.4s; }
        .nav-link.active { background: rgba(30, 215, 96, 0.1); color: var(--primary); font-weight: 600; }

        /* --- Main Content --- */
        .main-content { flex: 1; margin-left: 280px; padding: 50px 60px; position: relative; }
        
        /* Background Glow Decor */
        .main-content::before {
            content: ''; position: absolute; top: -100px; right: -100px; width: 500px; height: 500px;
            background: var(--primary-glow); filter: blur(150px); border-radius: 50%; z-index: -1;
        }

        .header-page { margin-bottom: 40px; }
        .header-page h1 { font-size: 2.5rem; font-weight: 800; letter-spacing: -1.5px; }
        .header-page span { color: var(--primary); }

        .profile-wrapper { display: grid; grid-template-columns: 380px 1fr; gap: 40px; }

        /* --- ID CARD (NADI STYLE) --- */
        .id-card {
            background: var(--card-bg); backdrop-filter: blur(30px); border: 1px solid var(--border);
            border-radius: 40px; padding: 50px 30px; text-align: center; position: sticky; top: 50px;
            box-shadow: 0 40px 80px rgba(0,0,0,0.6); overflow: hidden;
        }
        .id-card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .avatar-box {
            position: relative; width: 160px; height: 160px; margin: 0 auto 30px;
            padding: 5px; background: linear-gradient(135deg, var(--primary), transparent); border-radius: 50%;
        }
        .avatar-box img { width: 100%; height: 100%; border-radius: 50%; object-fit: cover; border: 4px solid #050505; }
        
        .upload-btn {
            position: absolute; bottom: 5px; right: 5px; background: var(--primary); color: #000;
            width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center;
            justify-content: center; cursor: pointer; border: 3px solid #0a0a0a; transition: 0.3s;
        }
        .upload-btn:hover { transform: scale(1.1) rotate(10deg); background: #fff; }

        .id-card h2 { font-size: 1.7rem; font-weight: 700; margin-bottom: 8px; }
        .badge-elite { 
            background: rgba(30, 215, 96, 0.1); color: var(--primary); padding: 5px 15px;
            border-radius: 20px; font-size: 0.75rem; font-weight: 700; letter-spacing: 1px; border: 1px solid var(--primary-glow);
        }

        /* --- Settings Card (Main) --- */
        .settings-card {
            background: var(--card-bg); backdrop-filter: blur(30px); border: 1px solid var(--border);
            border-radius: 40px; padding: 50px; box-shadow: 0 40px 80px rgba(0,0,0,0.4);
        }

        .section-title {
            display: flex; align-items: center; gap: 12px; margin: 40px 0 25px;
            padding-bottom: 15px; border-bottom: 1px solid var(--border);
        }
        .section-title:first-child { margin-top: 0; }
        .section-title i { color: var(--primary); font-size: 1.4rem; }
        .section-title h3 { font-size: 1.2rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; }

        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .full { grid-column: 1 / -1; }

        .input-group { display: flex; flex-direction: column; gap: 10px; }
        .input-group label { font-size: 0.8rem; color: var(--text-gray); font-weight: 600; padding-left: 5px; }

        .modern-input {
            background: var(--input-bg); border: 1px solid var(--border);
            border-radius: 18px; padding: 16px 22px; color: #fff; font-family: inherit;
            transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1); font-size: 0.95rem;
        }
        .modern-input:focus {
            background: rgba(30, 215, 96, 0.03); border-color: var(--primary); outline: none;
            box-shadow: 0 0 20px rgba(30, 215, 96, 0.1);
        }

        textarea.modern-input { resize: none; min-height: 120px; }

        /* Dynamic Tags (Sports/Certs) */
        .tags-container { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 15px; }
        .tag {
            background: #1a1a1a; border: 1px solid var(--border); padding: 8px 16px;
            border-radius: 12px; display: flex; align-items: center; gap: 10px; font-size: 0.85rem;
        }
        .tag .remove { cursor: pointer; color: var(--danger); font-weight: 800; }

        .btn-save {
            background: linear-gradient(135deg, var(--primary), #17b950);
            color: #000; border: none; padding: 20px 60px; border-radius: 20px;
            font-weight: 800; font-size: 1rem; cursor: pointer; transition: 0.4s;
            margin-top: 50px; text-transform: uppercase; letter-spacing: 1.5px;
            box-shadow: 0 10px 30px var(--primary-glow); width: 100%;
        }
        .btn-save:hover { transform: translateY(-5px); box-shadow: 0 20px 40px var(--primary-glow); }

    </style>
</head>
<body>



    <aside class="sidebar">
        <div class="logo"><span>FIT</span> COACH</div>
        <a href="../controllers/coach.conttoleur.php" class="nav-link ">🏠 Dashboard</a>
        <a href="../controllers/seances_coach.controlleur.php" class="nav-link">🏋️ Mes Séances</a>
        <a href="../controllers/dispo.contorleurs.php" class="nav-link ">📅 Disponibilités</a>
        <a href="../controllers/profile_coach.controleur.php" class="nav-link active">👤 Mon Profil</a>
        <a href="../controllers/logoutContrelleur.php" class="nav-link" ><div  style="margin-top: auto; color: #ff4d4d; cursor: pointer;">🚪 Déconnexion</div></a>
    </aside>


    <main class="main-content">
        <div class="header-page">
            <h1>MON ESPACE <span>ELITE</span></h1>
            <p style="color: var(--text-gray);">Mettez à jour vos informations pour booster votre visibilité.</p>
        </div>

        <div class="profile-wrapper">
            <div class="id-card">
                <div class="avatar-box">
                    <img src="https://ui-avatars.com/api/?name=Coach+Elite&background=1ed760&color=000&size=200" id="profileDisplay" alt="Coach">
                    <label for="avatarInput" class="upload-btn">📷</label>
                    <input type="file" id="avatarInput" hidden accept="image/*" onchange="previewImage(this)">
                </div>
                <h2 id="previewName">Coach Name</h2>
                <span class="badge-elite">Certified Expert</span>
                
                <div style="margin-top: 30px; text-align: left; background: rgba(255,255,255,0.02); padding: 20px; border-radius: 20px;">
                    <p style="font-size: 0.8rem; color: var(--text-gray); margin-bottom: 5px;">SPÉCIALITÉS :</p>
                    <div id="previewSports" style="font-size: 0.9rem; font-weight: 600; color: var(--primary);">Musculation, Crossfit</div>
                </div>
            </div>

            <div class="settings-card">
                <form action="update_profile.php" method="POST">
                    
                    <div class="section-title"><h3>👤 Identité & Contact</h3></div>
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Nom</label>
                            <input type="text" class="modern-input" name="nom" placeholder="Votre nom">
                        </div>
                        <div class="input-group">
                            <label>Prénom</label>
                            <input type="text" class="modern-input" name="prenom" placeholder="Votre prénom">
                        </div>
                        <div class="input-group">
                            <label>Email Professionnel</label>
                            <input type="email" class="modern-input" name="email" value="coach@fitcoach.ma">
                        </div>
                        <div class="input-group">
                            <label>Nouveau Mot de Passe</label>
                            <input type="password" class="modern-input" name="password" placeholder="••••••••">
                        </div>
                    </div>

                    <div class="section-title"><h3>💪 Expertise & Expérience</h3></div>
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Années d'expérience</label>
                            <input type="number" class="modern-input" name="experience" value="5">
                        </div>
                        <div class="input-group">
                            <label>Sports enseignés (séparés par virgule)</label>
                            <input type="text" class="modern-input" name="sports" value="Musculation, Crossfit, Boxe">
                        </div>
                        <div class="input-group full">
                            <label>Certificats & Diplômes</label>
                            <input type="text" class="modern-input" name="certificats" placeholder="Ex: BPJEPS AF, Certification Nutrition Level 1">
                        </div>
                        <div class="input-group full">
                            <label>Biographie Professionnelle</label>
                            <textarea class="modern-input" name="bio" placeholder="Parlez de votre parcours et de votre méthode de coaching..."></textarea>
                        </div>
                    </div>

                    <button type="submit" class="btn-save">Enregistrer l'Elite Profil</button>
                </form>
            </div>
        </div>
    </main>

    <script>
        // Preview de l'image
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