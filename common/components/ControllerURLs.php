<?php
namespace common\components;

use http\Url;

class ControllerURLs
{
    public static function getControllerPath($controller) {
        static $pattern_for_del = '(.php)';
        static $replacement_for_del = '';

        return preg_replace($pattern_for_del, $replacement_for_del, $controller);
    }

    public static function generateLabel($controller) {
        return $controller::controllerName();
    }

    public static function generateURL($controller, $key) {
        static $pattern_for_del = '(Controller.php)';
        static $replacement_for_del = '';

        static $pattern_for_add_dash = '/[A-Z]/';
        static $replacement_for_add_dash = '-$0';

        return mb_strtolower(
                $key . '/' . substr(
                    preg_replace($pattern_for_add_dash, $replacement_for_add_dash,
                        preg_replace($pattern_for_del, $replacement_for_del, $controller)
                    ),
                    1
                )
            );
    }

    public static function getControllersURL($dir, $key = '', $app = 'backend') {
        $URLs = [];

        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    if (is_dir($dir . '\\' . $file))
                        $URLs[$file] = self::getControllersURL($dir . '\\' . $file, $file, $app);
                    else $URLs[self::generateLabel(self::getControllerPath($app . '\\controllers\\' . ($key != '' ? $key . '\\' : '') . $file))] = self::generateUrl($file, $key);
                }
            }
            closedir($handle);
        }

        return $URLs;
    }

    public static function generateMenuItems($controllers) {
        $menuItems = [];

        while ($controller = current($controllers)) {
            if (is_array($controller)) {
                //$menuItems[] = self::getMenuItems($controller);

                $menuItem = '
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                      ' . key($controllers) . '
                      <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">';

                while ($dropDownList = current($controller)) {
                    $menuItem = $menuItem .
                        '<li><a href="' . \yii\helpers\Url::to([$dropDownList]) . '">' . key($controller) . '</a></li>
                        <li class="divider"></li>';
                    next($controller);
                }

                $menuItems[] = $menuItem . '</ul></li>';
            }
            else $menuItems[] = ['label' => key($controllers), 'url' => [$controller]];

            next($controllers);
        }

        return $menuItems;
    }
}