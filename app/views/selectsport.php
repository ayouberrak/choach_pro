<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue Coach - Spécialités</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1ed760;
            --bg-dark: #0a0a0a;
            --card-bg: #161616;
            --text-white: #ffffff;
            --text-gray: #a0a0a0;
            --border: #262626;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-white);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .welcome-card {
            background: var(--card-bg);
            width: 100%;
            max-width: 550px;
            padding: 50px;
            border-radius: 30px;
            border: 1px solid var(--border);
            text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .welcome-card h1 {
            font-size: 2.2rem;
            margin-bottom: 10px;
            background: linear-gradient(to right, #fff, var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-card p {
            color: var(--text-gray);
            margin-bottom: 35px;
            font-size: 0.95rem;
        }

        /* --- Sport Tags Selection --- */
        .sports-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            margin-bottom: 30px;
        }

        .sport-tag {
            cursor: pointer;
            padding: 10px 20px;
            background: #222;
            border: 1px solid #333;
            border-radius: 50px;
            font-size: 0.9rem;
            transition: 0.3s;
            user-select: none;
        }

        .sport-tag:hover {
            border-color: var(--primary);
            background: rgba(30, 215, 96, 0.05);
        }

        .sport-tag.selected {
            background: var(--primary);
            color: #000;
            font-weight: 600;
            border-color: var(--primary);
            box-shadow: 0 5px 15px rgba(30, 215, 96, 0.3);
        }

        /* --- Autre Input --- */
        .autre-container {
            margin-top: 20px;
            text-align: left;
        }

        .autre-container label {
            display: block;
            font-size: 0.8rem;
            color: var(--text-gray);
            margin-bottom: 8px;
            margin-left: 5px;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            background: #111;
            border: 1px solid #333;
            border-radius: 12px;
            color: white;
            outline: none;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: var(--primary);
        }

        .btn-continue {
            width: 100%;
            background: var(--primary);
            color: #000;
            border: none;
            padding: 16px;
            border-radius: 15px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            margin-top: 30px;
            transition: 0.3s;
        }

        .btn-continue:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(30, 215, 96, 0.2);
        }
    </style>
</head>
<body>

    <div class="welcome-card">
        <h1>Hello, Coach! 👋</h1>
        <p>Quelles sont vos spécialités sportives ?</p>

        <form id="sportsForm">
            <div class="sports-grid">
                <div class="sport-tag" onclick="toggleSport(this)">Musculation</div>
                <div class="sport-tag" onclick="toggleSport(this)">Cardio Training</div>
                <div class="sport-tag" onclick="toggleSport(this)">Yoga</div>
                <div class="sport-tag" onclick="toggleSport(this)">Crossfit</div>
                <div class="sport-tag" onclick="toggleSport(this)">Boxe</div>
                <div class="sport-tag" onclick="toggleSport(this)">Natation</div>
                <div class="sport-tag" onclick="toggleSport(this)">Zumba</div>
            </div>

            <div class="autre-container">
                <label>Autre discipline (si non listée)</label>
                <input type="text" class="form-control" placeholder="Ex: Pilates, Karaté..." id="autreInput">
            </div>

            <button type="button" class="btn-continue" onclick="submitSelection()">Commencer mon aventure</button>
        </form>
    </div>

    <script>
        // Fonction bach n-selctionniw les tags
        function toggleSport(element) {
            element.classList.toggle('selected');
        }

        // Fonction bach n-jme3o dakshi li khtar
        function submitSelection() {
            const selectedSports = Array.from(document.querySelectorAll('.sport-tag.selected'))
                                       .map(tag => tag.innerText);
            const autreSport = document.getElementById('autreInput').value;

            if (selectedSports.length === 0 && !autreSport) {
                alert("Veuillez choisir au moins un sport !");
                return;
            }

            console.log("Sports choisis:", selectedSports);
            console.log("Autre:", autreSport);
            
            alert("Super ! Vos spécialités ont été enregistrées.");
            // Hna t-9der t-dir redirection l-dashboard
        }
    </script>
</body>
</html>