<?php
  function InitGame()
  {
    // Vérifier si les champs nom1 et nom2 ont été soumis dans la requête GET
  if (isset($_GET['nom1']) && isset($_GET['nom2']) && $_GET['nom1']!="" && $_GET['nom2']!=""||isset($_SESSION['joueur1'])&& isset($_SESSION['joueur2'])) 
  {
    // Récupérer les valeurs des champs nom1 et nom2
    if(!(isset($_SESSION['joueur1'])&& isset($_SESSION['joueur2'])))
    {
      $_SESSION['joueur1'] = $_GET['nom1'];
      $_SESSION['joueur2'] = $_GET['nom2'];
    }

    // Afficher les noms des joueurs
    if(isset($_GET['couleur1'])&&isset($_GET['couleur1'])&&$_GET['couleur1']!=$_GET['couleur2']||isset($_SESSION['couleur1'])&& isset($_SESSION['couleur2']))
    {
      
      if(!(isset($_SESSION['couleur1'])&& isset($_SESSION['couleur2'])))
    {
      $_SESSION['couleur1'] = $_GET['couleur1'];
      $_SESSION['couleur2'] = $_GET['couleur2'];
    }
    if(!(isset($_SESSION['ligne'])&& isset($_SESSION['colonne'])))
    {
      $ligne = $_GET['ligne'];
      $colonne = $_GET['colonne'];
      $_SESSION['ligne'] = $ligne;
      $_SESSION['colonne'] = $colonne;
    } 
    echo $_SESSION['joueur1']." a la couleur " . $_SESSION['couleur1']. "<br>";
    echo $_SESSION['joueur2']." a la couleur " . $_SESSION['couleur2']. "<br>";
    $vide=0;
    if(!isset($_SESSION['tab']))
    {
      for($l=0;$l<$_SESSION['ligne'];$l++)
      {
        for($c=0;$c<$_SESSION['colonne'];$c++)
        {
          $tab[$l][$c]=$vide;
        }
      }
      $_SESSION['tab']=$tab;
    }
    if(!(isset($_SESSION['tour'])))
    {
        if($_SESSION['couleur1']=="rouge")
        {
          $_SESSION['tour']="rouge";
        }
        else if($_SESSION['couleur1']=="jaune")
        {
          $_SESSION['tour']="jaune";
        }
    }
    clique_surcase();
    //change_tour(); 
    affiche_form();
    }
    else
    {
      echo " vous ne pouvez pas avoir la même couleur pour les 2 joueurs";
    }
  } 
  else 
  {
    // Si les champs nom1 et nom2 n'ont pas été soumis, afficher un message d'erreur
    echo "Veuillez saisir les noms des joueurs.";
  } 
}    
 function affiche_jeu()
 {
  global $vide;
  $tab=$_SESSION['tab'];
  for($l=0;$l<$_SESSION['ligne'];$l++)
  {
    //echo "<table>";
    for($c=0;$c<$_SESSION['colonne'];$c++)
    {
      if($tab[$l][$c]=="rouge"){echo "<button type='submit' name='im' value='$c' style = 'background-color:#0000FF;' > <img src='Red.png' width='70' height='70'> </button>";}
      if($tab[$l][$c]=="jaune"){echo "<button type='submit'name='im' value='$c' style = 'background-color:#0000FF;' ><img src='Yellow.png' width='70' height='70'> </button>";}
      if($tab[$l][$c]==$vide){echo "<button type='submit' name='im' value='$c' style = 'background-color:#0000FF;' > <img src='Empty.png' width='70' height='70'> </button>";}
    }
    echo "<br>";
    //echo "<table/>";
  }
 }
 function affiche_form()
 {
  global $vide;
  if(youWin()=="rouge")
  {
    echo "<!DOCTYPE html>
  <html>
  <head>
    <meta charset='UTF-8'>
    <title>Puissance 4</title>
  </head>
  <body>
  <center>
    <h1>Les rouges ont gagné</h1>
    </center>
     <form action='index.php'>
     <input type='submit' value='Quitter' width='70' height='70' />
     <br>
     </form>";
     if($_SESSION['couleur1']=="rouge")
      {
        $_SESSION['statut1']="gagnant";
        $_SESSION['statut2']="perdant";
      }
      if($_SESSION['couleur2']=="rouge")
      {
        $_SESSION['statut2']="gagnant";
        $_SESSION['statut1']="perdant";
      }  

  }
 else if(youWin()=="jaune")
  {
    echo "<!DOCTYPE html>
  <html>
  <head>
    <meta charset='UTF-8'>
    <title>Puissance 4</title>
  </head>
  <body>
  <center>
    <h1>Les jaunes ont gagné</h1>
    </center>
     <form action='index.php'>
     <input type='submit' value='Quitter' width='70' height='70' />
     <br>
     </form>";
     if($_SESSION['couleur1']=="jaune")
      {
        $_SESSION['statut1']="gagnant";
        $_SESSION['statut2']="perdant";
      }
      if($_SESSION['couleur2']=="jaune")
      {
        $_SESSION['statut2']="gagnant";
        $_SESSION['statut1']="perdant";
      }

  }
  else if(tab_est_rempli()==true)
  {
    echo "<!DOCTYPE html>
  <html>
  <head>
    <meta charset='UTF-8'>
    <title>Puissance 4</title>
  </head>
  <body>
  <center>
    <h1>Match nul</h1>
    </center>
     <form action='index.php'>
     <input type='submit' value='Quitter' width='70' height='70' />
     <br>
     </form>";
     $_SESSION['statut1']="egalite";
     $_SESSION['statut2']="egalite";
  }
  else
  {
    change_tour();
    echo "<!DOCTYPE html>
  <html>
  <head>
    <meta charset='UTF-8'>
    <title>Puissance 4</title>
  </head>
  <body>
  <div style ='display:flex; justify-content:center;'>
   <form method='get'action='main.php' style = 'background-color:#0000FF;' >";
     affiche_jeu();
     echo"</form>
     </div>
     <br>
     ";
     echo"<form action='index.php'>
     <input type='submit' value='Quitter' width='70' height='70' />
     <br>
     </form>
     
     ";
     
  }
 }

  function clique_surcase()
  { 
    $tab=$_SESSION['tab'];
    if(isset($_GET['im']))
      {
          $i=$_SESSION['ligne']-1;
          while($i>0 && $tab[$i][$_GET['im']]!=0 )
          {  
            $i=$i-1;
          } 
          if($tab[$i][$_GET['im']]==0)
            {
              $tab[$i][$_GET['im']]=$_SESSION['tour'];//val a changer
              $_SESSION['tab']=$tab;
            } 
      }
    
  }

  function change_tour()
  {
    global $vide;
    if($_SESSION['tour']=="rouge")
    {
      $_SESSION['tour']="jaune";
      echo " <center>
      <h1>C'est au tour des jaunes</h1>
      </center>";
          
    }
    else if($_SESSION['tour']=="jaune")
    {
      $_SESSION['tour']="rouge";
      echo " <center>
      <h1>C'est au tour des rouges</h1>
      </center>";
    }       
  }

