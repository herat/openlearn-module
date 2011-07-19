<?php
	/*
	 * This php file is used for showing search results to students.
	 */
	 
	define('AT_INCLUDE_PATH', '../../include/');
	require (AT_INCLUDE_PATH . 'vitals.inc.php');
	$_custom_css = $_base_path . 'mods/ol_search_open_learn/module.css'; // use a custom stylesheet
	require (AT_INCLUDE_PATH . 'header.inc.php');
	
	if( $_GET['q'] == null || trim($_GET['q']) == ""){
	  require_once(AT_INCLUDE_PATH . '/classes/Message/Message.class.php');
	  global $savant;
	  //feedback messsage for admin
	  $msg = new Message($savant);
	  $msg->addError("Enter keywords");
	  header("Location: index.php");
	}
	
	require ('search.class.php');
	
	// create object of search class
	$obj = new Search();
?>	

<?php
	//get input parameters passed by GET method
	$maxResults = intval(trim(strtolower($_GET['max'])));
	$maxResults1 = intval(trim(strtolower($_GET['max'])));
	$start1 = intval(trim(strtolower($_GET['p'])));
	$bool = intval(trim(strtolower($_GET['b'])));
	$orderby = intval(trim(strtolower($_GET['orderby'])));
	
	if (!$start1){
		$start1 = 1;
	}
	$start = intval(trim(strtolower($_GET['p']))) - 1;
	if ($start < 0){
		$start = 0;
	}
	$urlforkey = urlencode($_GET['q']);
	//$maxResults = intval(trim(strtolower($_GET['maxResults'])));
	
	if ($maxResults == 0){
		$maxResults = 10;  // default
	}
	if ($orderby == 0){
		$orderby = 1;
	}
	$start = $start * $maxResults;
	
	//get search results using all parameters
	$rows = $obj->getSearchResult($_GET['q'], $bool, $orderby, $start, $maxResults);
	//echo count($rows)."<br/>";
	
	//get all search results without any conditions
	$all_results = $obj->getSearchResult($_GET['q'], $bool, $orderby);
	
	if (is_array($all_results)){
		$total_num = count($all_results);
	}
	else{
		$total_num = 0;
	}
	//Search form
?>
<div class="input-form">
<form name="search" method="get" action="mods/ol_search_open_learn/result_gen.php" onsubmit="return validate()">
    <?php
		if ($maxResults1 != 0) {
			echo "<input name='max' type='hidden' value='" . $_GET['max'] . "'/>";
		}
		if ($orderby != 1) {
			echo "<input name='orderby' type='hidden' value='" . $_GET['orderby'] . "'/>";
		}
    ?>
    <table>
        <tr>
            <td>
                <?php echo _AT('ol_search_open_learn'); ?>:
            </td>
            <td>
                <input type="text" id="key" name="q" value="<?php echo $_GET['q']; ?>" size="40" />
            </td>

        </tr>
        <tr>
            <td>
                <?php echo _AT('ol_bool'); ?>:
            </td>
            <td>
                <input type="radio" name="b" id="bool" value="1" <?php if ($bool == 1) echo "checked=\"checked\""; ?> /><?php echo _AT('ol_or'); ?>
                <input type="radio" name="b" id="bool" value="2" <?php if ($bool == 2) echo "checked=\"checked\""; ?> /><?php echo _AT('ol_and'); ?>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Search" class="button" />
            </td>
        </tr>
    </table>
</form>
<br/>

