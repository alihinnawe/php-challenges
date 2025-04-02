<?php

namespace App\Pages;

class PagesModel{
	public int $id;
	public string $slug;
	public string $title;
	public string $content;
}

/* WordPress nutzt für jeden Beitrag eines Post Types einen Slug, um eine URL zum jeweiligen Inhalt zu erstellen. */