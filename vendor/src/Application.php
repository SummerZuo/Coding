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

    const BEFORE_REQUEST = 'before_request';

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

        $actionParamsName = $this->getActionParams($class, $action);

        $actionParams = [];
        foreach ($actionParamsName as $paramName) {
            if (isset($paramName->name)) {
                $actionParams[$paramName->name] = $request->get($paramName->name);
            }
        }

        $res = call_user_func_array([$class,$action], $actionParams);


    }

    public function getRequest()
    {
        return $this->get('sf\web\request');
    }

    public function get($class)
    {
        return Sf::$container->get($class);
    }

    public function getResponse()
    {
        return $this->get('sf\web\Response');
    }

    /**
     * 获取一个方法的参数名称
     * @param $class
     * @param $method
     * @return \ReflectionParameter[]
     */
    public function getActionParams($class, $method)
    {
        // ReflectionMethod
        $action = new \ReflectionMethod($class, $method);
        $actionParams = $action->getParameters();

        return $actionParams;
    }
}
