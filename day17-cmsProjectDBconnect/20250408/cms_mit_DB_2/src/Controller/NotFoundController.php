<?php

namespace App\Controller;
use App\Pages\PagesRepository;

class NotFoundController extends AbstractController {
	  public function __construct(protected PagesRepository $pagesRepository) {
			parent::__construct($pagesRepository);
	}

    public function error404() {
            return $this->showError404();
     
    }
}