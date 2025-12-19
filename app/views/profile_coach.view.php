<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitCoach - Mon Profil</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760;
            --bg-dark: #080808;
            --card-bg: #121212;
            --text-white: #ffffff;
            --text-gray: #a0a0a0;
            --danger: #ff4d4d;
            --border: rgba(255, 255, 255, 0.08);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-dark); color: var(--text-white); display: flex; min-height: 100vh; }

        /* --- Sidebar --- */
        .sidebar { width: 280px; background: var(--card-bg); border-right: 1px solid var(--border); padding: 40px 25px; position: fixed; height: 100vh; z-index: 100; }
        .logo { font-size: 1.6rem; font-weight: 800; color: var(--primary); margin-bottom: 60px; display: flex; align-items: center; gap: 10px; }
        .logo span { background: var(--primary); color: #000; padding: 2px 8px; border-radius: 6px; }
        .nav-link { padding: 16px 20px; color: var(--text-gray); text-decoration: none; border-radius: 15px; margin-bottom: 8px; display: flex; align-items: center; gap: 15px; transition: 0.4s; }
        .nav-link:hover, .nav-link.active { background: rgba(30, 215, 96, 0.1); color: var(--primary); }

        /* --- Main Content --- */
        .main-content { flex: 1; margin-left: 280px; padding: 40px 50px; }
        
        /* --- Profile Layout Grid --- */
        .profile-container {
            display: grid;
            grid-template-columns: 350px 1fr;
            gap: 30px;
            margin-top: 30px;
        }

        /* --- Left Column: Info Card --- */
        .profile-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 40px 20px;
            text-align: center;
            height: fit-content;
        }

        .avatar-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 20px;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
            padding: 5px;
        }

        .edit-avatar-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: var(--primary);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 3px solid var(--card-bg);
        }

        .profile-card h2 { font-size: 1.4rem; margin-bottom: 5px; }
        .profile-card p { color: var(--text-gray); font-size: 0.9rem; margin-bottom: 25px; }

        .profile-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            border-top: 1px solid var(--border);
            padding-top: 25px;
        }

        .stat-item h3 { color: var(--primary); font-size: 1.2rem; }
        .stat-item span { font-size: 0.75rem; color: var(--text-gray); text-transform: uppercase; }

        /* --- Right Column: Edit Form --- */
        .edit-card {
            background: rgba(18, 18, 18, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: 30px;
            padding: 40px;
        }

        .form-section-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .edit-form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .full-width { grid-column: 1 / -1; }

        .input-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; }
        .input-group label { font-size: 0.8rem; color: var(--text-gray); font-weight: 600; }
        
        .form-control {
            background: #1a1a1a;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 14px;
            color: white;
            outline: none;
            transition: 0.3s;
        }
        .form-control:focus { border-color: var(--primary); box-shadow: 0 0 10px rgba(30, 215, 96, 0.1); }

        textarea.form-control { resize: none; height: 100px; }

        .btn-save {
            background: var(--primary);
            color: black;
            border: none;
            padding: 15px 40px;
            border-radius: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            width: fit-content;
        }
        .btn-save:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(30, 215, 96, 0.3); }

    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><span>FIT</span> COACH</div>
        <a href="../controllers/coach.conttoleur.php" class="nav-link">🏠 Dashboard</a>
        <a href="../controllers/seances_coach.controlleur.php" class="nav-link">🏋️ Mes Séances</a>
        <a href="../controllers/dispo.contorleurs.php" class="nav-link">📅 Disponibilités</a>
        <a href="#" class="nav-link active">👤 Mon Profil</a>
    </aside>

    <main class="main-content">
        <div class="header-page">
            <h1>👤 Paramètres du Profil</h1>
            <p style="color: var(--text-gray);">Gérez vos informations personnelles et publiques.</p>
        </div>

        <div class="profile-container">
            <div class="profile-card">
                <div class="avatar-container">
                    <img src="https://ui-avatars.com/api/?name=Coach+Name&background=1ed760&color=000" id="profileDisplay" class="avatar-img" alt="Avatar">
                    <label for="avatarInput" class="edit-avatar-btn">
                        📷
                    </label>
                    <input type="file" id="avatarInput" hidden accept="image/*" onchange="previewImage(this)">
                </div>
                <h2>Yassine Amrani</h2>
                <p>Coach Sportif Professionnel</p>

                <div class="profile-stats">
                    <div class="stat-item">
                        <h3>124</h3>
                        <span>Séances</span>
                    </div>
                    <div class="stat-item">
                        <h3>4.9</h3>
                        <span>Note</span>
                    </div>
                </div>
            </div>

            <div class="edit-card">
                <form action="update_profile.php" method="POST">
                    <div class="form-section-title">📝 Informations Générales</div>
                    <div class="edit-form-grid">
                        <div class="input-group">
                            <label>Nom complet</label>
                            <input type="text" class="form-control" name="nom" value="Yassine Amrani">
                        </div>
                        <div class="input-group">
                            <label>Spécialité</label>
                            <select class="form-control" name="specialite">
                                <option>Musculation</option>
                                <option>Crossfit</option>
                                <option>Yoga</option>
                                <option>Boxe</option>
                            </select>
                        </div>
                        <div class="input-group full-width">
                            <label>Bio (Description)</label>
                            <textarea class="form-control" name="bio">Passionné par le fitness depuis 10 ans, j'aide mes clients à atteindre leurs objectifs physiques avec un programme sur mesure.</textarea>
                        </div>
                    </div>

                    <div class="form-section-title" style="margin-top: 20px;">🔒 Sécurité & Contact</div>
                    <div class="edit-form-grid">
                        <div class="input-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="yassine@coach.com">
                        </div>
                        <div class="input-group">
                            <label>Téléphone</label>
                            <input type="text" class="form-control" name="tel" value="06 12 34 56 78">
                        </div>
                        <div class="input-group">
                            <label>Nouveau Mot de passe</label>
                            <input type="password" class="form-control" name="new_pass" placeholder="Laisse vide si inchangé">
                        </div>
                    </div>

                    <button type="submit" class="btn-save">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </main>

    <script>
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