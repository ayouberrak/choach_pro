
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter - FitCoach</title>
    <link rel="stylesheet" href="../../public/css/login.css">
</head>
<body>
    <div class="split-container">
        <!-- Left side - Image -->
        <div class="image-side">
            <div class="image-overlay"></div>
            <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=1200&q=80" alt="Fitness motivation">
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
                    <h2>Bon retour parmi nous</h2>
                    <p>Continuez votre parcours fitness et atteignez vos objectifs avec nos coachs experts.</p>
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
                    <h1>Se connecter</h1>
                    <p class="subtitle">Accédez à votre espace personnel</p>
                </div>
                
                <form action="" method="post">
                    <div id="msj_error">
                        <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            if ($error === 'empty') {
                                echo '<p class="error-message">Veuillez remplir tous les champs.</p>';
                            } elseif ($error === 'invalid') {
                                echo '<p class="error-message">Email ou mot de passe incorrect.</p>';
                            } elseif ($error === 'role') {
                                echo '<p class="error-message">Rôle utilisateur non reconnu.</p>';
                            }
                        } elseif (isset($_GET['success']) && $_GET['success'] == '1') {
                            echo '<p class="success-message">Inscription réussie! Veuillez vous connecter.</p>';
                        }
                        ?>
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

                    <div class="form-options">
                        <label class="checkbox-wrapper=
                            <input type="checkbox" name="remember" id="remember">
=
                            <span class="checkmark"></span>
                            <span>Se souvenir de moi</span>
                        </label>
                        <a href="#" class="forgot-link">Mot de passe oublié?</a>
                    </div>
                    <button type="submit" class="submit-btn">
                        <span>Se connecter</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                </form>
                
                <div class="form-footer">
                    <p>Pas encore de compte? <a href="../controllers/signupControllers.php">S'inscrire</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