<?php
//options for configuring search results
   if ($total_num > 0) {
       echo "<table width='100%'>";
       echo "<tr>";
       echo "<td align='left'>";
       echo _AT('ol_max_reco'); 
?>:
<form name="max" method="get" action="<?php $maxUrl = $_SERVER[PHP_SELF]; echo $maxUrl; ?>" >
     <input type="hidden" value="<?php echo $_GET['q']; ?>" name="q" />
     <input type="hidden" value="<?php echo $_GET['b']; ?>" name="b" />
     <?php
       if ($orderby > 1) {
     ?>
           <input type="hidden" value="<?php echo $_GET['orderby']; ?>" name="orderby" />
     <?php
       }
     ?>
     <select name="max" id="maxResults" >
           <option value="5" <?php if ($maxResults == 5) echo "selected='selected'" ?>>5</option>
           <option value="10" <?php if ($maxResults == 10) echo "selected='selected'" ?>>10</option>
           <option value="25" <?php if ($maxResults == 25) echo "selected='selected'" ?>>25</option>
     </select>
     <input type="submit" value="Change" class="button" />
</form>
</td>

<?php
   echo "<td align='right' >";
   echo _AT('ol_order');
?>:
<form name="order" method="get" action="<?php $maxUrl = $_SERVER[PHP_SELF]; echo $maxUrl; ?>" >
	<input type="hidden" value="<?php echo $_GET['q']; ?>" name="q" />
    <input type="hidden" value="<?php echo $_GET['b']; ?>" name="b" />
    <?php
       if ($maxResults1 > 0) {
    ?>
    	<input type="hidden" value="<?php echo $_GET['max']; ?>" name="max" />
    <?php
		}
    ?>
    <select name="orderby" id="orderby" >
    	<option value="1" <?php if ($orderby == 1) echo "selected='selected'" ?>><?php echo _AT('ol_def'); ?></option>
        <option value="2" <?php if ($orderby == 2) echo "selected='selected'" ?>><?php echo _AT('ol_title_asc'); ?></option>
        <option value="3" <?php if ($orderby == 3) echo "selected='selected'" ?>><?php echo _AT('ol_title_desc'); ?></option>
        <option value="4" <?php if ($orderby == 4) echo "selected='selected'" ?>><?php echo _AT('ol_date_asc'); ?></option>
        <option value="5" <?php if ($orderby == 5) echo "selected='selected'" ?>><?php echo _AT('ol_date_desc'); ?></option>
     </select>
     <input type="submit" value="Change" class="button" />
     </form>
</td>
</tr>
</table>
<?php } ?>

</div>
<?php
	// calculate the last record number
	if (is_array($rows)) {
	   $num_of_results = count($rows);
	
	   if ($maxResults > $num_of_results){
		   $last_rec_number = $start + $num_of_results;
	   }
	   else{
		   $last_rec_number = $start + $maxResults;
	   }
	}
	else{
	   $last_rec_number = $total_num;
	}
	//start-end of total
	if($total_num > 0) {
		echo "<div align=\"center\" >";
		if( count($rows) == $maxResults ){
			echo ($start+1)."-".($maxResults+$start)."  "._AT('ol_of')."  ".$total_num;
		}
		else if( ($start+1) != $total_num ){
			echo ($start+1)."-".$total_num."  "._AT('ol_of')."  ".$total_num;
		}
		else{
			echo ($start+1)."  "._AT('ol_of')."  ".$total_num;
		}
		echo "</div>";
	}
	//paginator
	if ($maxResults1 == 0 && $orderby == 1) {
	   print_paginator($start1, $total_num, "q=" . $urlforkey . SEP . "b=" . $_GET['b'], $maxResults);
	} 
	else if ($orderby == 1 && $maxResults1 > 0) {
	   print_paginator($start1, $total_num, "q=" . $urlforkey . SEP . "b=" . $_GET['b'] . SEP . "max=" . intval($_GET['max']), $maxResults);
	} 
	else if ($maxResults1 == 0 && $orderby > 1) {
	   print_paginator($start1, $total_num, "q=" . $urlforkey . SEP . "b=" . $_GET['b'] . SEP . "orderby=" . intval($_GET['orderby']), $maxResults);
	} 
	else {
	   print_paginator($start1, $total_num, "q=" . $urlforkey . SEP . "b=" . $_GET['b'] . SEP . "orderby=" . intval($_GET['orderby']) . SEP . "max=" . intval($_GET['max']), $maxResults);
	}
	
	//Print Search results if number of results > 0
	if (is_array($rows) && count($rows) > 0) {
	   $i = $start + 1;
	   echo "<div id='container'>";
	   echo "<dl id=\"accordion\">";
	   foreach ($rows as $row) {
	
		   $curr_url = $_SERVER[PHP_SELF];
		   $curr_url .= "?q=" . $urlforkey;
		   if ($maxResults1 > 0) {
			   $curr_url .= "&max=" . $maxResults1;
		   }
		   if ($start != 0) {
			   $curr_url .= "&start=" . $start;
		   }
		   //$curr_url .= "#section";
		   echo "<dt><input class=\"img-ol\" src=\"\" alt=\"\" title=\"\" type=\"image\" /> <a href='#' >" . stripslashes($row['title']) . "</a></dt>";
	
		   /* if( strlen($row['description']) < 300 )
			 echo $row['description']."<br/>";
			 else
			 echo substr($row['description'],0,300)."...<br/>"; */
		   echo "<dd>";
	
	
		   echo "<p><b>"._AT('ol_descri')."</b><br/>" . stripslashes($row['description']) . "</p>";
		   echo "<p><b>"._AT('ol_keywords')."</b><br/>" . stripslashes($row['keywords']) . "</p>";
		   $datentime = datestamp(stripslashes($row['datestamp']));
		   echo "<p><b>"._AT('ol_last_modi')."</b><br/>" . $datentime[0]."  " . _AT('ol_at') ."  ". $datentime[1] . "</p>";
		   echo "<br/>";
		   $i++;
		   $imgs = "<a href='" . $row['cp'] . "'> <img src='mods/ol_search_open_learn/cp.png' alt='Download Content Package' title='Download Content Package' border='0' /> </a> <a href='" . $row['cc'] . "'> <img src='mods/ol_search_open_learn/cc.png' alt='Download Common Cartridge' title='Download Common Cartridge' border='0' /> </a>";
	
		   $prevw = "<a href=\"javascript: void(popup('" . $row['website'] . "','Preview',screen.width*0.45,screen.height*0.45));\" ><img src='mods/ol_search_open_learn/popup.gif' alt='Preview on OpenLearn(popup window)' title='Preview on OpenLearn(popup window)' border='0' /></a>";
		   //$prevw = "<a href=\"".$row['website']."\" title=\"".$row['title']."\" >Preview on OL</a>";
		   
		   $doc_file = "<a href=\"javascript: void(popup('".AT_BASE_HREF."mods/ol_search_open_learn/doc.php?cc=".$row['cc']."&entry=".$row['entry']."','Download',screen.width*0.30,screen.height*0.20));\" ><img src='mods/ol_search_open_learn/word.gif' alt='Download doc file(popup window)' title='Download doc file(popup window)' border='0' /></a>";
	
		   echo "<div align='left' class='menuitems'>".$prevw."&nbsp;&nbsp;".$doc_file."</div><br/>";
	
		   echo "</dd>";
	   }
	   echo "</dl>";
	   echo "</div>";
	   //paginator
	   if ($maxResults1 == 0 && $orderby == 1) {
		   print_paginator($start1, $total_num, "q=" . $urlforkey . SEP . "b=" . $_GET['b'], $maxResults);
	   } 
	   else if ($orderby == 1 && $maxResults1 > 0) {
		   print_paginator($start1, $total_num, "q=" . $urlforkey . SEP . "b=" . $_GET['b'] . SEP . "max=" . intval($_GET['max']), $maxResults);
	   } 
	   else if ($maxResults1 == 0 && $orderby > 1) {
		   print_paginator($start1, $total_num, "q=" . $urlforkey . SEP . "b=" . $_GET['b'] . SEP . "orderby=" . intval($_GET['orderby']), $maxResults);
	   } 
	   else {
		   print_paginator($start1, $total_num, "q=" . $urlforkey . SEP . "b=" . $_GET['b'] . SEP . "orderby=" . intval($_GET['orderby']) . SEP . "max=" . intval($_GET['max']), $maxResults);
	   }
	} 
	else {
	   echo _AT('ol_no')."<b>" . $_GET['q'] . "</b> <br/>";
	}
