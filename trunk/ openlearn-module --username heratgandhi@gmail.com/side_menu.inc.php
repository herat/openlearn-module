<?php
	/****************************************************************/
	/* OpenLearn module for ATutor                                  */
	/* http://atutoropenlearn.wordpress.com                         */
	/*                                                              */
	/* This module allows to search OpenLearn for educational       */
	/* content.														*/
	/* Author: Herat Gandhi											*/
	/* This program is free software. You can redistribute it and/or*/
	/* modify it under the terms of the GNU General Public License  */
	/* as published by the Free Software Foundation.				*/
	/****************************************************************/

	/**
	 * This php file is used for side menu. When instructor allows students to
	 * access this module as a course tool then in side menu of course's home page
	 * one entry will be created.
	 */
	/* start output buffering: */
	ob_start(); 
	global $savant;
?>

<a href= "<?php  echo AT_BASE_HREF; ?>mods/ol_search_open_learn/index.php"> <?php echo _AT('ol_search_open_learn'); ?> </a>

<?php
	$savant->assign('dropdown_contents', ob_get_contents());
	ob_end_clean();
	
	$savant->assign('title', _AT('ol_search_open_learn')); // the box title
	$savant->display('include/box.tmpl.php');
?>