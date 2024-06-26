<?php
    session_start(); // Start the session
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    session_start();
    
?>






    <!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
  <title>Puissance 4</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 652px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input[type="text"]{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}

input[type="number"]
{
  color: #000000 !important;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

.flex
{
  display:flex;
}

    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="get" action="main.php">
        <h3>Inscris toi</h3>

        <label for="nom1">Nom du joueur1 :</label>
      <input type="text"  placeholder = "Joueur1" name="nom1" value="<?php echo isset($_GET['nom1']) ? $_GET['nom1'] : ''; ?>"/>
    
      <div class= "flex"> 
     <div> 
      <label for="couleur1">
      <input type="radio" name="couleur1" value="rouge" checked="true">rouge
      </label>
    </div>
    <div>
      <label label for="couleur1">
      <input type="radio" name="couleur1" value="jaune">jaune
      </label>
    </div>
    </div>

      <label for="nom2">Nom du joueur2 :</label>
      <input type="text" placeholder = "Joueur2" name="nom2" value="<?php echo isset($_GET['nom2']) ? $_GET['nom2'] : ''; ?>"  />
      <div class = "flex">
      <label for="couleur2">
      <input type="radio" name="couleur2" value="rouge" >rouge
      </label>
      <label label for="couleur2">
      <input type="radio" name="couleur2" value="jaune"checked>jaune
      </label>
</div>


      <label for='iStart'>Entrer le nombre de ligne et de colonne : </label>
      <input name='ligne'  type='number' 		min='6' value='<?php echo isset($_GET['ligne']) ? $_GET['ligne'] : 6; ?>'/>
		  <input name='colonne' 	 type='number'  min="7" value='<?php echo isset($_GET['colonne']) ? $_GET['colonne'] : 7; ?>'/>

        <button> Jouer</button>
        
    </form> 

</body>
</html>
