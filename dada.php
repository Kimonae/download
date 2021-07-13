
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Nimportekwa</title>
</head>
<body class="bg-dark text-white">
    



<?php
set_time_limit(99999);//limite temps de chargement page php 

if(isset($_GET['url'])){
    $url = $_GET['url'];

    $basedir = "/" . $_GET['Dossier'] . "/";

    mkdir($basedir, 0777);
    for ($i = $_GET['start_chap']; $i <= $_GET['end_chap']; $i++) {
        $html  = "<a class='suivant' href='" . $basedir . ($i+1) . "/" . $_GET['Dossier'] . ".html'>Suivant</a>";//   /Juju/1/Juju.html
        if($i != 0) //si y a un précedent chapitre
            $html  = "<a class='previous' href='" . $basedir . ($i+1) . "/" . $_GET['Dossier'] . ".html'>Suivant</a>";//   /Juju/1/Juju.html
        mkdir($basedir . $i, 0777);
        for ($j = 0; $j <= $_GET['end_page']; $j++) {
        $fullurl = $url. $i . $_GET['Operator'] . $j . $_GET['extension'];
        echo $fullurl . "<br>";
        $img = $basedir . $i . "/" .$j . $_GET['extension'];//$_GET["extension"]
        file_put_contents($img, file_get_contents($fullurl));

    }
    $files = scandir($basedir . $i);

sort($files, SORT_NUMERIC);
foreach  ($files as $f) {
   if($f != "." && $f != ".."){
    if (preg_match('/\b'. $_GET['extension'].'\b/', $f)) {//$_GET["extension"]
       if('' == file_get_contents( $basedir . $i . $f))
            $html .= "<img class='page' src='" . $f . "'>";
       }
   }
} 
$html .= "<style> body{
    background: black;
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 50%;
} </style>";
$lapage = fopen($basedir . $i . "/" . $_GET["Dossier"] . ".html", "w") or die("Unable to open file!");
fwrite($lapage, $html);
fclose($lapage);
}


    echo "</pre>";
    echo "<a class='btn btn-primary' href ='dada.php'> Retour </a>";
}else {
  

    ?>
<form class="form-group" action="#" method="get">
    <input type="text" class= "form-control bg-dark text-white"" name = 'url' style="width:750px;" placeholder='https://scansmangas.xyz/scans/juujika-no-rokunin/'> <br>
    <input type="text" class= "form-control bg-dark text-white"" name = 'Dossier' style="width:350px;" placeholder='Jujutsu_Kaisen'> <br>
    <div class="fo"> 
   <br> Chap deb <input type="number" class= "form-control bg-dark text-white"" name='start_chap' style="width:6em;" value='0'> <br>
    Chap fin <input type="number" class= "form-control bg-dark text-white"" name ='end_chap' style="width:6em;" value='100'><br>
    Page fin <input type="number" class= "form-control bg-dark text-white"" name ='end_page' style="width:6em;" value='100'><br>
    </div>
    <div class="fa"> 
   Separateur chap page <input type="text" class= "form-control bg-dark text-white"" name = 'Operator' style="width:3em;" placeholder='/' value="/"> <br>
   Ext <input type="text" class= "form-control bg-dark text-white"" name = 'extension' style="width:8em;" placeholder='.jpg' value=".jpg"> <br>
   </div>

    <input class="btn btn-primary" type="submit" value="Envoyer">

</form>

<?php 
}

?>



<img id = "img1" src = "12.jpg"></img>
</body>
</html>