function youWin() 
{
  $tab=$_SESSION['tab'];
  global $vide;
  $couleur=$vide;
    for($i=0; $i<count($tab); $i++)
    {
        for($j=0; $j<count($tab[0]); $j++)
        {
            if($tab[$i][$j]!=$vide)
            {
                if($j<=count($tab[0])-4)
                {
                    if  ($tab[$i][$j]==$tab[$i][$j+1] && $tab[$i][$j]==$tab[$i][$j+2] && $tab[$i][$j]==$tab[$i][$j+3])
                        $couleur=$tab[$i][$j];

                }

                if($i<=count($tab)-4)
                {
                    if  ($tab[$i][$j]==$tab[$i+1][$j] && $tab[$i][$j]==$tab[$i+2][$j] && $tab[$i][$j]==$tab[$i+3][$j])
                        $couleur=$tab[$i][$j];
                }

                if($i<=count($tab)-4 && $j<=count($tab[0])-4)
                {
                    if  ($tab[$i][$j]==$tab[$i+1][$j+1] && $tab[$i][$j]==$tab[$i+2][$j+2] && $tab[$i][$j]==$tab[$i+3][$j+3])
                        $couleur=$tab[$i][$j];
                }

                if($i>=3 && $j<=count($tab[0])-4)
                {
                    if  ($tab[$i][$j]==$tab[$i-1][$j+1] && $tab[$i][$j]==$tab[$i-2][$j+2] && $tab[$i][$j]==$tab[$i-3][$j+3])
                        $couleur=$tab[$i][$j];
                }  
            }
        }
    }
    return $couleur;
}

function tab_est_rempli()
{
  $tab=$_SESSION['tab'];
  global $vide;
  for($l=0;$l<$_SESSION['ligne'];$l++)
      {
        for($c=0;$c<$_SESSION['colonne'];$c++)
        {
          if($tab[$l][$c]==$vide)
          {
            return false;
          }
        }
      }
  return true;
}


function lire_tab() 
{
  $tab=$_SESSION['tab'];
  global $vide;
  $chaine = "";
  foreach ($tab as $ligne) 
  {
      foreach ($ligne as $element) 
      {
        if($element==$vide)
          {
            $chaine .= "vide";
          }
          else
          {
            $chaine .= $element;
          }  
      }
      $chaine .= " /";
  }
  return $chaine;
}

?>

