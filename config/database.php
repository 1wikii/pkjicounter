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
   private $durasi;
   private $sm;
   private $mp;
   private $ks;
   private $bb;
   private $tb;


   /*------------CONSTRUCTOR----------------*/
   public function __construct($interval, $durasi, $sm, $mp, $ks, $bb, $tb)
   {

      $this->interval = $interval;
      $this->durasi = $durasi;
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

         $query = "INSERT INTO " . $this->getTableName() . " (`interval`, durasi, SM, MP, KS, BB, TB)
                  VALUES (:interval, :durasi, :SM, :MP, :KS, :BB, :TB)";

         // preparing query
         $stmt = $this->DB->prepare($query);    // to helps prevent SQL injection attacks by parameterizing the query
         $stmt->bindParam(":interval", $this->interval);
         $stmt->bindParam(":durasi", $this->durasi);
         $stmt->bindParam(":SM", $this->sm);
         $stmt->bindParam(":MP", $this->mp);
         $stmt->bindParam(":KS", $this->ks);
         $stmt->bindParam(":BB", $this->bb);
         $stmt->bindParam(":TB", $this->tb);

         // executing query
         $stmt->execute();
      } catch (PDOException $e) {

         die("ERRORRRR DATABASEE : " . $e->getMessage());
      }
   }
}

// $user = new DATA('interval', 'durasi', 'kode', 'kode', 'kode', 'kode', 'kode');
// $user->simpanData();
