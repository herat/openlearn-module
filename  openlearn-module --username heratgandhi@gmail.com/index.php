<?php
	/*
	 * This php file will be displayed to students when they click on one of the "Search OpenLearn"
	 * links provided as a course tool by the instructor of the course. It will display one form for
	 * searching OpenLearn's repository.
	 */
	define('AT_INCLUDE_PATH', '../../include/');
	require (AT_INCLUDE_PATH . 'vitals.inc.php');
	$_custom_css = $_base_path . 'mods/ol_search_open_learn/module.css'; // use a custom stylesheet
	require (AT_INCLUDE_PATH . 'header.inc.php');
?>
<div class="input-form">
<form id="search" name="search" method="get" action="mods/ol_search_open_learn/result_gen.php" onsubmit="return validate()">
    <table>
        <tr>
            <td>
                <?php echo _AT('ol_search_open_learn'); ?>:
            </td>
            <td>
                <input type="text" name="q" id="key" size="40" />
            </td>

        </tr>
        <tr>
            <td>
                <?php
                /*
                 * Display option for selecting boolean operation for
                 * multiple keywords : "And"/"Or"
                 */
                echo _AT('ol_bool'); ?>:
            </td>
            <td>
                <input type="radio" name="b" id="bool" value="1" />
                <?php echo _AT('ol_or'); ?>
                <input type="radio" name="b" id="bool" value="2" checked="checked" />
                <?php echo _AT('ol_and'); ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php
                /*
                 * Display option for selecting sorting order of search results
                 */
                echo _AT('ol_order'); ?>:
            </td>
            <td>
                <select name="orderby" id="orderby" >
                    <option value="1" <?php if ($orderby == 1) echo "selected='selected'" ?>><?php echo _AT('ol_def'); ?></option>
                    <option value="2" <?php if ($orderby == 2) echo "selected='selected'" ?>><?php echo _AT('ol_title_asc'); ?></option>
                    <option value="3" <?php if ($orderby == 3) echo "selected='selected'" ?>><?php echo _AT('ol_title_desc'); ?></option>
                    <option value="4" <?php if ($orderby == 4) echo "selected='selected'" ?>><?php echo _AT('ol_date_asc'); ?></option>
                    <option value="5" <?php if ($orderby == 5) echo "selected='selected'" ?>><?php echo _AT('ol_date_desc'); ?></option>
                 </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
	            <input type="submit" value="Search" class="button" />
            </td>
        </tr>
    </table>
</form>
</div>
<?php require (AT_INCLUDE_PATH . 'footer.inc.php'); ?>
<script type="text/javascript">
	function trim( str ){
		return str.replace(/^\s+|\s+$/g, "");
	}
	function validate(){
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
