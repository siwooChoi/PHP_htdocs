<!DOCTYPE html>
<html>
<head>
<meta charset='UTF-8' />
<!-- 각 action에 따른 views폴더내의 view파일들에서 설정하여 보내줌-->
<title>
<?php if (isset($title)): print $this->escape($title) . ' - '; endif; ?>
Weblog
</title>
<!-- { endfor; endwhile; endswitch; endforeach;} -->
<link rel="stylesheet" type="text/css" href="/css/template_css.css">

</head>
<body>

<!-- /////////////////////////////// headLine  ///////////////////////////////////////-->

	<div id='headerLine'>
	            <!-- logo-->
	            <div id='logo'>
	              <a href="<?php print $base_url; ?>/">
	                <img src="/img/bg/bg6.jpg" height="100%" width="100%">
	              </a>
	            </div>
	  <!-- search?? -->
	    <div id='search'>
	      <?php require_once "product/search.php"; ?>
				<!-- <a href="<?php print $base_url; ?>/"></a> -->
	    </div>
	  <!-- login-->
		<div class='login_on'>
				<?php require_once "account/loginflag.php"; ?>
		</div>
		 <!-- 로그인 파트 끝 -->
</div><!--headerLine 끝나는 지점-->

	<!-- 메뉴 목록 시작 -->

		<?php //if ($session->isAuthenticated()): ?>
			<div id="menu">
			<!-- <div id="menu"> -->
					<a href="<?php print $base_url; ?>/product/product">
						<div class='menulist'> 메인 화면  </div>
					</a>

					<a href="<?php print $base_url; ?>/board/contentBoard">
		    		<div class='menulist'> 게시판 </div>
		      </a>

					<?php if((isset($_SESSION['user']['user_name'])) && $_SESSION['user']['user_name'] == "admin") {?>

					<?php } else {
						?><a href="<?php print $base_url; ?>/product/showBasket">
							<div class='menulist'> 장바구니  </div>
						</a>
						<?php
					}?>
			</div>

		<?php //else: ?>
			<!-- <div class="menu">

				<a href="<?php //print $base_url; ?>/product/testButton">
					<div class='menulist'> 메인 화면  </div>
				</a>

				<a href="<?php //print $base_url; ?>/">
	    		<div class='menulist'> 임시 게시판 </div>
	      </a>

				<a href="">
					<div class='menulist'> 장바구니  </div>
				</a>
			</div> -->
			<!-- 메뉴 끝 div -->





		<?php //endif; ?>



<div id="mainContent">
	<?php print $_content; ?>
  <?php  //var_dump($_content); ?>
  <!-- $_content: View 객체의 render()메서드에서 전달해줌 -->
</div>
</body>
</html>
