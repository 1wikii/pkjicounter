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
class DATA extends DATABASE
{

   // User Attribute
   private $interval;
   private $sm;
   private $mp;
   private $ks;
   private $bb;
   private $tb;


   /*------------CONSTRUCTOR----------------*/
   public function __construct($interval, $sm, $mp, $ks, $bb, $tb)
   {

      $this->interval = $interval;
      $this->sm = $sm;
      $this->mp = $mp;
      $this->ks = $ks;
      $this->bb = $bb;
      $this->tb = $tb;


      $this->getConnection();
   }

   function simpanData()
   {
      try {

         $query = "INSERT INTO " . $this->getTableName() . " (interval, sm, mp, ks, bb, tb)
                  VALUES ( :interval, :sm, :mp, :ks, :bb, :tb)";

         // preparing query
         $stmt = $this->DB->prepare($query);    // to helps prevent SQL injection attacks by parameterizing the query
         $stmt->bindParam(":interval", $this->interval);
         $stmt->bindParam(":sm", $this->sm);
         $stmt->bindParam(":mp", $this->mp);
         $stmt->bindParam(":ks", $this->ks);
         $stmt->bindParam(":bb", $this->bb);
         $stmt->bindParam(":tb", $this->tb);

         // executing query
         $stmt->execute();
      } catch (PDOException $e) {

         die("ERRORRRR DATABASEE : " . $e->getMessage());
      }
   }
}
