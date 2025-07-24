<?php
ob_start();

$page_title = 'Project ABCD > Shop1';
include('header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Shop1 - Redbubble</title>
    <?php include 'css/css.html'; ?>
</head>

<style>
/* Styles for main embedded shop page */
    .shop-page {
    	padding: 2rem 1rem 10rem 1rem;
    }
    .shop-page h1 {
    	font-size: 3rem;
    	line-height: 3rem;
    	color: darkgoldenrod;
      	font-weight: 300;
    }
    .shop-page .text-box {
    	max-width: 80ch;
    	margin: 0 auto;
    }
    .shop-box {
    	width: 266px;
    	margin: 0 auto;
    }
    .shop-box iframe {
    	width: 100%;
    	height: 2749px; /* 12 items tall */
    }
    
     @media (min-width: 506px) { 
     	.shop-box { 
     		width: 506px; 
     	} 
     	.shop-box iframe { 
     		height: 1417px; /* 6 items tall */ 
     	} 
     } 
    
     @media (min-width: 746px) { 
     	.shop-box { 
     		width: 746px; 
     	} 
     	.shop-box iframe { 
     		height: 973px; /* 4 items tall */ 
     	} 
     } 
    
     @media (min-width: 986px) { 
     	.shop-box { 
     		width: 986px; 
     	} 
     	.shop-box iframe { 
     		height: 751px; /* 3 items tall */ 
     	} 
     } 
    
     @media (min-width: 1226px) { 
     	.shop-box { 
     		width: 1226px; 
     	}
    }
</style>

<main class="shop-page">
	<section class="text-box">
    	<h1>This shop is found in Redbubble.</h1>
    	<h2>Feel free to browse. DO NOT PURCHASE YET.</h2>
	</section>
	<section class="shop-box">
		<script type="text/javascript" src="https://www.redbubble.com/assets/external_portfolio.js"></script>
		<script id="rb-xzfcxvzx" type="text/javascript">
			new RBExternalPortfolio('www.redbubble.com', 'projectabcd', 3, 4).renderIframe();
		</script>
	</section>
</main>
</html>
