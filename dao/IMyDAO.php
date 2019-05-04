<?php

interface IMyDao{
	
	public  function _add($item);
	public  function _delete($id);
	public  function _search($searched=0);
	public  function _change_price($difference);
	public  function _available_manufacturer();
	public  function _available_body_type();
	public  function _add_manufacturer($new);
	public  function _add_body_type($new);
	
}