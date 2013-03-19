<?php

class View {

		public static function Create($request, $values = null)
		{
				$view = new View;
				$view->setRequest($request);
				if($values != null)
				{
						$view->setValues($values);
				}
				$view->getRequested();
				$view->generate();

		}

		private $request;
		private $values = null;
		private $file;

		public function setRequest($request)
		{
				$this->request = $request;
				return $this;
		}

		public function setValues($values)
		{
				$this->values = $values;
				return $this;
		}

		public function getRequested()
		{
				if(strstr($this->request, '.'))
				{
						$requested = explode('.', $this->request);
				}
					else
				{
						$requested = $this->request;
				}

				if( ! is_array($requested) )
				{
						if( file_exists(path('app').'views'.DS.$requested.'.php'))
						{
								$this->file = path('app').'views'.DS.$requested.'.php';
						}
				}
					else
				{
						$i = 0;
						$path = '';
						foreach($requested as $loc)
						{
								if($i == 0)
								{
										$path .= $loc;
								}
									else
								{
										$path .= DS.$loc;
								}
								$i++;
						}
						if( file_exists(path('app').'views'.DS.$path.'.php') )
						{
								$this->file = path('app').'views'.DS.$path.'.php';
						}
				}

		}

		public function generate()
		{
				if($this->values != null)
				{
						foreach($this->values as $key => $value)
						{
								${$key} = $value;
						}
				}

				require($this->file);

		}

}