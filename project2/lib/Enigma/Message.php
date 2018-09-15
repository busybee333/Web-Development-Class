<?php
/**
 * Created by PhpStorm.
 * User: Romi
 * Date: 6/20/2018
 * Time: 8:18 PM
 */

namespace Enigma;


class Message
{
    public function __construct($row) {
        $this->id = $row['id'];
        $this->encoded = $row['encoded'];
        $this->code = $row['code'];
        $this->sent = $row['sent'];
        $this->sender = $row['sender'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEncoded()
    {
        return $this->encoded;
    }

    /**
     * @param mixed $encoded
     */
    public function setEncoded($encoded)
    {
        $this->encoded = $encoded;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * @param mixed $sent
     */
    public function setSent($sent)
    {
        $this->sent = $sent;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @param mixed $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
    }

    private $id;
    private $encoded;
    private $code;
    private $sent;
    private $sender;
}