<?php

use Jenssegers\Mongodb\Model as Eloquent;

class JT extends Eloquent{

	protected $connection = 'anvyonline.com'; //Search at same host mongodb, sync from JT_URL (getDB)

}