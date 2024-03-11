<?php

require('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


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
   public function __construct($interval = null, $durasi = null, $sm = null, $mp = null, $ks = null, $bb = null, $tb = null)
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

   function closeConnections()
   {
      $this->DB->close();
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


   function ambil()
   {
      $query = "SELECT `interval`, `durasi`, `SM`, `MP`, `KS`, `BB`, `TB` FROM " . $this->getTableName();
      $statement = $this->DB->prepare($query);
      $statement->execute();

      // Mengambil hasil query sebagai array asosiatif
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      // echo "KOLOM = " . $result->columnCount() . "<p>=======</p>";

      foreach ($result as $each) {
         foreach ($each as $item) {
            echo "<span>" . $item . "</span>";
         }

         echo "<p>=======</p>";
      }

      $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
      foreach ($columns as $col) {
         echo "<p>" . $col . "</p>";
      }
   }

   function coba()
   {
      // Query untuk mengambil data dari database
      $query = "SELECT * FROM " . $this->getTableName();
      $result = $this->DB->query($query);

      // Membuat objek Spreadsheet
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Menambahkan judul kolom
      $sheetColumns = ['A', 'B', 'C', 'D', 'E', 'F', 'G']; // Sesuaikan dengan nama kolom di tabel Anda
      $databaseColums = ['interval', 'durasi', 'SM', 'MP', 'KS', 'BB', 'TB'];

      $colIdx = 0;
      foreach ($sheetColumns as $col) {
         $sheet->getCell($col . '1')->setValue($databaseColums[$colIdx]);

         $colIdx++;
      }

      // Menyimpan file Excel
      $writer = new Xlsx($spreadsheet);
      $filename = 'data_excel.xlsx'; // Nama file Excel
      $writer->save($filename);
   }




   function exportDataToSpreadsheet()
   {

      // Query untuk mengambil data dari database
      $query = "SELECT `interval`, `durasi`, `SM`, `MP`, `KS`, `BB`, `TB` FROM " . $this->getTableName();
      $statement = $this->DB->prepare($query);
      $statement->execute();

      // Mengambil hasil query sebagai array asosiatif
      $result = $statement->fetchAll(PDO::FETCH_ASSOC);

      // Membuat objek Spreadsheet
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Menulis kolom pada xlsx
      $sheetColumns = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
      $databaseColums = ['Interval', 'Durasi', 'SM', 'MP', 'KS', 'BB', 'TB'];

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
               echo "<p>" . $data . "</p>";
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

      // Memberikan tautan untuk mengunduh file Excel
      // echo '<a href="' . $filename . '">Unduh File Excel</a>';
   }
}

// $user = new DATA('interval', 'durasi', 'kode', 'kode', 'kode', 'kode', 'kode');
// $user->exportDataToSpreadsheet();
