<?php
Class Membertype {
    private static function getConnection() {
        return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
    }

    // getAll() will return all the information from Membertype
    public static function getAll() {
        $db = self::getConnection();
        $req = $db->query('SELECT * FROM MemberType');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // getById will return the kind of membertype by id.
    public static function getById(INT $id) {
        $db = self::getConnection();
        $req = $db->prepare('SELECT * FROM MemberType WHERE MemTypId = ?');
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    // Create() will create a new membertype with a description an discount precentage
    public static function create(String $description, INT $discount) {
        $db = self::getConnection();
        $req = $db->prepare('INSERT INTO MemberType (Description, DiscountPercentage) VALUES (?, ?)');
        $req->execute([$description, $discount]);
    }

    // Update() will update the description and discount for the already used membertype
    public static function update(INT $id, String $description, INT $discount) {
        $db = self::getConnection();
        $req = $db->prepare('UPDATE MemberType SET Description = ?, DiscountPercentage = ? WHERE MemTypId = ?');
        $req->execute([$description, $discount, $id]);
    }

    // getMembertype() will return the membertype of the family member
    public static function getMembertype(INT $famid){
        $db = self::getConnection();
        $req = $db->prepare('SELECT fammember.*, membertype.Description FROM fammember
        INNER JOIN membertype ON membertype.MemTypId = fammember.MemTypId
        WHERE FamId = ?');
        $req->execute([$famid]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    // deleteMembertype has to delete the linked contribution, than unlink the family members than in can delete the membertype
    // public static function deleteMembertype(INT $memTypId) {
    //     $db = self::getConnection();
    //     // First delete the contributie records
    //     $req = $db->prepare('DELETE FROM Contribution WHERE MemTypId = ?');
    //     $req->execute([$memTypId]);
    //     // Than unlink the family member
    //     $req = $db->prepare('UPDATE FamMember SET MemTypId = NULL WHERE MemTypId = ?');
    //     $req->execute([$memTypId]);
    //     // Than the membertype
    //     $req = $db->prepare('DELETE FROM MemberType WHERE MemTypId = ?');
    //     $req->execute([$memTypId]);
    // }
}
?>