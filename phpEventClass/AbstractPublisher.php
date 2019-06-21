<?
abstract class Publisher{
	protected $Observers=array();
	protected $Events=array();
	/*
	public function __set($prop,$closure){
		if(in_array($prop,$this->Events)){
			$this->hookOnEvent($prop,$closure);
		}
		else{
			throw new Exception("Property $prop is not found or read only");
		}
	}
	
	public function __cal($name,$args){
		if(in_array($name,$this->Events)){
			$this->executeEvent($name,$args);
		}
		else{
			throw new Exception("No such event or bad arguments given");
		}
	}
	*/
	protected function hookOnEvent($event,$closure){
		if(in_array($event,$this->Events)){

						////////////////////////////////////
						//-> подписать свой колбек своего класса на определенное событие класса издателя
						$this->Observers[$event][]= $closure;
						////////////////////////////////////

		}
		else{
			$class=__CLASS__;
			throw new Exception("$class has no event: $event");
		}
		
	}
	
	protected function executeEvent($event,$argument){
		if(in_array($event,$this->Events)){
			if(is_array($this->Observers[$event]) && count($this->Observers[$event])){
				foreach($this->Observers[$event] as $closure){
					$closure(new EventArgument($this,$argument));
				}
			}
			else{
				
			}
		}
		else{
			$class=__CLASS__;
			throw new Exception("$class has no event: $event");
		}
	}
	

}

	class EventArgument{
		public $caller;
		public $argument;
		
		public function __construct($caller,$argument =null){
			$this->caller=$caller;
			$this->argument=$argument;
		}
	}