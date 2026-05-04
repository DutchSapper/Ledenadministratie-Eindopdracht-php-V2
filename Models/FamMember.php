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

        public static function getFamMember(INT $famMemId){
            $db = self::getConnection();
            $req = $db->prepare('SELECT * FROM fammember WHERE fammemid = ?');
            $req->execute([$famMemId]);
            return $req->fetch(PDO::FETCH_ASSOC);
        }

        public static function createMember(String $name, String $dateofbirth, String $memdes, INT $famid){
            $db = self::getConnection();
            $req = $db->prepare('INSERT INTO fammember (name, dateofbirth, memdes, famid) VALUES (?, ?, ?, ?) ');
            $req->execute([$name, $dateofbirth, $memdes, $famid]);
        }

        public static function updateMember(String $name, String $dateofbirth, String $memdes, INT $memberid){
            $db = self::getConnection();
            $req = $db->prepare('UPDATE fammember SET Name = ?, dateofbirth = ?, memdes = ? WHERE Fammemid = ?');
            $req->execute([$name, $dateofbirth, $memdes, $memberid]);
        }

        public static function deleteMember(INT $memberid){
            $db = self::getConnection();
            $req = $db->prepare('DELETE FROM fammember WHERE FamMemId = ?');
            $req->execute([$memberid]);
        }

        public static function updateMemTyp(INT $famMemId, INT $memTypId) {
            $db = self::getConnection();
            $req = $db->prepare('UPDATE FamMember SET MemTypId = ? WHERE FamMemId = ?');
            $req->execute([$memTypId, $famMemId]);
        }
    }
?>