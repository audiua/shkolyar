<?php 


class Helper{

	/**
	 * длина статьи
	 * @param  Article $article
	 * @return int  длина статьи
	 */
	public static function getLength( Knowall $article ){

		// content
		$content = strip_tags($article->text);
		$content = str_replace( ' ', '', $content );
		$contentLength = mb_strlen($content, 'utf-8');

		// title
		$title = strip_tags($article->title);
		$title = str_replace( ' ', '', $title );
		$titleLength = mb_strlen($title, 'utf-8');

		return $contentLength + $titleLength;

	}


}