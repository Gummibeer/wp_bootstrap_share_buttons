<?php
/**
 * @package:	wp_bootstrap
 * @subpackage:	share_buttons
 * @author:	Gummibeer <dev.gummibeer@gmail.com>
 * @link:	https://github.com/Gummibeer
 * @copyright:	Copyright (c) 2015, Tom Witkowski
 * @license:	http://www.gnu.org/licenses/gpl-3.0.html GNU GPL v3
 * @version:	v1.1
 */
?>

<?php
/**
 * List of Colors for CSS: http://brandcolors.net
 * List of Links: https://github.com/bradvin/social-share-urls
 *
 * buffer	http://bufferapp.com/add?text={title}&url={url}
 * delicious	https://delicious.com/save?v=5&provider={provider}&noui&jump=close&url={url}&title={title}
 * digg		http://digg.com/submit?url={url}&title={title}
 * facebook	http://www.facebook.com/sharer.php?u={url}
 * google	https://plus.google.com/share?url={url}
 * linkedin	http://www.linkedin.com/shareArticle?url={url}&title={title}
 * pinterest	https://pinterest.com/pin/create/bookmarklet/?media={img}&url={url}&is_video={is_video}&description={title}
 * reddit	http://reddit.com/submit?url={url}&title={title}
 * stumbleupon	http://www.stumbleupon.com/submit?url={url}&title={title}
 * tumblr	http://www.tumblr.com/share/link?url={url}&name={title}&description={desc}
 * twitter	https://twitter.com/share?url={url}&text={title}&via={via}&hashtags={hashtags}
 * xing		https://www.xing.com/spi/shares/new?url={url}
 *
 * default Parameters:
 * {url}    	The url you want to share (encoded)
 * {title}	The page title of the url you want to share
 * {desc}	A longer description of the content you are sharing
 *
 * custom Parameters:
 * {img}	The image/thumbnail to use when sharing
 * {via}    	optional Twitter username of content author (don't include "@")
 * {hashtags}	optional Hashtags appended onto the tweet (comma separated. don't include "#")
 * {provider}	Company who is sharing the url
 * {is_video}	If the content is a video or not
 */

// enter your social-media services
$services = [
	'facebook'	=> 'https://facebook.com/sharer.php?u={url}',
	'twitter'	=> 'https://twitter.com/intent/tweet?text={title}&url={url}',
	'google'	=> 'https://plus.google.com/share?url={url}',
	'pinterest'	=> 'http://pinterest.com/pin/create/button/?description={title}&url={url}',
	'linkedin'	=> 'https://linkedin.com/shareArticle?mini=true&title={title}&url={url}',
	'xing'		=> 'https://xing.com/spi/shares/new?url={url}',
];

$parameters = [
	// enter your custom parameters
	// or overwrite the default parameters
];

// change the default settings
$settings = [
	'text'		=> 'auf {sm} teilen',	// string
	'uc_sm'		=> true,		// boolean
	'uc_words'	=> false,		// boolean
	'iconset'	=> false,		// false || fa || whhg || custom icon set
	'display'	=> 'text'		// text || icon || both
];

$iconsets = [
	// enter your custom iconsets
];

/*
 |--------------------------------------------------------------------------
 | That's all, stop editing! Happy blogging.
 |--------------------------------------------------------------------------
 */
?>
<ul id="share" class="list-unstyled row">
	<?php
	// defaults
	$iconsets['fa'] = [
		'delicious'	=> 'fa fa-delicious',
		'digg'		=> 'fa fa-digg',
		'facebook'	=> 'fa fa-facebook',
		'google'	=> 'fa fa-google-plus',
		'linkedin'	=> 'fa fa-linkedin',
		'pinterest'	=> 'fa fa-pinterest',
		'reddit'	=> 'fa fa-reddit',
		'stumbleupon'	=> 'fa fa-stumbleupon',
		'tumblr'	=> 'fa fa-tumblr',
		'twitter'	=> 'fa fa-twitter',
		'xing'		=> 'fa fa-xing',
	];
	$iconsets['whhg'] = [
		'delicious'	=> 'icon-delicious',
		'digg'		=> 'icon-digg',
		'facebook'	=> 'icon-facebook',
		'google'	=> 'icon-googleplus',
		'linkedin'	=> 'icon-linkedin',
		'pinterest'	=> 'icon-pinterest',
		'reddit'	=> 'icon-reddit',
		'stumbleupon'	=> 'icon-stumbleupon',
		'tumblr'	=> 'icon-tumblr',
		'twitter'	=> 'icon-twitter',
	];
	$parameters['url'] = isset($parameters['url']) ? $parameters['url'] : urlencode( get_permalink() );
	$parameters['title'] = isset($parameters['title']) ? $parameters['title'] : urlencode( get_the_title() );
	$parameters['desc'] = isset($parameters['desc']) ? $parameters['desc'] : urlencode( get_the_excerpt() );

	if($settings['iconset'] != false && isset($iconsets[$settings['iconset']]) && is_array($iconsets[$settings['iconset']])) {
		$iconset = $iconsets[$settings['iconset']];
	} else {
		$iconset = false;
	}
	$i = 0;
	$return = '';
	foreach($services as $service => $url) {
		$service = strtolower($service);
		$plattform = $service;
		if($settings['uc_sm']) {
			$plattform = ucfirst($plattform);
		}
		$text = str_replace('{sm}', $plattform, $settings['text']);
		if($settings['uc_words']) {
			$text = ucwords($text);
		}
		$icon = '';
		if($iconset != false && is_array($iconset) && isset($iconset[$service])) {
			$icon = '<i class="' . $iconset[$service] . '"></i>';
		}
		$content = '';
		if($settings['display'] == 'icon' || $settings['display'] == 'both') {
			$content .= $icon . ' ';
		}
		if($settings['display'] == 'text' || $settings['display'] == 'both') {
			$content .= '<span>'.$text.'</span>';
		}
		$link = '<a href="'.preg_replace("|{(\w*)}|e", '$parameters["$1"]', $url).'" class="btn btn-default btn-block btn-'.$service.'" target="_blank">'.$content.'</a>';
		if($i < 3) {
			if($i == 0 || count($services) == 3) {
				$return .= '<li class="col-md-4">';
			} else {
				$return .= '<li class="col-md-3">';
			}
		} elseif($i == 3) {
			$return .= '<li class="col-md-2">';
			$return .= '<div class="dropdown"><span class="btn btn-default btn-block dropdown-toggle" data-toggle="dropdown" aria-expanded="false">mehr <span class="caret"></span></span><ul class="dropdown-menu" role="menu">';
			$return .= '<li>';
		} elseif($i < count($services)) {
			$return .= '<li>';
		}
		$return .= $link;
		$return .= '</li>';
		if($i == count($services)-1) {
			$return .= '</ul></div>';
		}
		$i++;
	}
	echo $return;
	?>
</ul>
