<?php

function wpmantis_init()
{
	$plugin_dir = basename(dirname(__FILE__));
	load_plugin_textdomain('wp-mantis', null, $plugin_dir);
	
	//only include the script in the front end, not in the admin area to avoid conflicts
	if(!is_admin())
	{
		wp_register_script('pagination', WP_PLUGIN_URL . '/wp-mantis/paging.js');
		wp_enqueue_script('pagination');
	}
}

//Fill the options with default entrys. Also used to reset the options.
function wpmantis_set_options()
{
	$options = array(
		'mantis_soap_url' => 'http://yoursite.com/bugs/api/soap/mantisconnect.php?wsdl',
		'mantis_user' => 'wordpress',
		'mantis_password' => 'password',
		'mantis_base_url' => 'http://yoursite.com',
		'mantis_max_desc_lenght' => 25,
		'mantis_statuses' => array(
			'10' => __('New', 'wp-mantis'),
			'20' => __('Feedback', 'wp-mantis'),
			'30' => __('Acknowledged', 'wp-mantis'),
			'40' => __('Confirmed', 'wp-mantis'),
			'50' => __('Assigned', 'wp-mantis'),
			'80' => __('Resolved', 'wp-mantis'),
			'90' => __('Closed', 'wp-mantis')
		),
		'mantis_colors' => array(
			'10' => '#fcbdbd',
			'20' => '#e3b7eb',
			'30' => '#ffcd85',
			'40' => '#fff494',
			'50' => '#c2dfff',
			'80' => '#d2f5b0',
			'90' => '#c9ccc4'
		),
		'mantis_enable_pagination' => true,
		'mantis_bugs_per_page' => 8
	);

}


//Connects to MantisConnect and retrievs the translation for the statuses enum.
function wpmantis_get_status_translation()
{
	$options = get_option('wp_mantis_options');
	extract($options);
	$client = new SoapClient($mantis_soap_url);
	try
	{	
		$results = $client->mc_enum_status($mantis_user, $mantis_password);
		
		foreach ($results as $result)
		{
				$id = $result->id;
				$name = $result->name;
				
				$mantis_statuses[$id] = $name;
		}
		$options['mantis_statuses'] = $mantis_statuses;
		update_option('wp_mantis_options', $options);
		
		?>
        <div id="message" class="updated fade">
        <p><?php _e('Options saved.', 'wp-mantis'); ?></p>
        </div>
        <?php
	}
	catch(SoapFault $e)
	{
		throw $e;
		?>
        <div id="message" class="error fade">
        <p><?php printf(__('Error: %s', 'wp-mantis'), $e->getMessage()); ?></p>
        </div>
        <?php
	}
}

//Reads the new options from POST and writes it to the DB.
function wpmantis_update_options()
{
	$options = get_option('wp_mantis_options');

	$options['mantis_user'] = $_REQUEST['mantis_user'];
	$options['mantis_password'] = $_REQUEST['mantis_password'];
	$options['mantis_soap_url'] = $_REQUEST['mantis_soap_url'];
	$options['mantis_base_url'] = $_REQUEST['mantis_base_url'];
	$options['mantis_max_desc_lenght'] = $_REQUEST['mantis_max_desc_lenght'];
	$options['mantis_enable_pagination'] = isset($_REQUEST['mantis_enable_pagination']);
	$options['mantis_bugs_per_page'] = $_REQUEST['mantis_bugs_per_page'];
	$options['mantis_colors'] = $_REQUEST['color'];
	
	//Check to see that the base URL ends with a trailing slash if not, add it
	if (substr($options['mantis_base_url'], -1, 1) != '/') { $options['mantis_base_url'] .= '/'; }

	update_option('wp_mantis_options', $options);

	?>
	<div id="message" class="updated fade">
	<p><?php _e('Options saved.', 'wp-mantis'); ?></p>
	</div>
	<?php
}

