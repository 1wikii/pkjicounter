<?php
class DATABASE
{

   private $host = 'localhost';
   private $DB_name = 'traffic_data';
   private $table_name = 'traffic_data';
   private $DB_username = 'root';
   private $DB_password = '';
   public $DB;

   public function getConnection()
   {
      $this->DB = null;

      try {
         $this->DB = new PDO("mysql:host=$this->host; dbname=$this->DB_name", $this->DB_username, $this->DB_password);
         $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $this->DB->exec("set names utf8");     // utf8 to handle unicode characters

      } catch (PDOException $exception) {
         echo "Connection Error : " . $exception->getMessage();
      }
   }

   public function getHostName()
   {
      return $this->host;
   }

   public function getDBName()
   {
      return $this->DB_name;
   }

   public function getTableName()
   {
      return $this->table_name;
   }

   public function getUsername()
   {
      return $this->DB_username;
   }

   public function getPassword()
   {
      return $this->DB_password;
   }
}



//------------------------------- logika ----------------------------------//
class USER extends DATABASE
{

   // User Attribute
   private $username;
   private $password;
   private $notHashedPassword;
   private $date;
   protected $email;

   // state process
   private $isAccountAlreadyExist;
   private $isUsernameExist;
   private $successCreatingAccount;

   // verification variable
   private $user;
   private $verificationStatus;

   /*------------CONSTRUCTOR----------------*/
   public function __construct($username, $password, $email = null)
   {
      $this->username = $username;
      // $this->password = $this->hashingPassword($password);
      $this->notHashedPassword = $password;
      $this->email = $email;
      // $this->date = $this->getDateTime();

      $this->isAccountAlreadyExist = false;
      $this->isUsernameExist = false;
      $this->successCreatingAccount = false;

      $this->getConnection();
   }
}
