<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tpMessi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<center>
    <h1>
        PAGINATION SYSTEME
    </h1>
</center>
            <?php
            //connectio to the data base
                $bdd = new PDO('mysql:host=localhost;dbname=roster','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
                //preparation fo the requet to count the number of ellement that are going to be select
                $sql2 = "SELECT count(user_id) as cpt  FROM User";
                $count = $bdd->prepare($sql2);
                $count->setFetchMode(PDO::FETCH_ASSOC);
                //execution of the request
                $count->execute();
                $nombreElement = $count->fetchAll();
                //dclaration of the number of elements that are going to be print peer page
                $nbrElementParParge = 6;
                //recuparation of the current page
                @$page = $_GET['page'];
                if(empty($page)){
                    $page = 1;
                }
                //calculation of the number of page that will be nessasary to print all elment
                $nbPage = ceil($nombreElement[0]["cpt"]/$nbrElementParParge);
                //rediretion into first page if get page is not possible
                if ($page>$nbPage) {
                    header("location: ./");
                }

                //declaration of the the nuber where we will start to print thing
                $debu = ($page-1)*6;
                 //recuparation of data into database               
                $requete = $bdd->prepare("SELECT user_id FROM User limit $debu,$nbrElementParParge");
                $requete->setFetchMode(PDO::FETCH_ASSOC);
                $requete->execute();
                $tab = $requete->fetchAll();


               

            ?>
    <center>
        <h1>
            <?php
        for ($i=0; $i < count($tab);$i++) { 
             echo"id N:".$tab[$i]['user_id']."<br>"; 
            }
            ?>
        </h1> 
    </center>

    <p>
        <div class="footer">
<center>
<?php
        for ($i=0; $i < $nbPage;$i++) { 
            
            
            ?>
            <a href="index.php?page=<?php echo$i+1; ?>"><?php echo$i+1; ?></a>
            <?php
        }
       

?>
</center>
        </div>
    </p>
</body>
</html>