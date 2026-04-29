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
    }
?>