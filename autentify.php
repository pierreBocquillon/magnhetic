<?
session_start();
require_once 'connection.php';
function autentify($mail,$pass,$conn){
    $sql="SELECT 
            `id_user`,
            `email_user`,
            `password_user`,
            `first_connection`,
            `profil_id_user`
        FROM 
            `user` 
        WHERE 
        `email_user`=:email
	;";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':email', $mail);
    $stmt->execute();
    errorHandler($stmt);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
     //var_dump($row);

     if($pass == $row["password_user"]){
         $_SESSION['mail']=$mail;
         $_SESSION['pass']=$pass;
         $_SESSION['pid']=$row['profil_id_user'];
         if($row['first_connection']== "1"){

             header('location:../prive');
         }else{

             header('location:connected.php');
         }
     }else{
        session_unset();}
        header('location:../test');



}
autentify($_POST['conn_mail'],$_POST['conn_mdp'],$conn);