<?php
/**
 * 数据库连接类
 */
namespace sf\db;

use sf\base\Object;

class Connection extends Object
{
    private $_pdo = null;

    private $_dsn;

    private $_username;

    private $_passwd;

    private $_options = [];

    private $_charSet = 'UTF-8';

    public function __construct($config = [])
    {
        if (!empty($config)) {
            foreach ($config as $name=>$value) {
                $this->$name = $value;
            }

            $this->_pdo = new \PDO($this->_dsn, $this->_username, $this->_passwd, $this->_options);

            $this->setDbCharset();
        }
    }

    /**
     * @param string $charSet
     */
    public function setCharSet($charSet)
    {
        $this->_charSet = $charSet;
    }

    public function setDbCharset()
    {
        $this->_pdo->query("set names {$this->_charSet}");
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * @param mixed $dsn
     */
    public function setDsn($dsn)
    {
        $this->_dsn = $dsn;
    }

    /**
     * @param array $options
     */
    public function setOptions($options)
    {
        $this->_options = $options;
    }

    /**
     * @param mixed $passwd
     */
    public function setPasswd($passwd)
    {
        $this->_passwd = $passwd;
    }
    
    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @param \PDO|null $pdo
     */
    public function getPdo($pdo)
    {
        $this->_pdo = $pdo;
    }
}