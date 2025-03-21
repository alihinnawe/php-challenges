<?php
	
	class GalleryImageRepository{
		public function __construct(private PDO $pdo){}
	public function fetchAll(){
		var_dump($this->pdo);
	return[
		new GalleryImageModel('bild1.jpg','title: Bild o1'),
		new GalleryImageModel('bild2.jpg','title: Bild o2'),
		new GalleryImageModel('bild3.jpg','title: Bild o3'),
		new GalleryImageModel('bild4.jpg','title: Bild o4'),
	];
	}
}