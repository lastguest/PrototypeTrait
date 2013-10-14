# PrototypeTrait

Simulate Javascript's prototype based object definition in PHP (using Traits)

This trait can be used for expanding a class definition adding methods to all active instances.
It's a sort of IoC/Decorator pattern, not a truly Prototype (PHP use classic OOP).


```php
trait Prototype {
    public static $prototype=[];
    public function __call($n,$p){
        $r = static::$prototype;
        if(isset($r[$n]) && is_callable($r[$n]))
            return call_user_func_array($r[$n],$p);
        throw new Exception('Tried to call unknown method '.get_class($this).'::'.$n);
    }
}
```

Tweet sized version :

```php
trait Prototype{static$prototype=[];function __call($n,$p){$v=static::$prototype;return$v[$n]?call_user_func_array($v[$n],$p):$v();}}
```

### How to use

```php
class TestClass {
    use Prototype;
}

$test = new TestClass;
$test->hello(); // Error! Method TestClass::hello is not defined

// Add the hello() method to TestClass prototype
TestClass::$prototype['hello'] = function(){
  echo 'Hello!';
};

$test->hello(); // Hello!

// Create a new Test instance
$test2 = new TestClass;

$test->hello(); // Hello!
```

## License (MIT)

Copyright (c) 2012 Stefano Azzolini

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
