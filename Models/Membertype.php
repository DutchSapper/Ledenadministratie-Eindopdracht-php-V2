<?php
Class Membertype {
    private static function getConnection() {
        return new PDO('mysql:host=localhost;dbname=Memberadministration;charset=utf8', 'root', '');
    }

    public static function getAll() {
        $db = self::getConnection();
        $req = $db->query('SELECT * FROM MemberType');
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(INT $id) {
        $db = self::getConnection();
        $req = $db->prepare('SELECT * FROM MemberType WHERE MemTypId = ?');
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(String $description, INT $discount) {
        $db = self::getConnection();
        $req = $db->prepare('INSERT INTO MemberType (Description, DiscountPercentage) VALUES (?, ?)');
        $req->execute([$description, $discount]);
    }

    public static function update(INT $id, String $description, INT $discount) {
        $db = self::getConnection();
        $req = $db->prepare('UPDATE MemberType SET Description = ?, DiscountPercentage = ? WHERE MemTypId = ?');
        $req->execute([$description, $discount, $id]);
    }

    public static function getMembertype(INT $famid){
        $db = self::getConnection();
        $req = $db->prepare('SELECT fammember.*, membertype.Description FROM fammember
        INNER JOIN membertype ON membertype.MemTypId = fammember.MemTypId
        WHERE FamId = ?');
        $req->execute([$famid]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>