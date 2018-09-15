<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/20/2018
 * Time: 8:22 PM
 */

namespace Enigma;


class Messages extends Table
{
    public function __construct(Site $site)
    {
        parent::__construct($site, "message");
    }

    public function get($id)
    {
        $sql = <<<SQL
SELECT * from $this->tableName
where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if ($statement->rowCount() === 0) {
            return null;
        }

        return new Message($statement->fetch(\PDO::FETCH_ASSOC));
    }

    public function add(Message $message) {
        $sql = <<<SQL
insert into $this->tableName(encoded, code, sent, sender)
values(?, ?, ?, ?)
SQL;

        $stmt = $this->pdo()->prepare($sql);
        $stmt->execute(array($message->getEncoded(), $message->getCode(), $message->getSent(), $message->getSender()));

        $id = $this->pdo()->lastInsertId();
        return $id;
    }

    /*public function delete($id) {
        $sql = <<<SQL
delete from $this->tableName
where id=?
SQL;

        $stmt = $this->pdo()->prepare($sql);
        $ret = $stmt->execute(array($id));

        return $ret;
    }*/
}