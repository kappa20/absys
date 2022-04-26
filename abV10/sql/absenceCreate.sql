create database if not exists absys;
use absys;
create table filiere(
	code_fil INT PRIMARY KEY auto_increment NOT NULL,
    nom_fil varchar(120) not null
);
create table teachers(
	id_tch int PRIMARY KEY auto_increment NOT NULL,
    nom_tch varchar(155) NOT NULL,
    prenom_tch varchar(155) NOT NULL
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
    id_tch INT NOT NULL,
    date_abs date NOT NULL,
    heure_debut_abs time not null,
    heure_fin_abs time not null,
    seance varchar(100) not null,
    etat_justif varchar(100) default 'NJ',
    Motif varchar(255) default 'Pas de motif',
    FOREIGN KEY (id_st) REFERENCES stagiaire(id_st),
    FOREIGN KEY (id_tch) REFERENCES teachers(id_tch)
);
create table reltf(
	code_fil INT NOT NULL,
    id_tch INT NOT NULL,
    PRIMARY KEY (code_fil,id_tch),
	FOREIGN KEY (code_fil) REFERENCES filiere(code_fil),
    FOREIGN KEY (id_tch) REFERENCES teachers(id_tch)
);
/*drop database absys;*/