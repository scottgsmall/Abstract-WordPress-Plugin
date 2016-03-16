<?php

namespace Model\Plugin;

use Model\AbstractModel;
use Library\Singleton\SingletonTrait;
use Library\Singleton\SingletonInterface;

abstract class AbstractPlugin extends AbstractModel implements SingletonInterface {

	use SingletonTrait;
}

?>