//The main function of this plugin. Parses the attributes and prints out the requested stuff.
function wpmantis_shortcode($atts)
{
	//Get options
	extract(get_option('wp_mantis_options'));
	
	//Select Mode
	if($atts[0] == 'bugs')
	{
		//Get Attributes
		extract(shortcode_atts(array('proj_id' => 0, 'exclude_stat' => '', 'limit' => 1000000, 'include_stat' => ''), $atts));
		
		//Handling of invalid combinations
		if($proj_id == 0)
			return __('Error: No project ID specified!', 'wp-mantis');
		
		if($exclude_stat != '' && $include_stat != '')
			return __('Error: Can not specify both include and exclude!', 'wp-mantis');
			
		$exclude = false; $include = false; //outer scope
		if($exclude_stat != '')
		{
			$exclude_stat = explode(',', $exclude_stat);
			$exclude = true;
			$include = false;
		}
		else if($include_stat != '')
		{
			$include_stat = explode(',', $include_stat);
			$exclude = false;
			$include = true;
		}
		
		$client = new SoapClient($mantis_soap_url);
		try
		{
			$results = $client->mc_project_get_issues($mantis_user, $mantis_password, $proj_id, 1, $limit);
			
			$aa_tv = $aa_is = $aa_ws = $aa_vobb = $aa_gen = 0;
			
			//$output = '<table id="mantis_bugs" border="1" style="border-collapse:collapse"><tr><td>' . __('ID #', 'wp-mantis') . '</td><td>' . __('Status', 'wp-mantis') . '</td><td>' . __('Category', 'wp-mantis') . '</td><td>' . __('Details', 'wp-mantis') . '</td></tr>';
			$output_tv = '<table id="mantis_bugs" border="1" style="border-collapse:collapse"><tr style="font-weight:bold"><td>#</td><td>' . __('Issue', 'wp-mantis') . '</td><td>' . __('Status', 'wp-mantis') . '</td></tr>';
			$output_ws = '<table id="mantis_bugs" border="1" style="border-collapse:collapse"><tr style="font-weight:bold"><td>#</td><td>' . __('Issue', 'wp-mantis') . '</td><td>' . __('Status', 'wp-mantis') . '</td></tr>';
			$output_is = '<table id="mantis_bugs" border="1" style="border-collapse:collapse"><tr style="font-weight:bold"><td>#</td><td>' . __('Issue', 'wp-mantis') . '</td><td>' . __('Status', 'wp-mantis') . '</td></tr>';
			$output_vobb = '<table id="mantis_bugs" border="1" style="border-collapse:collapse"><tr style="font-weight:bold"><td>#</td><td>' . __('Issue', 'wp-mantis') . '</td><td>' . __('Status', 'wp-mantis') . '</td></tr>';
			$output_gen = '<table id="mantis_bugs" border="1" style="border-collapse:collapse"><tr style="font-weight:bold"><td>#</td><td>' . __('Category', 'wp-mantis') . '</td><td>' . __('Issue', 'wp-mantis') . '</td><td>' . __('Status', 'wp-mantis') . '</td></tr>';
			
			foreach ($results as $result)
			{
					$id = $result->id;
					$title = $result->summary;
					$category = $result->category;
					$b_status = $result->status->id;
					$b_status_name = $mantis_statuses[$b_status];
					$description = $result->description;
					//$description = wpmantis_shorten_text($description, $mantis_max_desc_lenght);
					$description = custom_shorten_text($description, 11);
					
					if($exclude && in_array($b_status, $exclude_stat))
						continue;
					else if ($include && !in_array($b_status, $include_stat))
						continue;

					//$output .= "<tr style=\"background: $mantis_colors[$b_status];\"><td><a href=\"{$mantis_base_url}view.php?id=$id\" target=\"_new\">$id</a></td><td>$b_status_name</td><td>$category</td><td><b>$title</b><br />$description</td></tr>";
					
					switch ($category) {
						case "IPTV":
							$aa_tv++;
							$output_tv .= "<tr style=\"background: $mantis_colors[$b_status];\"><td>$aa_tv</td><td><a href=\"{$mantis_base_url}view.php?id=$id\" target=\"_new\"><b>$title</b></a><br />$description</td><td>$b_status_name</td></tr>";
							break;
						case "Internet":
							$aa_is++;
							$output_is .= "<tr style=\"background: $mantis_colors[$b_status];\"><td>$aa_is</td><td><a href=\"{$mantis_base_url}view.php?id=$id\" target=\"_new\"><b>$title</b></a><br />$description</td><td>$b_status_name</td></tr>";
							break;
						case "Wholesales":
							$aa_ws++;
							$output_ws .= "<tr style=\"background: $mantis_colors[$b_status];\"><td>$aa_ws</td><td><a href=\"{$mantis_base_url}view.php?id=$id\" target=\"_new\"><b>$title</b></a><br />$description</td><td>$b_status_name</td></tr>";
							break;
						case "VoBB":
							$aa_vobb++;
							$output_vobb .= "<tr style=\"background: $mantis_colors[$b_status];\"><td>$aa_vobb</td><td><a href=\"{$mantis_base_url}view.php?id=$id\" target=\"_new\"><b>$title</b></a><br />$description</td><td>$b_status_name</td></tr>";
							break;
						default:
							$aa_gen++;
							$output_gen .= "<tr style=\"background: $mantis_colors[$b_status];\"><td>$aa_gen</td><td>$category</td><td><a href=\"{$mantis_base_url}view.php?id=$id\" target=\"_new\"><b>$title</b></a><br />$description</td><td>$b_status_name</td></tr>";
					}
					//$output .= "<tr style=\"background: $mantis_colors[$b_status];\"><td>$category</td><td><a href=\"{$mantis_base_url}view.php?id=$id\" target=\"_new\"><b>$title</b></a><br />$description</td><td>$b_status_name</td></tr>";
			}

			//Close the table
			$output_tv .= '</table>';
			$output_is .= '</table>';
			$output_ws .= '</table>';
			$output_vobb .= '</table>';
			$output_gen .= '</table>';
			
			//Add pagination stuff
			/*if($mantis_enable_pagination)
			{
				$output .= '<div id="mantis_navigation"></div>';
				$output .= "<script type=\"text/javascript\">
							var pager = new Pager('mantis_bugs', $mantis_bugs_per_page);
							pager.init(); 
							pager.showPageNav('pager', 'mantis_navigation', '" . __('Prev', 'wp-mantis') . "', '" . __('Next', 'wp-mantis') . "'); 
							pager.showPage(1);</script>";
			}*/
			
			if($mantis_enable_pagination)
			{
				$output_tv .= '<div id="mantis_navigation_tv"></div>';
				$output_tv .= "<script type=\"text/javascript\">
							var pager_tv = new Pager('mantis_bugs', $mantis_bugs_per_page);
							pager_tv.init(); 
							pager_tv.showPageNav('pager_tv', 'mantis_navigation_tv', '" . __('Prev', 'wp-mantis') . "', '" . __('Next', 'wp-mantis') . "'); 
							pager_tv.showPage(1);</script>";
							
				$output_is .= '<div id="mantis_navigation_is"></div>';
				$output_is .= "<script type=\"text/javascript\">
							var pager_is = new Pager('mantis_bugs', $mantis_bugs_per_page);
							pager_is.init(); 
							pager_is.showPageNav('pager_is', 'mantis_navigation_is', '" . __('Prev', 'wp-mantis') . "', '" . __('Next', 'wp-mantis') . "'); 
							pager_is.showPage(1);</script>";
							
				$output_ws .= '<div id="mantis_navigation_ws"></div>';
				$output_ws .= "<script type=\"text/javascript\">
							var pager_gen = new Pager('mantis_bugs', $mantis_bugs_per_page);
							pager_gen.init(); 
							pager_gen.showPageNav('pager_gen', 'mantis_navigation_ws', '" . __('Prev', 'wp-mantis') . "', '" . __('Next', 'wp-mantis') . "'); 
							pager_gen.showPage(1);</script>";
							
				$output_vobb .= '<div id="mantis_navigation_vobb"></div>';
				$output_vobb .= "<script type=\"text/javascript\">
							var pager_vobb = new Pager('mantis_bugs', $mantis_bugs_per_page);
							pager_vobb.init(); 
							pager_vobb.showPageNav('pager_vobb', 'mantis_navigation_vobb', '" . __('Prev', 'wp-mantis') . "', '" . __('Next', 'wp-mantis') . "'); 
							pager_vobb.showPage(1);</script>";
							
				$output_gen .= '<div id="mantis_navigation_gen"></div>';
				$output_gen .= "<script type=\"text/javascript\">
							var pager_gen = new Pager('mantis_bugs', $mantis_bugs_per_page);
							pager_gen.init(); 
							pager_gen.showPageNav('pager_gen', 'mantis_navigation_gen', '" . __('Prev', 'wp-mantis') . "', '" . __('Next', 'wp-mantis') . "'); 
							pager_gen.showPage(1);</script>";
			}
			
			//Create output
			$output = "";
			if($aa_tv) {$output .= "<strong>IPTV Issue List</strong><br />".$output_tv."<br />";}
			if($aa_is) {$output .= "<strong>Internet Issue List</strong><br />".$output_is."<br />";}
			if($aa_ws) {$output .= "<strong>Wholesales Issue List</strong><br />".$output_ws."<br />";}
			if($aa_vobb) {$output .= "<strong>VoBB Issue List</strong><br />".$output_vobb."<br />";}
			if($aa_gen) {$output .= "<strong>General Issue List</strong><br />".$output_gen."<br />";}
			//$output = "<strong>IPTV Issue List</strong><br />".$output_tv."<br /><strong>Internet Issue List</strong><br />".$output_is."<br /><strong>Wholesales Issue List</strong><br />".$output_ws."<br /><strong>VoBB Issue List</strong><br />".$output_vobb."<br /><strong>General Issue List</strong><br />".$output_gen."<br />";
		}
		catch(SoapFault $e)
		{
			if(current_user_can('manage_options')) //display full error message (witch includes the password!) only to the admin
			{
				_e('Note: This message is only displayed to admins, dont worry ;)', 'wp-mantis') . '<br /><br />'; //echo since we will produce a fatal error!
				throw $e;
			}
			else
				return sprintf(__('Fatal Exception while connecting to Mantis: %s', 'wp-mantis'), $e->getMessage());
		}
		
		return $output;
	}
	else if($atts[0] == 'roadmap' || $atts[0] == 'changelog')
	{
		extract(shortcode_atts(array('ver_id' => 0, 'proj_id' => 0, 'proj_name' => '', 'ver_name' => ''), $atts));
		//Handling of invalid combinations
		if($ver_id == 0 && $proj_id == 0 && $proj_name == '') //Easy: Noting specified, error.
			return __('Error: No version/project ID or project name specified! See Readme for details.', 'wp-mantis');
		
		if($ver_id > 0 && $proj_id > 0) //Too much information: We could prefer one, but its better to throw an error.
			return __('Error: Cannot specify both version and product ID!', 'wp-mantis');
			
		if($proj_name != '')
		{
			if($ver_id > 0)
				return __('Error: Cannot use version ID with project name. See Readme for details.', 'wp-mantis');
				
			if($proj_id > 0)
				return __('Error: Cannot specify both project name and ID', 'wp-mantis');
			//Version name is optional!
		}
		
		//Encode username and password, since they could contain an & (or other 'bad' chars)
		$mantis_user = urlencode($mantis_user);
		$mantis_password = urlencode($mantis_password);
		
		//Select the correct URL
		$http_body = "username=$mantis_user&password=$mantis_password&perm_login=0&secure_session=1&return=";
		$return_url = $atts[0] . '_page.php?';
		
		//no error checking here, because the code above will trigger an error on theese.
		if($ver_id > 0)
			$return_url .= 'version_id=' . $ver_id . '&';
		
		if($proj_id > 0)
			$return_url .= 'project_id=' . $proj_id . '&';
		
		if($ver_name != '')
			$return_url .= 'version=' . $ver_name . '&';
			
		if($proj_name != '')
			$return_url .=  'project=' . $proj_name . '&';
		
		$return_url = substr($return_url, 0, -1); //remove last &
		$http_body .= urlencode($return_url); //return url contains &
		
		$fetch_url = $mantis_base_url . 'login.php'; //The url of the login.php, wich will handle the redirecting stuff
		
		//snoopy is deprecated, but the HTTP API is buggy, so we suppress the Warning with the at.
		@require_once(ABSPATH . 'wp-includes/class-snoopy.php');
		$snoopy = new Snoopy();
		
		if(!$snoopy->fetch($fetch_url . '?' . $http_body))
		{
			//Error!
			return __('Error in Snoopy: %s', $snoopy->error);
		}
		$content = $snoopy->results;
		
		$tt = strstrb(strstr($content, '<tt>'), '</tt>') . '</tt>'; //closing tag is cut of
		
		if(strlen($tt) < 5) //nothing found, </tt> is ever present!
			return __('Error while fetching the page from Mantis. The page we got seem no to be a changelog or roadmap.', 'wp-mantis');
		
		//Remove all Links
		$tt = wpmantis_strip_only($tt, 'a');
		$tt = preg_replace('#<span class="bracket-link">.*<\/span>#isU', '', $tt);
		$output = '<p class="mantis_roadmap">';
		$output .= $tt;
		$output .= '</p>';

		return $output;
	}
	else
		return __('Error: No Mode selected.', 'wp-mantis');
}

//Helper: Emulate strstr with before_needle on old PHP Versions
function strstrb($h,$n){
    return array_shift(explode($n,$h,2));
}

//Helper: Strip out HTML tags
function wpmantis_strip_only($str, $tags, $stripContent = false)
{
    $content = '';
    if(!is_array($tags)) {
        $tags = (strpos($str, '>') !== false ? explode('>', str_replace('<', '', $tags)) : array($tags));
        if(end($tags) == '') array_pop($tags);
    }
    foreach($tags as $tag) {
        if ($stripContent)
             $content = '(.+</'.$tag.'[^>]*>|)';
         $str = preg_replace('#</?'.$tag.'[^>]*>'.$content.'#is', '', $str);
    }
    return $str;
}

// Custom custom_shorten_text function
function custom_shorten_text($string, $wordreturned)
{
 
	$retval=$string;
	$array = explode(" ", $string);
	if (count($array)<=$wordreturned) {
		$retval = $string;
	} else{
		array_splice($array, $wordreturned);
		$retval = implode(" ", $array)."...";
	}
	
	return $retval;
}
?>
