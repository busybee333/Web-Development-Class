<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/20/2018
 * Time: 8:38 PM
 */

namespace Enigma;


class User_Message extends Table
{
    public function __construct(Site $site)
    {
        parent::__construct($site, "user_message");
    }

    public function add($userid, $messageid) {
        $sql = <<<SQL
insert into $this->tableName(userid, messageid)
values(?, ?)
SQL;

        $stmt = $this->pdo()->prepare($sql);
        $ret = $stmt->execute(array($userid, $messageid));

        if($ret === FALSE) {
            return false;
        }


        return $this->pdo()->lastInsertId();
    }

    public function get($id)
    {
        $messages = new Messages($this->site);
        $messagesTable = $messages->getTableName();

        $sql = <<<SQL
SELECT * 
FROM $this->tableName as um, $messagesTable as messages 
WHERE um.userid=? and um.messageid=messages.id
ORDER BY messages.sent desc
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if ($statement->rowCount() === 0) {
            return null;
        }
        $messages = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $allMessages = array();
        foreach($messages as $m){
            $message = new Message($m);
            $allMessages[] = $message;
        }

        return $allMessages;
    }
}