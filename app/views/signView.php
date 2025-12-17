<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire - FitCoach</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/signUp.css">
    <script src="../../public/js/formSignup.js"></script>

</head>
<body>

    <!-- New split layout wrapper -->
    <div class="split-container">
        <!-- Left side - Image -->
        <div class="image-side">
            <div class="image-overlay"></div>
            <img src="https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=1200&q=80" alt="Fitness motivation">
            <div class="image-content">
                <div class="brand">
                    <div class="brand-logo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8h1a4 4 0 0 1 0 8h-1"/>
                            <path d="M5 8H4a4 4 0 0 0 0 8h1"/>
                            <path d="M8 6v4"/>
                            <path d="M16 6v4"/>
                            <path d="M8 14v4"/>
                            <path d="M16 14v4"/>
                            <path d="M5 12h14"/>
                        </svg>
                    </div>
                    <span class="brand-name">FitCoach</span>
                </div>
                <div class="image-text">
                    <h2>Transformez votre vie</h2>
                    <p>Rejoignez des milliers de personnes qui ont atteint leurs objectifs fitness avec nos coachs experts.</p>
                </div>
                <div class="stats">
                    <div class="stat">
                        <span class="stat-number">10K+</span>
                        <span class="stat-label">Membres actifs</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">500+</span>
                        <span class="stat-label">Coachs certifiés</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">95%</span>
                        <span class="stat-label">Satisfaction</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right side - Form -->
        <div class="form-side">
            <div class="form-wrapper">
                <div class="form-header">
                    <h1>Créer un compte</h1>
                    <p class="subtitle">Commencez votre transformation aujourd'hui</p>
                </div>
                
                <form action="" method="post" enctype="multipart/form-data">
                    <div id="msj_error">
                        <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            if ($error === 'empty') {
                                echo '<p class="error-message">Veuillez remplir tous les champs obligatoires.</p>';
                            } elseif ($error === 'insertUser') {
                                echo '<p class="error-message">Erreur lors de la création du compte. Veuillez réessayer.</p>';
                            } elseif ($error === 'coach') {
                                echo '<p class="error-message">Veuillez remplir toutes les informations du coach.</p>';
                            } elseif ($error === 'exetension') {
                                echo '<p class="error-message">Format de photo non valide. Autorisé: jpg, jpeg, png, gif.</p>';
                            } elseif ($error === 'client') {
                                echo '<p class="error-message">Veuillez fournir un numéro de téléphone pour le client.</p>';
                            }
                        }
                        if (isset($_GET['success']) && $_GET['success'] == 1) {
                            echo '<p class="success-message">Inscription réussie! Vous pouvez maintenant vous connecter.</p>';
                        }
                        ?>

                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label for="nom">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                Nom
                            </label>
                            <input type="text" name="nom" id="nom" placeholder="Entrez votre nom" required>
                        </div>
                        <div class="input-group">
                            <label for="prenom">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                Prénom
                            </label>
                            <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom" required>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="email">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            Email
                        </label>
                        <input type="email" name="email" id="email" placeholder="exemple@email.com" required>
                    </div>

                    <div class="input-group">
                        <label for="password">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Mot de passe
                        </label>
                        <input type="password" name="password" id="password" placeholder="••••••••" required>
                    </div>

                    <div class="input-group">
                        <label for="roleSelect">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            Rôle
                        </label>
                        <select name="role" id="roleSelect">
                            <option selected disabled>Choisir votre rôle</option>
                            <?php foreach($roleSelect AS $role){ ?>
                                <option value="<?= $role['id_role']?>"><?= $role['type_role']?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Section Coach -->
                    <div id="divCoach" class="role-section">
                        <div class="section-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
                            Informations Coach
                        </div>
                        
                        <div class="input-group">
                            <label for="biographie">Biographie</label>
                            <textarea name="biographie" id="biographie" placeholder="Décrivez votre parcours et expertise..."></textarea>
                        </div>
                        
                        <div class="input-group file-input-group">
                            <label for="photo">Photo de profil</label>
                            <div class="file-input-wrapper">
                                <input type="file" name="photo" id="photo" accept="image/*">
                                <div class="file-input-display">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>
                                    <span>Choisir une photo</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="input-group">
                                <label for="annes_exepriances">Années d'expérience</label>
                                <input type="number" name="annes_exepriances" id="annes_exepriances" placeholder="0" min="0">
                            </div>
                            <div class="input-group">
                                <label for="certification">Certification</label>
                                <input type="text" name="certification" id="certification" placeholder="Ex: BPJEPS">
                            </div>
                        </div>
                    </div>

                    <!-- Section Client -->
                    <div id="divClient" class="role-section">
                        <div class="section-title">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            Informations Client
                        </div>
                        <div class="input-group">
                            <label for="tel">Numéro de téléphone</label>
                            <input type="tel" name="tel" id="tel" placeholder="+33 6 00 00 00 00">
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        <span>S'inscrire</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                </form>
                
                <div class="form-footer">
                    <p>Déjà un compte? <a href="../controllers/logincontoleur.php">Se connecter</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
