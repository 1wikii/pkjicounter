<?php

require('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class DATABASE
{

   private $host = 'localhost';
   private $DB_name = 'pkjicounter';
   private $table_name = 'data';
   private $DB_username = 'root';
   private $DB_password = '';
   public $DB;

   // Password admin
   private $all_users_password = 'admin';

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

   public function getAllUsersPassword()
   {
      return $this->all_users_password;
   }
}



//------------------------------- logika ----------------------------------//
class DATA extends DATABASE
{

   // User Attribute
   private $surveyor;
   private $interval;
   private $durasi;
   private $sm;
   private $mp;
   private $ks;
   private $bb;
   private $tb;


   /*------------CONSTRUCTOR----------------*/
   public function __construct($surveyor = null, $interval = null, $durasi = null, $sm = null, $mp = null, $ks = null, $bb = null, $tb = null)
   {
      $this->surveyor = $surveyor;
      $this->interval = $interval;
      $this->durasi = $durasi;
      $this->sm = $sm;
      $this->mp = $mp;
      $this->ks = $ks;
      $this->bb = $bb;
      $this->tb = $tb;


      $this->getConnection();
   }

   function closeConnections()
   {
      $this->DB->close();
   }

   function simpanData()
   {
      try {

         $query = "INSERT INTO " . $this->getTableName() . " (`surveyor`,`interval`, durasi, SM, MP, KS, BB, TB)
                  VALUES (:surveyor, :interval, :durasi, :SM, :MP, :KS, :BB, :TB)";

         // preparing query
         $stmt = $this->DB->prepare($query);    // to helps prevent SQL injection attacks by parameterizing the query
         $stmt->bindParam(":surveyor", $this->surveyor);
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

         die($e->getMessage());
      }
   }


   function exportDataToSpreadsheet()
   {

      // Query untuk mengambil data dari database
      $query = "SELECT `surveyor`,`interval`, `durasi`, `SM`, `MP`, `KS`, `BB`, `TB` FROM " . $this->getTableName();
      $statement = $this->DB->prepare($query);
      $statement->execute();

      // Mengambil hasil query sebagai array asosiatif
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);

      // Membuat objek Spreadsheet
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Menulis kolom pada xlsx
      $sheetColumns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
      $databaseColums = ['surveyor', 'Interval', 'Durasi', 'SM', 'MP', 'KS', 'BB', 'TB'];

      $colIdx = 0;
      foreach ($sheetColumns as $col) {
         $sheet->getCell($col . '1')->setValue($databaseColums[$colIdx]);

         $colIdx++;
      }

      // cek row data tidak kosong dari database
      if ($result) {
         // menuliskan row data ke xlsx
         $rowIdx = 2;
         foreach ($result as $row) {
            $rowColIdx = 0;
            foreach ($row as $data) {
               $sheet->getCell($sheetColumns[$rowColIdx] . strval($rowIdx))->setValue($data);

               $rowColIdx++;
            }
            $rowIdx++;
         }
      }

      // Menyimpan file Excel
      $writer = new Xlsx($spreadsheet);
      $filename = 'traffic_data.xlsx';
      $writer->save($filename);
   }

   function login($username, $password)
   {
      $_SESSION['username'] = $username;

      if ($password == $this->getAllUsersPassword()) {
         return 'benar';
      } else {
         return 'salah';
      }
   }
}
