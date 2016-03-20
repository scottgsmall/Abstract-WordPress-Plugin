<?php

namespace Basis\Model\Plugin;

use Basis\Model\AbstractModel;

abstract class AbstractPlugin extends AbstractModel implements PluginInterface {

	abstract protected function get_plugin_components();

	public function register_callbacks() {

		foreach ( $this->get_plugin_components() as $component ) {
			$component->register_callbacks();
		}
		
		return $this;
	}

	public function load_resources() {

		foreach ( $this->get_plugin_components() as $component ) {
			$component->load_resources();
		}
		
		return $this;
	}

	public function run() {

		foreach ( $this->get_plugin_components() as $component ) {
			$component->run();
		}
		
		return $this;
	}

}

?>