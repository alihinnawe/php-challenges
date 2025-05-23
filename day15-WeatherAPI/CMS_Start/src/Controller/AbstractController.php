<?php
	namespace App\Controller;
	use App\Pages\PagesRepository;
	
	abstract class AbstractController{
		public function __construct(protected PagesRepository $pagesRepository){}
		
		protected function showError404(){
			http_response_code(404);
			$this->render("abstract/showError404",[]);
		}
		
		protected function render($path, array $data = []){
			ob_start();
			extract($data);
			require __DIR__ . '/../../views/frontend' . $path .".view.php";
			$content = ob_get_contents();
			ob_end_clean();
			
			$navigation = $this->pageRepository->getNavigation();
			require __DIR__ . '/../../views/frontend/layouts/main.view.php';
		}
		
	}

