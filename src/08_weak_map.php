<?php
///////////////// FIRST EXAMPLE /////////////////////////////

class User { private $name = 'john'; }

$wm = new WeakMap();
$obj = new User;

// this will work, value will be removed after unset
$wm[$obj] = [1,2,3];

// !!! WARNING: this doesn't work, value  will NOT be removed !!!
$wm[$obj] = $obj;

print_r($wm);

unset($obj);

print_r($wm);

///////////////// SECOND EXAMPLE /////////////////////////////

class User { public $name = 'john'; }

class Test { 
	public function get(object $o): object { 
		return $o; 
	}
}

$wm1 = new WeakMap();
$wm2 = new WeakMap();

$u1 = new User;
$u2 = (new Test())->get($u1);

var_dump(spl_object_hash($u1) === spl_object_hash($u2));

$wm1[$u1] = [1,2,3];

$wm2[$u2] = [4,5,6];

unset($u1);

// despite that $u1 is the $u2 object (returned from Test::get()) and has the spl_object_hash()
// $wm1 and $wm2 is NOT cleared
var_dump($wm1, $wm2);
