<?php
    class User {
        //User.php is only for the admin who is able to see the see the users of the application    

        //  getConnection() makes connection with the database and provides the connection for the other methodes.
        private static function getConnection() {
            return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
        }

        // findByUsername() searches for a user by username and returns the user data.
        public static function findByUsername(String $username) {
            $db = self::getConnection();
            $req = $db->prepare('SELECT * FROM LoginUsers WHERE Username = ?');
            $req->execute([$username]);
            return $req->fetch(PDO::FETCH_ASSOC);
        }   

        //getAllUsers()
        public static function getAllUsers(){
            $db = self::getConnection();
            $req = $db->prepare('SELECT * FROM LoginUsers');
            $req->execute();
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function createUser(String $username, String $role, String $password){
            $db = self::getConnection();
            $req = $db->prepare('INSERT INTO LoginUsers (username, role, password) VALUES (?, ?, ?) ');
            $req->execute([$username, $role, $password]);
        }

        public static function updateUser(INT $userid, String $username, String $role, String $password){
            $db = self::getConnection();
            $req = $db->prepare('UPDATE LoginUsers SET username = ?, role = ?, password = ? WHERE userid = ?');
            $req->execute([$username, $role, $password, $userid]);
        }



        // getById
        public static function getById(INT $userid){
            $db = self::getConnection();
            $req = $db->prepare('SELECT * FROM LoginUsers WHERE Userid = ?');
            $req->execute([$userid]);
            return $req->fetch(PDO::FETCH_ASSOC);
        }
        
    }
?>