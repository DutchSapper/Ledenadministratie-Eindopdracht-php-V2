<?php
    Class FamMember {
        //  getConnection() makes connection with the database and provides the connection for the other methodes.
        private static function getConnection() {
            return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
        }

        public static function getFamMembers(INT $famId){
            $db = self::getConnection();
            $req = $db->prepare('SELECT * FROM fammember WHERE famId = ?');
            $req->execute([$famId]);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>