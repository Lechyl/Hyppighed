<?php


class PersonData
{
    private $navn;
    private $email;
    private $alder;
    private $str;

    public function __construct($navn,$email,$alder,$str)
    {
        $this->navn = $navn;
        $this->email = $email;
        $this->alder = $alder;
        $this->str = $str;
    }

    /**
     * @return mixed
     */
    public function getNavn()
    {
        return $this->navn;
    }

    /**
     * @param mixed $navn
     */
    public function setNavn($navn)
    {
        $this->navn = $navn;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAlder()
    {
        return $this->alder;
    }

    /**
     * @param mixed $alder
     */
    public function setAlder($alder)
    {
        $this->alder = $alder;
    }

    /**
     * @return mixed
     */
    public function getStr()
    {
        return $this->str;
    }

    /**
     * @param mixed $str
     */
    public function setStr($str)
    {
        $this->str = $str;
    }
}