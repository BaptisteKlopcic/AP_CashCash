
DROP TABLE IF EXISTS Controler;
DROP TABLE IF EXISTS Travailler;
DROP TABLE IF EXISTS Posseder;
DROP TABLE IF EXISTS Intervention;
DROP TABLE IF EXISTS Technicien;
DROP TABLE IF EXISTS Employe_;
DROP TABLE IF EXISTS Materiel;
DROP TABLE IF EXISTS ContratMaintenance;
DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS TypeContrat;
DROP TABLE IF EXISTS TypeMateriel;
DROP TABLE IF EXISTS Agence;

CREATE TABLE Agence (
    NumAgence INT AUTO_INCREMENT PRIMARY KEY,
    NomAgence VARCHAR(100),
    AdresseAgence VARCHAR(255),
    TelAgence VARCHAR(20)
);

CREATE TABLE Client (
    NumClient INT AUTO_INCREMENT PRIMARY KEY,
    RaisonSociale VARCHAR(150),
    Siren VARCHAR(20),
    CodeApe VARCHAR(10),
    Adresse VARCHAR(255),
    TelClient VARCHAR(20),
    Email VARCHAR(150),
    DureeDeplacement INT,
    DistKm INT,
    NumAgence INT,
    FOREIGN KEY (NumAgence) REFERENCES Agence(NumAgence)
);

CREATE TABLE TypeMateriel (
    RefInter_TypeMateriel VARCHAR(10) PRIMARY KEY,
    LibelleTypeMateriel VARCHAR(100)
);

CREATE TABLE TypeContrat (
    RefTypeContrat VARCHAR(10) PRIMARY KEY,
    DetailIntervention DATE,
    TauxApplicable INT
);

CREATE TABLE ContratMaintenance (
    NumContrat INT AUTO_INCREMENT PRIMARY KEY,
    DateSignature DATE,
    DateEcheance DATE,
    RefTypeContrat VARCHAR(10),
    NumClient INT,
    FOREIGN KEY (NumClient) REFERENCES Client(NumClient),
    FOREIGN KEY (RefTypeContrat) REFERENCES TypeContrat(RefTypeContrat)
);

CREATE TABLE Materiel (
    NumSerie INT AUTO_INCREMENT PRIMARY KEY,
    DateVente DATE,
    DateInstallation DATE,
    PrixVente DECIMAL(10,2),
    Emplacement VARCHAR(100),
    RefInter_TypeMateriel VARCHAR(10),
    NumContrat INT NULL,
    FOREIGN KEY (RefInter_TypeMateriel) REFERENCES TypeMateriel(RefInter_TypeMateriel),
    FOREIGN KEY (NumContrat) REFERENCES ContratMaintenance(NumContrat)
);

CREATE TABLE Technicien (
    TelMobile_Technicien INT PRIMARY KEY,
    Qualification_Technicien VARCHAR(100),
    DateObtention_Technicien DATE
);

CREATE TABLE Employe_ (
    Matricule_Employe VARCHAR(20) PRIMARY KEY,
    NomEmploye_Employe VARCHAR(100),
    PrenomEmploye_Employe VARCHAR(100),
    AdresseEmploye_Employe VARCHAR(255),
    DateEmbauche_Employe DATE
);

CREATE TABLE Intervention (
    NumIntervention INT AUTO_INCREMENT PRIMARY KEY,
    DateVisite DATE,
    HeureVisite TIME,
    NumClient INT,
    TelMobile_Technicien INT,
    FOREIGN KEY (NumClient) REFERENCES Client(NumClient),
    FOREIGN KEY (TelMobile_Technicien) REFERENCES Technicien(TelMobile_Technicien)
);

CREATE TABLE Controler (
    NumSerie INT,
    NumIntervention INT,
    Temps_Passe INT,
    Commentaire VARCHAR(255),
    PRIMARY KEY (NumSerie, NumIntervention),
    FOREIGN KEY (NumSerie) REFERENCES Materiel(NumSerie),
    FOREIGN KEY (NumIntervention) REFERENCES Intervention(NumIntervention)
);

CREATE TABLE Travailler (
    TelMobile_Technicien INT,
    NumAgence INT,
    PRIMARY KEY (TelMobile_Technicien, NumAgence),
    FOREIGN KEY (TelMobile_Technicien) REFERENCES Technicien(TelMobile_Technicien),
    FOREIGN KEY (NumAgence) REFERENCES Agence(NumAgence)
);

CREATE TABLE Posseder (
    NumSerie INT,
    NumClient INT,
    PRIMARY KEY (NumSerie, NumClient),
    FOREIGN KEY (NumSerie) REFERENCES Materiel(NumSerie),
    FOREIGN KEY (NumClient) REFERENCES Client(NumClient)
);


INSERT INTO Agence (NomAgence, AdresseAgence, TelAgence) VALUES
('Agence Nord', '12 rue du Lac, Lille', '0320123040'),
('Agence Sud', '89 avenue Europa, Lyon', '0478124512');

INSERT INTO Client (RaisonSociale, Siren, CodeApe, Adresse, TelClient, Email, DureeDeplacement, DistKm, NumAgence) VALUES
('TechCorp', '552882100', '6201Z', '45 rue Nationale, Lille', '0320458877', 'contact@techcorp.fr', 30, 15, 1),
('BioFarm', '882190777', '0101Z', 'ZAC du Soleil, Lyon', '0478695544', 'info@biofarm.fr', 45, 28, 2);

INSERT INTO TypeMateriel VALUES
('TM01', 'Photocopieur'),
('TM02', 'Imprimante Laser');

INSERT INTO TypeContrat VALUES
('TC01', '2025-01-01', 20),
('TC02', '2025-02-01', 30);

INSERT INTO ContratMaintenance (DateSignature, DateEcheance, RefTypeContrat, NumClient) VALUES
('2025-01-05', '2026-01-05', 'TC01', 1),
('2025-03-10', '2026-03-10', 'TC02', 2);

INSERT INTO Materiel (DateVente, DateInstallation, PrixVente, Emplacement, RefInter_TypeMateriel, NumContrat) VALUES
('2024-05-01', '2024-05-05', 1500.00, 'Bureau 1', 'TM01', 1),
('2024-06-12', '2024-06-15', 2300.00, 'Atelier', 'TM02', 2);

INSERT INTO Technicien VALUES
(0678123401, 'Expert réseau', '2020-04-01'),
(0678569033, 'Électricien', '2019-06-15');

INSERT INTO Travailler VALUES
(0678123401, 1),
(0678569033, 2);

INSERT INTO Intervention (DateVisite, HeureVisite, NumClient, TelMobile_Technicien) VALUES
('2025-10-05', '09:30:00', 1, 0678123401),
('2025-10-10', '14:00:00', 2, 0678569033);

INSERT INTO Controler VALUES
(1, 1, 45, 'RAS'),
(2, 2, 60, 'Nettoyage nécessaire');

INSERT INTO Posseder VALUES
(1, 1),
(2, 2);
``
