<?php

class Rm_Youtube_Helper_Data extends Mage_Core_Helper_Abstract {

	var $aImgTypes = array(
		'large' => 0, 
		'default' => 2
	);

	/**
	 * Get Youtube Video Image
	 * @param	sVidId	string	ID of the video
	 * @param	sType	string	type of image you want, large thumbnail etc. see var $aImgTypes
	 * @return	string	image
	 */
	function getImage($sVidId = null, $sType = 'large') {
		$sType = isset($this->aImgTypes[$sType]) ? $this->aImgTypes[$sType] : $sType;
		return "http://img.youtube.com/vi/{$sVidId}/{$sType}.jpg";
	}

	/**
	 * Get Youtube Videos from a string
	 * @param	sVideos 	string 	that contains youtube videos
	 * @param	aSettings	array	setting to grab additional data about the videos
	 */
	function getYtVids( $sVideos = null, $aSettings = array() ) {
			
		if(!empty($sVideos)) {
			preg_match_all("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=[0-9]/)[^&\n]+|(?<=v=)[^&\n]+#", $sVideos, $aMatches);
	        if(isset($aMatches[0])) {
	        	
				$aVideos = array();
				foreach($aMatches[0] as $iKey => $sVideoId) {
					
					$sVideoId 	= trim($sVideoId);
					$jVideoInfo = file_get_contents("http://gdata.youtube.com/feeds/api/videos/" . $sVideoId . "?v=2&alt=json");
					$aVideoInfo = json_decode($jVideoInfo, true);
					
					if(!isset($aVideos[$sVideoId])) {
						$aVideos[$sVideoId] = array(
							'video_id' => $sVideoId, 
							'title' => $aVideoInfo['entry']['title']['$t'], 
							'all' => $aVideoInfo
						);	
					}
				}
				
				return $aVideos;
				
	        }
		}
	
		return false;
	}

}