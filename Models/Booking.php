<?php
    class Booking {
        // getConnection() makes connection with the database and provides the connection for the other methodes.
        private static function getConnection() {
            return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
        }
        // getAllYears() Collects all the booking years a
        public static function getAllYears() {
            $db = self::getConnection();
            $req = $db->query('SELECT BookYearId, Year FROM bookingyear');
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
        //  getByYear()
        public static function getByYear(String $year) {
            $db = self::getConnection();
            $req = $db->prepare('SELECT * FROM bookingyear WHERE Year = ?');
            $req->execute([$year]);
        }
    }
?>