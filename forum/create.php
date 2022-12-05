<?php

    require_once('index.php');

        class Users{

    public $email;
    public $pseudo;
    public $mdp;

        public function _construct($email , $pseudo , $mdp){
            $this-> $email = $email;
            $this-> $pseudo = $pseudo;
            $this-> $mdp = $mdp;
        } 
          public function connect(){
                if($this-> pseudo !== $this-> mdp){
                    echo 'le mdp ou le pseudo n"est pas correct veuillez reessayer ! ';
                }else{
                    echo'vous etes connecter';
                   return session_start();
               }
          }
     }
    $admin = new Users('admin' , 'mdp');
    $admin->connect();
?>