<?php
define('AT_INCLUDE_PATH', '../../include/');
require (AT_INCLUDE_PATH.'vitals.inc.php');
authenticate(AT_PRIV_OL_SEARCH_OPEN_LEARN);
require (AT_INCLUDE_PATH.'header.inc.php');
?>
<form name="search" method="get" action="mods/ol_search_open_learn/result_instructor.php">
    <table>
        <tr>
            <td>
        	<?php echo _AT('ol_search_open_learn'); ?>:
            </td>
            <td>
                <input type="text" name="q" />
            </td>

        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Search" />
            </td>
        </tr>
    </table>
</form>
<?php

require (AT_INCLUDE_PATH.'footer.inc.php'); ?>