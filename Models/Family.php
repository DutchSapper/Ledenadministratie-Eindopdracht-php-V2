<?php
    Class Family {
        //  getConnection() makes connection with the database and provides the connection for the other methodes.
        private static function getConnection() {
            return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
        }

        //  all() makes connetion with the database and returns all the data.
        public static function all() {
            $db = self::getConnection();
            $req = $db->query('SELECT * FROM Families');
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }

        // // CreateFam() gets the information from the createfamily pages and puts the new familyName in the database
        // public static function createFam(String $famname, String $adress, String $city, String $postcode, String $country) {
        //     $db = self::getConnection();
        //     $req = $db->prepare('INSERT INTO families (Famname, Adress, City, Postcode, Country) VALUES (?,?,?,?,?)');
        //     $req->execute([$famname, $adress, $city, $postcode, $country]);
        //     return $db->lastInsertId();     // lastInsertId will return the last fam id to the controller to edit the family
        // }

        // // getById() gets the info of the familie to present on screeen to edit the information
        // public static function getById(String $famId){
        //     $db = self::getConnection();
        //     $req = $db->prepare('SELECT * FROM Families WHERE famId = ?');
        //     $req->execute([$famId]);
        //     return $req->fetch(PDO::FETCH_ASSOC);
        // }

        // public static function getFamMembers(INT $famId){
        //     $db = self::getConnection();
        //     $req = $db->prepare('SELECT * FROM fammember WHERE famId = ?');
        //     $req->execute([$famId]);
        //     return $req->fetchAll(PDO::FETCH_ASSOC);
        // }
    }
?>