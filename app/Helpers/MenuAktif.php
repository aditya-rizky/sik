<?php
	function set_active($uri, $output = 'active')
	{
		if( is_array($uri) ) {
	   		foreach ($uri as $u) {
	     		if (Route::is($u)) {
	       		return $output;
	     	}
	   	}
	 	}else{
	   		if(Route::is($uri)){
	     		return $output;
	   		}
	 	}
	}

	function set_active_open($uri, $output = 'active open')
	{
		if( is_array($uri) ) {
	   		foreach ($uri as $u) {
	     		if (Route::is($u)) {
	       		return $output;
	     	}
	   	}
	 	}else{
	   		if(Route::is($uri)){
	     		return $output;
	   		}
	 	}
	}
?>