<?php
	class commonPDO{}

	class PostsRepository{
		public function __construct(protected $a, protected $b, protected $c){}
	}
	
	// $postRepository = new PostsRepository('A','B','C');
	
	class Container{
		protected $receipts = [];
		protected $instances = [];
		
		public function __construct(){
		/* 	$this->receipts = [
				'postsRepository' => function (){
					return new PostsRepository('A','B','C');
				}
			]; */
		}
		public function add(string $key, \Closure $func){
			$this->receipts[$key] = $func;
		}
		public function get($what){
			if(!isset($this->instances[$what])){
				$this->instances[$what] = $this->receipts[$what]();
			}
			return $this->instances[$what];
		}
	}
	
	$container = new Container();	
	$container->add('pdo',function(){
		return new commonPDO();
	});
	$container->add('postsRepository', function() use($container){
		return new PostsRepository($container->get('pdo'),'B','C');
	});

	// $postsRepository = $container -> get('postsRepository');
	