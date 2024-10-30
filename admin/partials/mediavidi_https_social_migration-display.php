<?php

/**
 * Plugin options screen 
 *
 * Copyright (C) 2015 MediaVidi.com, all rights reserved
 *
 * @link       https://mediavidi.com
 * @since      1.0.0
 *
 * @package    Mediavidi_https_social_migration
 * @subpackage Mediavidi_https_social_migration/admin/partials
 */

if (stripos(home_url(), "https:") === false) {
	$test_url = str_ireplace("http:", "https:", plugin_dir_url(__FILE__) . "ssl_test.php");
?>
<div class="wrap">
<script type="text/javascript">

	var ssl_url = "https://" + window.location.hostname;

	function test_ssl() {
		var test_url = "<?php echo $test_url ?>";
		var xmlhttp = new XMLHttpRequest();	
		xmlhttp.open("GET", test_url, true);
		xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		try {
			xmlhttp.send();
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 ) {
					console.log("Status: " + xmlhttp.status);
					if (xmlhttp.status == 0) {
						test_ssl_fail();
					} else {
						test_ssl_pass();
					}
				}
			}
		}
		catch(e) {
			console.log("Error: " + e.message);
			test_ssl_fail();
		}
	}

	function test_ssl_pass() {
		document.getElementById("ssl_test_message").innerHTML = "The SSL Certificate for " + ssl_url + " is configured correctly";
		document.getElementById("ssl_success_div").style.display = "block";
	}

	function test_ssl_fail() {
		document.getElementById("ssl_test_message").innerHTML = "The SSL Certificate for " + ssl_url + " is not configured correctly";
		document.getElementById("https_test_url").innerHTML = "<a href='" + ssl_url + "' target='_blank'>" + ssl_url + "</a>";;
		document.getElementById("ssl_fail_div").style.display = "block";
	}

	test_ssl();

</script>
<h1 style="margin-bottom: 12px;font-size: xx-large"><span style="display: inline-block;vertical-align: middle"><?php echo esc_html(get_admin_page_title()); ?></span></h1>

<h3 id="ssl_test_message">Testing SSL configuration...</h3>
<div id="ssl_success_div" style="display: none">
<p style='font-size: 16px'>Congratulations!  You are now ready to continue migrating your WordPress site.</p>
<p style='font-size: 16px'>Start your migration by clicking the following button:</p>
<form method="post" name="mediavidi_https_social_migration" action="options.php"><input type="hidden" name="mediavidi_https_social_migration_phase" value="1" />
<?php settings_fields($this->plugin_name); ?>
<p><?php submit_button('Migrate Your Site to HTTPS', 'primary','submit', TRUE); ?></p>
</div>

<div id="ssl_fail_div" style="display: none">
<h2 style="font-size: 20px">SSL Certificate Error</h2>
<p style='font-size: 16px'>Your SSL Certificate is not installed or is incorrectly installed.</p>
<p style='font-size: 16px'>You have two options:</p>
<ol>
<li style='font-size: 16px'>Correctly install an SSL certificate for this site.</li>
<li style='font-size: 16px'>Upgrade your <b>HTTPS Social Migration</b> plugin. The upgrade includes:</li>
<ul>
<li style='font-size: 16px'>10% Discount on a DigiCert SSL Certificates.</li>
<li style='font-size: 16px'>Instructions that will help you purchase the correct certificate and install it successfully.</li>
<li style='font-size: 16px'>A powerful but simple tool that will preserve the Likes and Shares on your existing web pages after you migrate to HTTPS.</li>
<li style='font-size: 16px'>Helpful tips on finding and correcting problems that commonly occur after you migrate to HTTPS.</li>
<li style='font-size: 16px'>Course material and helpful videos.</li>
</ul>
</ol>
<p style='font-size: 16px'><input type="button" value="Upgrade" onclick="window.location='https://mediavidi.com/downloads/https-social-migration-pro/'" class="button button-primary" /></p>
</div>
</div>

<?php
	exit(0);
}
?>
<script type="text/javascript">
function mediavidi_https_social_migration_select(id) {
	var checked = document.getElementById("mediavidi_https_social_migration_select_all_" + id).checked;

	var form = document.mediavidi_https_social_migration;

	for (var i = 0; i < form.elements.length; i++) {
	        if (form.elements[i].type == 'checkbox') {
			form.elements[i].checked = checked;			
		}
	}
}

</script>
<style>
td.standard {
	background-color: white;
	padding: 6px 12px;
}

td.standard_blue {
	background-color: #E8E8E8;
	padding: 6px 12px;
}

td.header {
	background-color: lightblue;
	padding: 6px 12px;
	font-weight: bold;
	border-bottom: 1px solid #141414;
}
td.footer {
	background-color: lightblue;
	padding: 6px 12px;
	font-weight: bold;
	border-top: 1px solid #141414;
}
</style>
<div class="wrap">
<h1 style="margin-bottom: 12px;font-size: xx-large"><span style="display: inline-block;vertical-align: middle"><?php echo esc_html(get_admin_page_title()); ?></span></h1>
<div style="float: left;max-width: 70%">
<h2 style='font-size: 20px'><b>Important</b></h2>
<p style='font-size: 16px'>Your site has been switched to HTTPS mode. </p>
<p style='font-size: 16px'>When a site is switched from http to https, all the social media Likes and Shares you have accumulated continue to point to the <b>old</b> http page names.</p>
<p style='font-size: 16px'>You will not have any social media Likes and Shares on your new https pages.</p>

<p style='font-size: 16px'>Preserving your existing Likes and Share is important because:</p>

<ol>
<li style='font-size: 16px'><b>Search Engine Rankings</b> - Search engines take social signals (Likes and Shares) into consideration. </li>
<li style='font-size: 16px'><b>User Perception</b> - Social media buttons displaying counts of likes and shares will make your site appear unpopular. </li>
</ol>

<p style='font-size: 16px'>There is a way to continue using HTTPS and preserve your old likes and shares.</p>

<p style='font-size: 16px'>Preserve your Wordpress Site’s Authority - Upgrade to HTTPS Social Migration Pro</p>

<p style='font-size: 16px'><input type="button" value="Learn More" onclick="window.location='https://mediavidi.com/downloads/https-social-migration-pro/'" class="button button-primary" /></p>
</div><div style="float: right;max-width: 25%">
<img src="https://mediavidi.com/wp/wp-content/uploads/2016/01/HTTPS-Wordpress-Ad.jpg" onclick="window.location='https://mediavidi.com/downloads/https-social-migration-pro/'" style="cursor: pointer;width: 100%" /></div>
</div>

