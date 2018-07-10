<?php

namespace Modules\pages\EntityObjects;

/**
 *
 * @author Hadi Nahavandi
 *        
 */
class pageEntityObject {
		private $name;
		private $title;
		private $content;
		private $language;
		private $isdeleted;
		private $ispublished;
		private $tags;
		private $thumb;
		private $date;
		private $id;
		public function __construct($name,$title,$content,$language,$tags="",$thumb="",$date=null,$ispublished=1)
		{
			$this->name=$name;
			$this->title=$title;
			$this->content=$content;
			$this->language=$language;
			$this->tags=$tags;
			$this->thumb=$thumb;
			$this->date=$date;
			$this->ispublished=$ispublished;
		}
		public function setName($name)
		{
			$this->name=$name;
		}
		public function setTitle($title)
		{
			$this->title=$title;
		}
		public function setContent($content)
		{
			$this->content=$content;
		}
		public function setLanguage($language)
		{
			$this->language=$language;
		}
		public function setIsdeleted($isdeleted)
		{
			$this->isdeleted=$isdeleted;
		}
		public function setIspublished($ispublished)
		{
			$this->ispublished=$ispublished;
		}
		public function setTags($tags)
		{
			$this->tags=$tags;
		}
		public function setThumb($thumb)
		{
			$this->thumb=$thumb;
		}
		public function setDate($date)
		{
			$this->date=$date;
		}
		public function setId($id)
		{
			$this->id=$id;
		}
		public function getName()
		{
			return $this->name;
		}
		public function getTitle()
		{
			return $this->title;
		}
		public function getContent()
		{
			return $this->content;
		}
		public function getLanguage()
		{
			return $this->language;
		}
		public function getIsdeleted()
		{
			return $this->isdeleted;
		}
		public function getIspublished()
		{
			return $this->ispublished;
		}
		public function getTags()
		{
			return $this->tags;
		}
		public function getThumb()
		{
			return $this->thumb;
		}
		public function getDate()
		{
			return $this->date;
		}
		public function getId()
		{
			return $this->id;
		}
	
}

?>