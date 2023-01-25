<?php 

		$html = "";
		
		if(!empty($pagination)){
		
			$totalPages  = $pagination->totalPages();
			$currentPage = $pagination->currentPage;

			$linkExist   = empty($link)? false: true; 
			$url 		 = empty($link)? "": PUBLIC_ROOT . $link . "?page=";

			if($totalPages > 1) {
				// 1.
				if($pagination->hasPreviousPage()) {

					$link = ($linkExist == false)? "javascript:void(0)": $url . ($currentPage - 1);
					$html .= "<a href='" . $link  . "' class='btn btn-outline-secondary btn-sm prev' ><i class='fa fa-angle-left'></i></a>";
				}
				
				// 2.
				$i = (($currentPage - 4) > 1)? ($currentPage - 4): 1;
				$end = (($currentPage + 4) < $totalPages)? ($currentPage + 4): $totalPages;
				for($i=1; $i <= $end; $i++) {

					$link = ($linkExist == false)? "javascript:void(0)": $url . ($i);
					

					if($i == $currentPage) {
						$html .= "<a href='" . $link . "' class='btn btn-primary btn-sm active'>".$i."</a>";
					} else {
						$html .= "<a href='" . $link . "' class='btn btn-outline-secondary btn-sm'>".$i."</a>";
					}
				}
				
				// 3.
				if($pagination->hasNextPage()) {

					$link = ($linkExist == false)? "javascript:void(0)": $url . ($currentPage + 1);
					$html .= "<a href='" . $link . "' class='btn btn-outline-secondary btn-sm next' ><i class='fa fa-angle-right'></i></a>";
				}
				
			}
		
		}
		
		echo $html;
		
?>