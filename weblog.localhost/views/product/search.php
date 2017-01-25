

<link href="/css/search_css.css" type="text/css" rel="stylesheet">
<form id="searchbox" action="<?php print $base_url; ?>/product/search" method="post">
<input  type="text" style="width:200px;"name="searchValue" value="">
<input type="hidden" name="_token" value="<?php print $this->escape($_token); ?>">
<input type="submit" name="name" value="검색">

</form>
