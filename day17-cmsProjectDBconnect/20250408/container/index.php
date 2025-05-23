<?php
	class PostsRepository{
		public function __construct(protected $a, protected $b, protected $c){}
	}
	
	// $postRepository = new PostsRepository('A','B','C');
	
	class Container{
		protected ?PostsRepository $postsRepository = NULL;
		
		public function getPostsRepository(){
			if(empty($this->postsRepository)){
				$this->postsRepository = new PostsRepository('A','B','C');
			}
			return $this -> postsRepository;
		}
	}
	
	$container = new Container();
	$postsRepository = $container -> getPostsRepository();
	
	var_dump($postsRepository);
	var_dump($container -> getPostsRepository());