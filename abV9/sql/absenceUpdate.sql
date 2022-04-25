SELECT * FROM absys.stagiaire;
-- convert All the name to upper case
update stagiaire set prenom_st = UPPER(prenom_st),nom_st = UPPER(nom_st);

-- Update heure_absence_st
UPDATE  stagiaire set heure_absence_st = FLOOR(rand()*60);

UPDATE  stagiaire set heure_absence_st = (select SUM(hour(heure_fin_abs - heure_debut_abs)) as houro FROM etat_absence WHERE id_st = 20) where id_st = 20;
UPDATE  stagiaire set heure_absence_st = 0;

select SUM(hour(heure_fin_abs - heure_debut_abs)) as houro FROM etat_absence WHERE id_st = 20;
-- Get the absence of January
select SUM(hour(heure_fin_abs - heure_debut_abs)) as month_abs FROM etat_absence WHERE id_st = 20 AND etat_justif = "NJ" AND MONTH(date_abs) = 1 ;
-- Donner tous les stagiaire un nombre d heure exacte
UPDATE stagiaire set heure_absence_st = 10;

-- retourner les prof par filiere
SELECT nom_tch FROM teachers as T, filiere as F ,reltf as R 
where R.code_fil = F.code_fil 
and R.id_tch = T.id_tch and F.nom_fil = "DEV102";
