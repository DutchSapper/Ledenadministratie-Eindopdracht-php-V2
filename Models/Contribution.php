<?php
Class Contribution {
    private static function getConnection() {
        return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
    }

    // FamContribution() - totaal per familie per jaar
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

    // MemberContribution() - contributie per lid per familie per jaar
    public static function MemberContribution(INT $famid, String $year) {
    $db = self::getConnection();
    $req = $db->prepare('SELECT FamMember.FamMemId, FamMember.Name, FamMember.MemTypId, 
    Contribution.ConAmount FROM FamMember
    INNER JOIN Contribution ON FamMember.FamMemId = Contribution.FamMemId
    INNER JOIN BookingYear ON Contribution.BookYearId = BookingYear.BookYearId
    WHERE FamMember.FamId = ? AND BookingYear.Year = ?');
    $req->execute([$famid, $year]);
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

    public static function updateAmount(INT $famMemId, float $amount, String $year) {
        $db = self::getConnection();
        $req = $db->prepare('UPDATE Contribution 
        INNER JOIN BookingYear ON Contribution.BookYearId = BookingYear.BookYearId
        SET ConAmount = ? 
        WHERE Contribution.FamMemId = ? AND BookingYear.Year = ?');
        $req->execute([$amount, $famMemId, $year]);
    }

}
?>