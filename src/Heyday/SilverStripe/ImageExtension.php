<?php

namespace Heyday\SilverStripe;

/**
 * Class ImageExtension
 */
class ImageExtension extends \DataExtension
{
    /**
     * @return array
     */
    public function allMethodNames()
    {
        $methods = array();
        foreach (get_class_methods($this) as $method) {
            if (substr($method, 0, 8) === 'generate') {
                $method = strtolower($method);
                $methods[] = $method;
                $methods[] = substr($method, 8);
            }
        }
        return $methods;
    }
    /**
     * @param $name
     * @param $args
     * @return mixed
     */
    public function __call($name, $args)
    {
        array_unshift($args, $name);
        return call_user_func_array(
            array(
                $this->owner,
                'getFormattedImage'
            ),
            $args
        );
    }
}