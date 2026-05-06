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
        
        // updateFam() recieves the new information and will update the familie information.
        public static function updateFam(INT $famid, String $famname, String $adress, String $city, String $postcode, String $country){
            $db = self::getConnection();
            $req = $db->prepare('UPDATE families SET Famname = ?, Adress = ?, City = ? , Postcode = ?, Country = ? WHERE Famid = ? ');
            $req->execute([$famname, $adress, $city, $postcode, $country, $famid]);
        }    

        //CreateFam() will create a new familie and gives back the new id to open there family page to create new members
        public static function createFam(String $famname, String $adress, String $city, String $postcode, String $country){
            $db = self::getConnection();
            $req = $db->prepare('INSERT INTO families (Famname, Adress, City, Postcode, Country) VALUES (?, ?, ?, ?, ?) ');
            $req->execute([$famname, $adress, $city, $postcode, $country]);
            return $db->lastInsertId();
        }

        //deleteFam() will first delete the contribution and the existing members, than it is able to delte the familie.
        public static function deleteFam(INT $famid) {
            $db = self::getConnection();
            // First the contribution is deleted
            $req = $db->prepare('DELETE Contribution FROM Contribution 
            INNER JOIN FamMember ON Contribution.FamMemId = FamMember.FamMemId 
            WHERE FamMember.FamId = ?');
            $req->execute([$famid]);
            // Than the members of the familie are deleted
            $req = $db->prepare('DELETE FROM FamMember WHERE FamId = ?');
            $req->execute([$famid]);
            // at last the emty familie is deleted.
            $req = $db->prepare('DELETE FROM Families WHERE FamId = ?');
            $req->execute([$famid]);
        }
    }
?>