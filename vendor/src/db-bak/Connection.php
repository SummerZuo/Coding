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

    public $command;

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
        $this->_dsn = trim($dsn);
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
    public function setPdo($pdo)
    {
        $this->_pdo = $pdo;
    }

    public function getPdo()
    {
        return $this->_pdo;
    }

    private $_commandMaps = [
        'mysql' => 'sf\db\mysql\Command'
    ];

    public function getCommand()
    {
        $driver = $this->getDriverName();

        if (isset($this->_commandMaps[$driver])) {
            $commandClass = $this->_commandMaps[$driver];
        } else {
            $commandClass = 'sf\db\mysql\Command';
        }
        $config['db'] = $this;
        $command = \Sf::$container->get($commandClass, $config);
        return $command;
    }

    
    public function getDriverName()
    {

    }

    public function getQueryBuilder()
    {
        if ($this->queryBuilder === null) {
            foreach ($this->_commandMaps as $driver=>$command) {
                if (strpos($this->_dsn, $driver) === 0) {
                    $this->command = $command;
                    break;
                }
            }
        }

        return $this->command;
    }
}