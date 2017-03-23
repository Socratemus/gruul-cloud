<?php

namespace Application\Traits\Service;

use Application\Exception\InvalidArgumentException;

trait BuilderAwareTrait {
    
	public function __call($method, $arguments) {
		$var = substr($method, 3); 
		$property = $this->from_camel_case($var);
		
		if (strncasecmp($method, "get", 3) === 0) {
			 return $this->onGetterCall($property);
		}
		
		if (strncasecmp($method, "set", 3) === 0) {
			 return $this->onSetterCall($property, $arguments);						 
		}	
	
		if(!method_exists($this, $method))
		{
				throw new \BadMethodCallException(get_class($this) . " does not implement [$method] method.");
		}
	}
	
	private function onSetterCall($property, $args) {
		if(!property_exists($this, $property)) 
		{
				throw new InvalidArgumentException("Property [$property] does not exists on [".get_class($this)."]");
		}
		$this->$property = $args[0];
	}

	public function onGetterCall($property) {
		if(!property_exists($this, $property)) 
		{
				$property = $property ?: "PROPERTY_NOT_SET"; 
				throw new InvalidArgumentException("Property [`" . $property . "`] does not exists on [".get_class($this)."]");
		}
		return $this->$property;
	}

	private function from_camel_case($input) {
			preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
			$ret = $matches[0];
			foreach ($ret as &$match) {
				$match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
			}
			return implode('_', $ret);
	}
}

?>