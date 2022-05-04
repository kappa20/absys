drop database absys;
create database absys;
use absys;
create table filiere(
	code_fil varchar(100) PRIMARY KEY,
    nom_fil varchar(120) not null
);
create table groupe(
	nom_gp varchar(255) primary key,
    code_fil varchar(255),
    foreign key(code_fil) references filiere(code_fil)
    
);
create table teachers(
	id_tch varchar(155) PRIMARY KEY NOT NULL,
    nom_tch varchar(155) NOT NULL
);
create table stagiaire(
	id_st varchar(100) PRIMARY KEY,
    nom_st varchar(100) NOT NULL,
    prenom_st varchar(100) NOT NULL,
    nom_gp varchar(255)  NOT NULL,
    heure_absence_st int unsigned default 0,
    numero_parents varchar(50) NOT NULL,
    FOREIGN KEY (nom_gp) REFERENCES groupe(nom_gp)
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
    id_st varchar(100),
    id_tch varchar(155) not null,
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
	nom_gp varchar(255),
    id_tch varchar(100),
    PRIMARY KEY (nom_gp,id_tch),
	FOREIGN KEY (nom_gp) REFERENCES groupe(nom_gp),
    FOREIGN KEY (id_tch) REFERENCES teachers(id_tch)
);

insert into users(nom_us,prenom_us,cin_us,email_us,pwd_us,role_us)
VALUES
	("Najil","Kamal","BE0","kamal.najil@ofppt.com","kamal10","teacher"),
	("Omar","Hajoui","BE1","omar.hajoui@ofppt.com","hajoui10","teacher"),
    ("Zakia","Tazi","Z01","zakia.tazi@ofppt.com","zakia10","superviser");