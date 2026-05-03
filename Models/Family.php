<?php
    Class Family {
        //  getConnection() makes connection with the database and provides the connection for the other methodes.
        private static function getConnection() {
            return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
        }

        //  all() makes connetion with the database and returns all the data.
        public static function getAll() {
            $db = self::getConnection();
            $req = $db->query('SELECT * FROM Families');
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }

        // getById() gets the info of the familie to present on screeen to edit the information
        public static function getById(INT $famid){
            $db = self::getConnection();
            $req = $db->prepare('SELECT * FROM Families WHERE FamId = ?');
            $req->execute([$famid]);
            return $req->fetch(PDO::FETCH_ASSOC);
        }
        
        public static function updateFam(INT $famid, String $famname, String $adress, String $city, String $postcode, String $country){
            $db = self::getConnection();
            $req = $db->prepare('UPDATE families SET Famname = ?, Adress = ?, City = ? , Postcode = ?, Country = ? WHERE Famid = ? ');
            $req->execute([$famname, $adress, $city, $postcode, $country, $famid]);
        }    

        public static function createFam(String $famname, String $adress, String $city, String $postcode, String $country){
            $db = self::getConnection();
            $req = $db->prepare('INSERT INTO families (Famname, Adress, City, Postcode, Country) VALUES (?, ?, ?, ?, ?) ');
            $req->execute([$famname, $adress, $city, $postcode, $country]);
        }

    }
?>