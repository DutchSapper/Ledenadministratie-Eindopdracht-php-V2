<?php
    Class FamMember {
        //  getConnection() makes connection with the database and provides the connection for the other methodes.
        private static function getConnection() {
            return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
        }

        // getFamMembers will return all the familie members with the given familie id
        public static function getFamMembers(INT $famId){
            $db = self::getConnection();
            $req = $db->prepare('SELECT * FROM fammember WHERE famId = ?');
            $req->execute([$famId]);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }

        // getMemberById will return a specific member with the given Familie member id
        public static function getMemberById(INT $famMemId) {
            $db = self::getConnection();
            $req = $db->prepare('SELECT * FROM FamMember WHERE FamMemId = ?');
            $req->execute([$famMemId]);
            return $req->fetch(PDO::FETCH_ASSOC);
        }

        // createMember collects the info from the form and will create a new familie member within the familie
        public static function createMember(String $name, String $dateofbirth, String $memdes, INT $famid) {
            $db = self::getConnection();
            $req = $db->prepare('INSERT INTO fammember (name, dateofbirth, memdes, famid) VALUES (?, ?, ?, ?) ');
            $req->execute([$name, $dateofbirth, $memdes, $famid]);
            return $db->lastInsertId();
        }

        public static function assignMemTypByAge(INT $famMemId, String $dateOfBirth) {
            $age = Date('Y') - date('Y', strtotime($dateOfBirth));
            if ($age < 8) $memTypId = 1;
            elseif ($age < 13) $memTypId = 2;
            elseif ($age < 18) $memTypId = 3;
            elseif ($age <= 50) $memTypId = 4;
            else $memTypId = 5;
            
            $db = self::getConnection();
            $req = $db->prepare('UPDATE FamMember SET MemTypId = ? WHERE FamMemId = ?');
            $req->execute([$memTypId, $famMemId]);
        }

        // UpdateMember updates the familie member
        public static function updateMember(String $name, String $dateofbirth, String $memdes, INT $memberid){
            $db = self::getConnection();
            $req = $db->prepare('UPDATE fammember SET Name = ?, dateofbirth = ?, memdes = ? WHERE Fammemid = ?');
            $req->execute([$name, $dateofbirth, $memdes, $memberid]);
        }

        // updateMemTyp updates the membertype of a familie member (used by penningmeester)
        public static function updateMemTyp(INT $famMemId, INT $memTypId) {
            $db = self::getConnection();
            $req = $db->prepare('UPDATE FamMember SET MemTypId = ? WHERE FamMemId = ?');
            $req->execute([$memTypId, $famMemId]);
        }

        // deleteMember will delete the famillie member out of the familie
        public static function deleteMember(INT $famMemId) {
            $db = self::getConnection();
            $req = $db->prepare('DELETE FROM FamMember WHERE FamMemId = ?');
            $req->execute([$famMemId]);
        }
    }
?>