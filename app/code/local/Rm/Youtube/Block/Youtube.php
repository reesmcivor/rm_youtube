<?php

class Rm_Youtube_Block_Youtube extends Mage_Core_Block_Template {
	
	protected $aVids = array();
	protected $sYtAttr = null;
	protected $aSettings = array();
	
	/**
	 * Mage Constructor
	 * ---------------------------------------------------------------------------
	 * @return	void
	 */
	function _construct() {
		
		$this->aSettings = array(
			'title' => true, 
			'thumbnail' => true
		);
		
	}
	
	/**
	 * Get youtube
	 * ---------------------------------------------------------------------------
	 * @param	sYtAttr		string that is passed which contains the youtube links
	 * @return	void
	 */
	function getYtVids() {
		return Mage::helper('rm_youtube')->getYtVids( $this->sYtAttr , $this->aSettings);		
	}
	
	/**
	 * Set Youtube Video Attribute
	 * ---------------------------------------------------------------------------
	 * @param	sYtAttr		string that is passed which contains the youtube links
	 * @return	void
	 */
	function setYtVids($sYtAttr) {
		$this->sYtAttr = $sYtAttr; 
		return $this;
	}
	
}
