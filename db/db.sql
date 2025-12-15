--role table
CREATE TABLE role (
    id_role INT PRIMARY KEY,
    type_role VARCHAR(50) NOT NULL
);

--role user
CREATE TABLE user (
    id INT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    id_role INT NOT NULL,
    FOREIGN KEY (id_role) REFERENCES role(id_role)
);

-- client table
CREATE TABLE client (
    id_client INT PRIMARY KEY,
    telephone VARCHAR(20),
    date_insc DATE,
    FOREIGN KEY (id_client) REFERENCES user(id)
);

-- client coach
CREATE TABLE coach (
    id_coach INT PRIMARY KEY,
    biographie TEXT,
    photo VARCHAR(255),
    annees_experiance INT DEFAULT 0,
    certification VARCHAR(255),
    FOREIGN KEY (id_coach) REFERENCES user(id)
);

--sport table
CREATE TABLE sport (
    id_sport INT PRIMARY KEY,
    type VARCHAR(100) NOT NULL,
    description TEXT
);

-- sport_coach table
CREATE TABLE sport_coach (
    id_sport INT NOT NULL,
    id_coach INT NOT NULL,
    PRIMARY KEY (id_sport, id_coach),
    FOREIGN KEY (id_sport) REFERENCES sport(id_sport),
    FOREIGN KEY (id_coach) REFERENCES coach(id_coach)
);

--status table
CREATE TABLE status (
    id_status INT PRIMARY KEY,
    type VARCHAR(50) NOT NULL
);

--seances table
CREATE TABLE seances (
    id_secances INT PRIMARY KEY,
    debut TIME NOT NULL,
    duree INT NOT NULL,
    id_client INT NOT NULL,
    id_coach INT NOT NULL,
    id_status INT NOT NULL,
    FOREIGN KEY (id_client) REFERENCES client(id_client),
    FOREIGN KEY (id_coach) REFERENCES coach(id_coach),
    FOREIGN KEY (id_status) REFERENCES status(id_status)
);

-- avis table
CREATE TABLE avis (
    id_avis INT PRIMARY KEY,
    id_client INT NOT NULL,
    id_seance INT NOT NULL,
    note INT NOT NULL CHECK (note >= 1 AND note <= 5),
    commentaire TEXT,
    date DATE NOT NULL,
    FOREIGN KEY (id_client) REFERENCES client(id_client),
    FOREIGN KEY (id_seance) REFERENCES seances(id_secances),
    UNIQUE (id_seance)
);

--disponible table
CREATE TABLE disponible (
    id_dispo INT PRIMARY KEY,
    id_coach INT NOT NULL,
    jour DATE NOT NULL,
    heures_debut DATETIME NOT NULL,
    heures_fin DATETIME NOT NULL,
    FOREIGN KEY (id_coach) REFERENCES coach(id_coach)
);




