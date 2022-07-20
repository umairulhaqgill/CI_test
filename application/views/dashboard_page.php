<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Dashboard Page</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Dashboard Page</h1>

	<div id="body">
		<p>
            <ul> 
                <li> Active and verified users: <?php echo count($active_and_verified_users); ?></li>
                <li> Active and verified users who have attached active products: <?php echo count($active_and_verified_usr_with_attached_prods); ?></li>
                <li> All active products: <?php echo count($active_products); ?></li>      
                <li> Active products which don't belong to any user: <?php echo count($active_products_do_not_belong_to_any_user); ?></li>
                <li> Amount of all active attached products: <?php echo ($all_active_attached_product); ?></li>    
                <li> Summarized price of all active attached products: <?php echo number_format($summarized_price_of_all_active_attached_products,0); ?></li>
                <li> 
                    <h4>Summarized prices of all active products per user</h4>
                    <ul> 
                        <?php foreach($summarized_prices_all_active_products_per_user as $key=>$val) 
                        {   
                            ?><li><?php echo $key; ?>: &nbsp; <?php echo number_format($val,0); ?></li><?php
                        }
                        ?>
                    </ul>
                </li>
                <li>
                    <h4>Exchange rates for USD and RON based on Euro</h4>
                    <ul>  
                        <?php
                        if(isset($exchange_rates['status']) && $exchange_rates['status'] == 1)
                        {
                            ?>
                                <li> EUR to USD: &nbsp; <?php echo $exchange_rates['exchangeRates']['rates']['USD']; ?> </li>
                                <li> EUR to RON: &nbsp; <?php echo $exchange_rates['exchangeRates']['rates']['RON']; ?> </li>
                            <?php
                        }
                        else
                        {
                            ?>
                                <li> EUR to USD: &nbsp; <?php echo $exchange_rates['message']; ?> </li>  
                            <?php
                        }
                        ?>
                        
                    </ul>
                </li>
     
            </ul>            
        </p>
    </div>
</div>

</body>
</html>
