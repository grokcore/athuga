<?php

require 'redbean/rb.php';
require 'slimphp/autoload.php';

class SlimBean {
	const HTTP_404='404 Not Found';
	const HTTP_403='403 Access Forbidden';
	const HTTP_302='302 Found';
	const HTTP_201='201 Created';
	const HTTP_200='200 OK';

	public function __construct() {

		$this->app=new \Slim\Slim();
		$this->request=$this->app->request();
		$this->response=$this->app->response();

		$this->debug=(false);

		$this->app = new \Slim\Slim();
		$this->app->get('/:bean', array($this,'get'));
		$this->app->get('/paging/:bean', array($this,'paging'));
		$this->app->get('/:bean/:id', array($this,'get'));
		$this->app->post('/:bean', array($this,'post'));
		$this->app->put('/:bean/:id', array($this,'put'));
		$this->app->delete('/:bean/:id', array($this,'del'));
		$this->app->run();

	}
	
	public static function start($dsn,$user=null,$pass=null) {
		R::setup($dsn,$user,$pass);
		$sb=new SlimBean;
		return $sb;
	}

	public function __call($name,$args) {
		if (isset($this->allowed)) {
			if (!in_array($args[0],$this->allowed)) {
				return $this->emit(self::HTTP_403);
			}
		}
		$this->{"_{$name}"}($args[0],@$args[1]);
	}

	private function _allow($bean) {
		$this->allowed[]=$bean;
		$this->allowedByBean[$bean]=key($this->allowed);
		return;
	}

	private function _get($bean,$id=null) {
		if (isset($id)) {
			$b=R::load($bean,$id);
			foreach ($b as $k=>$v) if (strpos($k,'_id')!==FALSE && strpos($k,'own')!==0 ) { $k='own'.ucfirst(str_replace('_id','',$k)); $b->$k=$b->$k; }
			if (empty($b->id)) return $this->emit(self::HTTP_404);
		} else {
			$filter=$orderBy=$limit=null;
			if ($s=$this->request->get('orderBy')) {
				$orderBy="ORDER BY {$s}";
			}
			if ($s=$this->request->get('limit')) {
				$limit="LIMIT {$s}";
			}
			$filter="{$orderBy} {$limit}";
			$b=R::findAll($bean,$filter);
			if (empty($b)) return $this->emit(self::HTTP_404);
		}
		return $this->emit(R::exportAll($b));
	}

	private function _require($bean,$key) {
		if (empty($this->required[$bean])) $this->required[$bean]=array();
		return $this->required[$bean][]=$key;
	}

	private function _paging($bean) {
		$filter=$orderBy=$limit=null;
		$perPage=$this->request->get('perPage');
		$page=$this->request->get('page');
		$perPage=$perPage?$perPage:10;
		$page=$page?$page:1;
		$total=R::getAll("SELECT count(id) AS totalEntries, {$perPage} as perPage, {$page} as currentPage, floor(count(id)/{$perPage}) as totalPages FROM `{$bean}`");
		$start=($page-1)*$perPage;
		$limit="LIMIT {$start},{$perPage}";
		$filter="{$orderBy} {$limit}";
		$b=R::findAll($bean,$filter);
		if (empty($b)) return $this->emit($this->NotFound);
		return $this->emit(array($total,R::exportAll($b)));
	}

	private function _put($bean,$id) {
		$b=R::load($bean,$id);
		$graph = $this->request->put();
		if (isset($_SESSION['user'])) $graph['user']=$_SESSION['user'];
		$graph['type']=$bean;
		$b=R::graph($graph);

		$this->emit($this->debug?R::exportAll($b):self::HTTP_200);
	}

	private function _post($bean) {
		$b=R::dispense($bean);
		$graph= $this->request->isPut()?//post or put switch for putless clients
				$post=$this->request->put():
				$post=$this->request->post();
		if (isset($_SESSION['user'])) $graph['user']=$_SESSION['user'];
		$graph['type']=$bean;
		$b=R::graph($graph);
		R::store($b);

		$this->emit(R::exportAll($b),self::HTTP_201);
	}

	private function _del($bean,$id) {
		$this->emit(
			R::trash(R::load($bean,$id))
		);
	}

	private function hasRelation(&$b,$post) {
		foreach ($post as $k=>$v) {
			if (is_array($v)) {
				$load=array();$i=0;
				foreach ($v as $_k=>$v) {
					if (strpos($k,'own')===0 || strpos($k,'shared')===0) { 
						$nb=strtolower(substr($k,3));
						//if (!is_array($b->$k)) $b->$k=array();
						$b->{$k}[$v]=R::load($nb,$v);
					}
				}
			} else {
				if (strpos($k,'own')===0 || strpos($k,'shared')===0) { 
					$nb=strtolower(substr($k,3));
					if (!is_array($b->$k)) $b->$k=array();
					$b->$k=R::load($nb,$v);
				}
			}
		}
		return $b;
	}


	private function emit($obj) {
		if (is_string($obj)) header("HTTP/1.1 ".$obj);
		header("Content-type: text/javascript");
		echo json_encode($obj);
		exit();
	}


	private function debug($str) {
		echo "<pre>{$str}</pre>";
	}
}

