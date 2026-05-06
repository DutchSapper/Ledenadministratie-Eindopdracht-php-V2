<?php
Class Contribution {
    private static function getConnection() {
        return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
    }

    // FamContribution() Total contribution for a familie that year
    public static function FamContribution(String $year) {
        $db = self::getConnection();
        $req = $db->prepare('SELECT families.FamId, Famname, SUM(ConAmount) AS TotalContribution FROM families
            LEFT JOIN FamMember ON families.FamId = FamMember.FamId
            LEFT JOIN Contribution ON FamMember.FamMemId = Contribution.FamMemId
            AND Contribution.BookYearId = (
                SELECT BookYearId FROM BookingYear WHERE Year = ?
            )
            GROUP BY Families.FamId, Famname');
        $req->execute([$year]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // MemberContribution() Contribution for every member with in the familly that year
        public static function MemberContribution(INT $famid, String $year) {
        $db = self::getConnection();
        $req = $db->prepare('SELECT FamMember.FamMemId, FamMember.Name, FamMember.MemTypId,
            Contribution.ConAmount FROM FamMember
            LEFT JOIN Contribution ON FamMember.FamMemId = Contribution.FamMemId
            AND Contribution.BookYearId = (
                SELECT BookYearId FROM BookingYear WHERE Year = ?
            )
            WHERE FamMember.FamId = ?');
        $req->execute([$year, $famid]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // UpdateAmount() Will update the ammount of contribution on a existing member
    public static function updateAmount(INT $famMemId, float $amount, String $year) {
        $db = self::getConnection();
        $req = $db->prepare('UPDATE Contribution 
        INNER JOIN BookingYear ON Contribution.BookYearId = BookingYear.BookYearId
        SET ConAmount = ? 
        WHERE Contribution.FamMemId = ? AND BookingYear.Year = ?');
        $req->execute([$amount, $famMemId, $year]);
    }

    public static function createContribution(INT $famMemId, INT $memTypId, String $year) {
        $db = self::getConnection();
        
        // Eerst checken of er al een record bestaat
        $req = $db->prepare('SELECT COUNT(*) FROM Contribution 
            INNER JOIN BookingYear ON Contribution.BookYearId = BookingYear.BookYearId
            WHERE Contribution.FamMemId = ? AND BookingYear.Year = ?');
        $req->execute([$famMemId, $year]);
        $exists = $req->fetchColumn();
    
        if ($exists == 0) {
            // BookYearId ophalen
            $req = $db->prepare('SELECT BookYearId FROM BookingYear WHERE Year = ?');
            $req->execute([$year]);
            $bookYearId = $req->fetchColumn();
            
            // Leeftijd berekenen
            $req = $db->prepare('SELECT DateOfBirth FROM FamMember WHERE FamMemId = ?');
            $req->execute([$famMemId]);
            $member = $req->fetch(PDO::FETCH_ASSOC);
            $age = Date('Y') - date('Y', strtotime($member['DateOfBirth']));
            
            // Kortingspercentage ophalen
            $req = $db->prepare('SELECT DiscountPercentage FROM MemberType WHERE MemTypId = ?');
            $req->execute([$memTypId]);
            $discount = $req->fetchColumn();
            
            // Bedrag berekenen
            $amount = 100 - (100 * $discount / 100);
            
            // Contributie aanmaken
            $req = $db->prepare('INSERT INTO Contribution (FamMemId, MemTypId, BookYearId, Age, ConAmount) 
                VALUES (?, ?, ?, ?, ?)');
            $req->execute([$famMemId, $memTypId, $bookYearId, $age, $amount]);
        }
    }

}
?>