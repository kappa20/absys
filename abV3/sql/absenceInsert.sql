-- Insertion des admins qui penveunt valider les absences

insert into users(nom_us,prenom_us,cin_us,email_us,pwd_us,role_us)
VALUES
	("Najil","Kamal","BE0","kamal.najil@ofppt.com","kamal10","teacher"),
	("Omar","Hajoui","BE1","omar.hajoui@ofppt.com","hajoui10","teacher"),
    ("Zakia","Tazi","Z01","zakia.tazi@ofppt.com","zakia10","superviser");

-- insertion des filieres
insert into filiere(nom_fil) 
VALUES	
	("DEV101"),
	("DEV102"),
    ("TDI201"),
    ("TDI202");
    
-- insertion des stagiaires 
insert into stagiaire (nom_st,prenom_st,code_fil,heure_absence_st,numero_parents)
VALUES
	("AARAB","OUSSAMA","2",0,"0693322251"),
    ("FATIH","YOUSSEF","2",0,"0622039291"),
    ("ZAAZOUI","ACHRAF","2",0,"0659223613"),
    ("HIMLI","YAHYA","2",0,"0707656096"),
    ("DARDORY","YASSINE","2",0,"0632935092"),
    ("BOUMEDIANE","AHMED","2",0,"0668542117"),
    ("JAMAOUI","YAHYA","2",0,"0668542117"),
    ("YOULYOUZ","YASSINE","2",0,"0668542117"),
    ("LAOUD","MOHAMED","2",0,"0668542117"),
    ("DHAIMI","WALID","2",0,"0668542117"),
    ("ERRAOUI","OUSSAMA","2",0,"0668542117"),
    ("BABA","ZAKARIYAE","2",0,"0668542117"),
    ("MERYAH","WISSAL","2",0,"0668542117"),
    ("KORCHI","ABDELAZIZ","2",0,"0668542117"),
    ("ELMOUZANI","AYOUB","2",0,"0668542117"),
    ("BENNANI","AYOUB","2",0,"0668542117"),
    ("AASSAB","HATIM","2",0,"0668542117"),
    ("LAOUD","MOHAMED","2",0,"0668542117"),
    ('ASSIM', 'ABDELHAKIM', 2, 0, '+212761870836'),
    ("test","student","2",0,"+212612827818");
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Armand', 'Smoote', 1, 0, '4743082432');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Cathleen', 'Di Bartolommeo', 1, 0, '1385275689');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Clovis', 'Rontree', 1, 0, '6995561275');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Jade', 'Fidock', 1, 0, '5495923997');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Allyce', 'Artin', 1, 0, '5446225515');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Cam', 'Honnan', 1, 0, '5113146591');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Gradeigh', 'Winear', 1, 0, '1291622704');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Carlee', 'Maryon', 1, 0, '1445454070');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Addy', 'Mordey', 1, 0, '3122849915');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Corrie', 'Drummond', 1, 0, '1102901445');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Carmelle', 'Berry', 1, 0, '5645031686');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Nessa', 'Pucker', 1, 0, '5547305595');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Cesar', 'Peer', 1, 0, '2168611215');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Joelynn', 'Scales', 1, 0, '4459335440');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Lotti', 'Gallier', 1, 0, '4794196937');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Ric', 'Lorrie', 1, 0, '1294944930');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Bryanty', 'Le Lievre', 1, 0, '4947361023');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Ashely', 'Purselowe', 1, 0, '3177623228');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Wain', 'Siddell', 1, 0, '4836290267');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Elfrida', 'Bauser', 1, 0, '6946854352');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Deana', 'Shannahan', 1, 0, '1093184176');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Eddie', 'Randles', 1, 0, '2846613586');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Karl', 'Blakelock', 1, 0, '5899226847');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Michele', 'Chilvers', 1, 0, '8698934249');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Charlton', 'Grebbin', 1, 0, '2363482625');

insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Royal', 'MacNeil', 3, 0, '4299382778');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Jakie', 'Heymes', 3, 0, '2195520512');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Brittni', 'Mearns', 3, 0, '6108979976');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Christabel', 'Deverick', 3, 0, '9887662928');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Rianon', 'Cone', 3, 0, '3843523643');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Eimile', 'Muzzini', 3, 0, '4865957251');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Max', 'Theodore', 3, 0, '4037751650');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Earl', 'Gonsalvo', 3, 0, '3613672706');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Zola', 'Duly', 3, 0, '1894243702');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Leola', 'Lapworth', 3, 0, '9575937204');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Karrie', 'Serjent', 3, 0, '6568601341');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Ivie', 'Franzel', 3, 0, '1472481894');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Elnora', 'Vail', 3, 0, '4589370024');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Sal', 'Carlesi', 3, 0, '6476241437');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Dene', 'Barwis', 3, 0, '8077491439');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Connor', 'Bachshell', 3, 0, '5128678503');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Antony', 'Mulvihill', 3, 0, '8838295310');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Jermain', 'Springford', 3, 0, '5442993889');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Lisbeth', 'Hounsom', 3, 0, '2347806991');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Leisha', 'Ould', 3, 0, '2147727261');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Robinson', 'Tomek', 3, 0, '9936137599');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Mort', 'McKearnen', 3, 0, '8567769669');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Richardo', 'Kynston', 3, 0, '6908944708');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Davide', 'Gheorghescu', 3, 0, '2114890438');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Maurizio', 'Steckings', 3, 0, '7287070240');

insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Eduino', 'Erni', 4, 0, '8457793006');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Goddart', 'Anstiss', 4, 0, '7977743717');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Celina', 'Reily', 4, 0, '8137522727');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Damaris', 'Benedek', 4, 0, '1523498295');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Jeramie', 'Thecham', 4, 0, '9627319005');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Laurianne', 'Whodcoat', 4, 0, '9766597330');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Frederik', 'Smithen', 4, 0, '6425116462');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Garrik', 'Zorzoni', 4, 0, '1103677339');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Neils', 'Reinhart', 4, 0, '4973867665');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Larina', 'Boyer', 4, 0, '3529071237');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Selig', 'Kitteman', 4, 0, '7137762705');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Humbert', 'Verner', 4, 0, '2697988577');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Tabbie', 'Lates', 4, 0, '1748301875');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Stanislaus', 'Hodgin', 4, 0, '4667637454');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Olly', 'Kyle', 4, 0, '5741438779');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Ricki', 'Callan', 4, 0, '5616708509');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Zackariah', 'Ranklin', 4, 0, '7041169080');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Nessi', 'Chavrin', 4, 0, '5681852492');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Madelena', 'Butterfill', 4, 0, '6323028805');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Ava', 'Connachan', 4, 0, '5077769537');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Maighdiln', 'Epsly', 4, 0, '2092640945');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Ellsworth', 'Duerdin', 4, 0, '6133287564');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Beatrice', 'Chezier', 4, 0, '1357717054');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Bryna', 'Fayre', 4, 0, '2821233763');
insert into stagiaire (nom_st, prenom_st, code_fil, heure_absence_st, numero_parents) values ('Merrel', 'Whettleton', 4, 0, '7029026987');

-- insert etat absence
insert into etat_absence (id_st,date_abs,heure_debut_abs,heure_fin_abs,date_limit_justif,etat_justif)
VALUES 
	(1,CURDATE(),"08:30:00","13:30:00",curdate()+2,"NYJ");
    