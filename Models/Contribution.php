<?php
    Class Contribution {
        // getConnection() makes connection with the database and provides the connection for the other methodes.
        private static function getConnection() {
            return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
        }

        // FamContribution() makes connetion with the database and returns Familie id, name and sums the TotalContribution.
        public static function FamContribution(String $year) {
            $db = self::getConnection();
            $req = $db->prepare('SELECT families.FamId, Famname, SUM(ConAmount) AS TotalContribution From families 
            INNER JOIN FamMember ON families.FamId = FamMember.FamId
            INNER JOIN Contribution ON FamMember.FamMemId = Contribution.FamMemId 
            INNER JOIN BookingYear ON Contribution.BookYearId = BookingYear.BookYearId
            WHERE BookingYear.Year = ? GROUP BY Families.FamId, Famname');
            $req->execute([$year]);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>