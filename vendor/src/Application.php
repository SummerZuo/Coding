<?php
/**
 * Application
 * 程序主控制类
 */

namespace sf;

use Sf;
use sf\base\Component;

class Application extends Component
{
    private $defaultRoute = 'app\controller';
    /*
     * 默认控制器
     */
    private $defaultController = 'site';

    /*
     * 默认action
     */
    private $defaultAction = 'index';

    public function __construct($config)
    {
        $this->loadConfig($config);
    }

    /**
     * 加载配置文件
     * 支持热加载
     */
    public function loadConfig($config)
    {

        foreach ($config as $key=>$item) {
            if (isset($item['class'])) {
                Sf::$container->register($item['class'], $item);
            } else {
                $this->$key = $item;
            }
        }
    }

    /**
     *
     */
    public function run()
    {
//        $s = Sf::$container->make('app\exception\Test');
        $this->handleRequest();
    }

    public function handleRequest()
    {
        $request = $this->getRequest();
        $controller = $request->get('c', $this->defaultController);
        $action = $request->get('a', $this->defaultAction);

        $class = Sf::$container->get($this->defaultRoute . '\\' . $controller . 'Controller');
        // @todo 根据参数
        $actionParams = $this->getActionParams($class, $action);

        //  存在问题：如果action中需要传入默认参数，怎么传入
        call_user_func([$class,$action], $actionParams);
    }

    public function getRequest()
    {
        return $this->get('sf\web\request');
    }

    public function get($class)
    {
        return Sf::$container->get($class);
    }

    public function getActionParams($class, $method)
    {
        // ReflectionMethod
    }
}
