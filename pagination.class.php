<?php

class Pagination {
	
	public $numItems;
	public $itemsPerPage;
	public $numPages;
	public $startItem;
	public $currentPage;
	
	public $queryString = '?';
	
	

	function __construct($numItems, $itemsPerPage = 20) {
		$this->numItems = $numItems;
		$this->itemsPerPage = $itemsPerPage;
		$this->numPages = ceil($numItems/$itemsPerPage);
		
		$this->currentPage = in_array($_GET['page'], range(1, $this->numPages)) ? (int) $_GET['page'] : 1 ;
		
		
		$this->startItem = (($this->currentPage-1) * $itemsPerPage);
		
		if ($this->startItem < 0) { $this->startItem = 0; }
	}
	
	function echoPagination() {
		
		if ($this->numPages == 1) return;
		
		echo '
			<div class="pagination">
			<center>
				<ul>
		';
		
		// if (!$this->onFirstPage()) {
			// echo '<li>'.$this->firstPageClass().'><a href="'.$this->queryString.'&amp;page=1">'.$lang['pag_class_00'].'</a></li>';
		// }
		
		echo '<li><a href="'.$this->queryString.'&amp;page=1">'.$lang['pag_class_00'].'</a></li>';
		
		for ($i=$this->currentPage-1; $i<=$this->currentPage+1; $i++) {
			if ($i<=0 || $i>$this->numPages) continue;
			echo '<li'.$this->isPageSelectedClass($i).'><a href="'.$this->queryString.'&amp;page='.$i.'">'.$i.'</a></li>';
		}
		
		echo '<li><a href="'.$this->queryString.'&amp;page='.$this->numPages.'">'.$lang['pag_class_01'].'</a></li>';
		
		// if (!$this->onLastPage()) {
			// echo '<li'.$this->lastPageClass().'><a href="'.$this->queryString.'&amp;page='.$this->numPages.'">'.$lang['pag_class_01'].'</a></li>';
		// }
		
		echo '
				</ul>
				</center>
			</div>
		';
	}
	
	public function addQueryStringVar($var, $val) {
		$str = $this->queryString == '?' ? '' : '&amp;' ;
		$this->queryString .= $str . $var . '=' .  urlencode($val);
	}
	
	private function isPageSelectedClass($page) {
		return $this->currentPage == $page ? ' class="selected"' : '' ;
	}
	
	private function firstPageClass() {
		return $this->isPageSelectedClass(1);
	}
	
	private function onFirstPage() {
		return $this->currentPage == 1;
	}
	
	private function lastPageClass() {
		return $this->isPageSelectedClass($this->numPages);
	}
	
	private function onLastPage() {
		return $this->currentPage == $this->numPages;
	}
}
?>