?>
<?php
	require (AT_INCLUDE_PATH . 'footer.inc.php');
	
	function datestamp($datestamp) {
	   $ind = strpos($datestamp, 'T');
	   $date = substr($datestamp, 0, $ind);
	   $time = substr($datestamp, $ind + 1);
	   $time = substr($time, 0, strlen($time) - 1);
	   $parts = explode("-", $date);
	   $dateandtime = array();
	   $dateandtime[0] = $parts[2] . "-" . $parts[1] . "-" . $parts[0];
	   $dateandtime[1] = $time;
	   return $dateandtime;
	}
?>

<script language="javascript" type="text/javascript" src="/ATutor/jscripts/infusion/lib/jquery/core/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="mods/ol_search_open_learn/accordion.js"></script>

<script>

    function changeMax() {
		var e = document.getElementById("maxResults");
		var ele= e.options[e.selectedIndex].value;
	
		window.location = "<?php echo $_SERVER[PHP_SELF] . "?q=" . $_GET['q'] . "&max="; ?>"+ele;

    }
    function popup(pageURL, title,w,h) {
    	var newWin = window.open(pageURL,title,'toolbar=no,menubar=0,status=0,copyhistory=0,scrollbars=yes,resizable=1,location=0,width='+w+', height='+h);
    }
</script>
<script type="text/javascript">
	function trim( str ) {
		return str.replace(/^\s+|\s+$/g, "");
	}
	function validate()	{
		var key= document.getElementById('key').value;
		if( key == null || trim(key)=="" ) {
			//alert("Enter keyword.");
			document.getElementById('key').focus();
			return false;
		}
		else {
			return true;
		}
	}
</script>
<style type="text/css">
	div.menuitems{
		float:left;
		margin-top:-1.2em;
		border:1px solid #cccccc;
	}
</style>
