<?php
/**
 * @authtor T10 <teddy.developper@gmail.com>
 */
 
$txtIntro = "Bonjour à tous,\n\r
Les polosaures ont besoin de nous !\nAfin d'éviter une catastrophe imminente, aidez les à se mettre à l'abri.\nPour cela, testez le simulateur qui permettra de déterminer la surface total protégé par les montagnes !\nAttention la prophétie annonce une hauteur aléatoire du relief montagneux.\n\r"; 
fwrite(STDOUT, $txtIntro); 

$width = 0;
$heightStr = '';

$step1IsOk = false;
fwrite(STDOUT, "1/ Tu dois saisir un entier entre 1 et 100 000 qui représentera la surface de terrain : \n");

while(!$step1IsOk) {
    $width = intval(fgets(STDIN));
    if (!$width){
        fwrite(STDERR, "Sorry! mais je n'ai pas compris, please essaye avec un entier entre 1 et 100 000 !\n");  
        continue;
    }
    if ($width < 1 || $width > 100000) {
        fwrite(STDERR, "Sorry! mais tu dois absolument saisir un entier entre 1 et 100 000!\n");
        continue;
    }
    
    $step1IsOk = true;
    break;
}

fwrite(STDOUT, "\n");
fwrite(STDOUT, "2/ Super ! Maintenant tu dois saisir une liste de hauteur de surface entre 0 et 100 000 séparé par des espaces afin de déterminer les altitudes qui permettront de mettre à l'abris nos pauvres polosaures\nvoici un exemple pour toi : 10 50 48 56000 ...etc à toi de jouer!\n");
$listH = [];
$step2IsOk = false;
while (!$step2IsOk) {
    $line = trim(fgets(STDIN));
    
    if (!$line){
        fwrite(STDERR, "Sorry! mais je n'ai pas compris, please essaye avec des entiers compris entre 0 et 100 000 séparé par des espaces!\n");
        continue;
    }
    
    $pattern = "#^[0-9 ]+$#";
    if (!preg_match($pattern, $line)) {
        fwrite(STDERR, "Sorry! mais il faut absolument saisir des entiers séparés par des espaces !\n");
        continue;
    }
    
    $line = str_replace(' ', '-', $line);
    $tmp = explode('-', $line);
    $isError = false;
    foreach ($tmp as $val) {
        if( is_numeric(trim($val))) {
            $v = intval($val);
            if ($v < 0 || $v > 100000){
                $isError = true;
                break;
            }
            $listH[] = $v;
        }
    }
    
    if ($isError) {
        fwrite(STDERR, "Sorry! mais il faut  vraiment  saisir des entiers entre 0 et 100 000 !\n");
        continue;
    }
    
    $step2IsOk = true;
    break;
}
    
$countOut = 0;
$heightMain = rand(0, 100000);
foreach ($listH as $h) {
    if ($h < $heightMain)
    $countOut++;
}

fwrite(STDOUT, "Genial ! Voici le résultat pour une hauteur d 'un relief montagneux de $heightMain :\n$countOut\n\r");


