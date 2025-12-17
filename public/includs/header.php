<?php
$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'user';
?>  
<nav class="navbar">
        <a href="index.php" class="logo">Fit<span>Coach</span></a>
        
        <div class="nav-links">
            <a href="../controllers/aceuliControleur.php">Accueil</a>
            <a href="../controllers/clientControlleur.php">Nos Coachs</a>
            <a href="../views/reservation.view.php">Contact</a>
        </div>

        <div class="nav-right">
            <div class="profile-container" id="profileDropdown">
                <div class="profile-trigger">
                    <span style="font-size: 0.85rem; font-weight: 600;"><?php echo htmlspecialchars($user_name); ?></span>
                    <div class="avatar-circle">U</div>
                </div>
                
                <div class="dropdown-menu" id="menuContent">
                    <a href="profile.php">👤 Mon Profil</a>
                    <a href="mes-seances.php">📅 Mes Séances</a>
                    <a href="../controllers/logoutContrelleur.php" class="logout-link">🚪 Déconnexion</a>
                </div>
            </div>
        </div>
    </nav>