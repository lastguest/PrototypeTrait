<?php

/**
 * Prototype Trait
 * @author: Stefano Azzolini <lastguest@gmail.com>
 */
 
trait Prototype {
    public static $prototype=[];
    
    public function __call($n,$p){
        $r = static::$prototype;
        if(isset($r[$n])&&is_callable($r[$n]))
            return call_user_func_array($r[$n],$p);
        throw new Exception('Tried to call unknown method '.get_class($this).'::'.$n);
    }
    
}
