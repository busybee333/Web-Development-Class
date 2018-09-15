<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/26/2018
 * Time: 9:53 PM
 */

namespace Noir;


class Cookies extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site)
    {
        parent::__construct($site, "cookie");
    }

    /**
     * Create a new cookie token
     * @param $user User to create token for
     * @return New 32 character random string
     */
    public function create($user) {
        $salt = $this->randomSalt();
        $token = $this->randomSalt(32);
        $hash = hash("sha256", $salt.$token);

        $sql = <<<SQL
INSERT INTO $this->tableName(user, salt, hash, date)
VALUES (?,?,?,?)
SQL;
        $pdo = $this->pdo();
        $stmt = $pdo->prepare($sql);

        $stmt->execute(array($user, $salt, $hash, date('Y-m-d H:i:s')));
        return $token;
    }

    /**
     * Validate a cookie token
     * @param $user User ID
     * @param $token Token
     * @return null|string If successful, return the actual
     *   hash as stored in the database.
     */
    public function validate($user, $token) {
        $sql = <<<SQL
SELECT * FROM $this->tableName
WHERE user=?
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($user));
        $cookies = $statement->fetchAll(\PDO::FETCH_ASSOC);

        foreach($cookies as $cookie){
            $hash = hash("sha256", $cookie['salt'].$token);
            if($cookie['hash'] === $hash){
                return $hash;
            }
        }
        return null;
    }

    /**
     * Delete a hash from the database
     * @param $hash Hash to delete
     * @return bool True if successful
     */
    public function delete($hash) {
        $sql = <<<SQL
DELETE FROM $this->tableName
WHERE hash=?
SQL;
        $pdo = $this->pdo();

        $statement = $pdo->prepare($sql);
        $statement->execute(array($hash));

        return true;
    }

    public static function randomSalt($len = 16) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }
}

