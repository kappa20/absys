create database if not exists absys;
use absys;
create table filiere(
	code_fil INT PRIMARY KEY auto_increment NOT NULL,
    nom_fil varchar(120) not null
);
create table stagiaire(
	id_st INT PRIMARY KEY auto_increment NOT NULL,
    nom_st varchar(100) NOT NULL,
    prenom_st varchar(100) NOT NULL,
    code_fil INT NOT NULL,
    heure_absence_st int unsigned ,
    numero_parents varchar(50) NOT NULL,
    FOREIGN KEY (code_fil) REFERENCES filiere(code_fil)
    );

create table users(
	id_us INT PRIMARY KEY auto_increment NOT NULL,
    nom_us varchar(100) NOT NULL,
    prenom_us varchar(100) NOT NULL,
    cin_us varchar(50) NOT NULL,
    email_us varchar(255) NOT NULL,
    pwd_us varchar(255) NOT NULL,
    role_us varchar(100) NOT NULL
    
);

create table etat_absence(
	id_abs INT PRIMARY KEY auto_increment NOT NULL,
    id_st INT NOT NULL,
    date_abs date NOT NULL,
    heure_debut_abs time not null,
    heure_fin_abs time not null,
	date_limit_justif date NOT NULL,
    etat_justif varchar(100) not null,
    message_state bool default false,
    FOREIGN KEY (id_st) REFERENCES stagiaire(id_st)
);



