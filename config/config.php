class Database {
    public static function getConnection() {
        return new PDO("mysql:host=localhost;dbname=cashcash", "root", "");
    }
}
