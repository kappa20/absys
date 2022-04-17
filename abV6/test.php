<?php
    $arrays =[1,2,3,5,6,8,7,54,59];
    $sql = "INSERT into etat_absence (id_st,date_abs,heure_debut_abs,heure_fin_abs,date_limit_justif,etat_justif)
    VALUES"; 
$len = count($arrays);

for($i = 0 ; $i < $len ; $i++){
    $elem = $arrays[$i];
    if($i === $len-1){
        $sql .= "($elem,CURDATE(),aa,aa,curdate()+2,'NJ');";
    }
    else{
        $sql .= "($elem,CURDATE(),aa,aa,curdate()+2,'NJ'),";
    }
}
echo $sql;
