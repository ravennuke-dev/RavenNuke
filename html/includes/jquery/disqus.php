<?php
if (!defined('NUKE_FILE')) die ('You cannot access this file directly...');
// DISQUS COMMENTS 
// $ds = disqus_shortname tells Disqus which website account (called a forum on Disqus) this system belongs to
// $did = disqus_identifier tells Disqus how to uniquely identify the current page
// $durl = disqus_url tells Disqus the location of the page for permalinking purposes: i.e. http://example.com/permalink-to-page.html
if(!function_exists('disqus')) {
	function disqus($ds, $did, $durl) {
		static $disqus_commentz;
		if (isset($disqus_commentz)) return;
		if (!preg_match('/[^0-9A-Za-z-]/',$ds)){
	$dComments = '<div id="disqus_thread"></div>
	<script type="text/javascript">
		//<![CDATA[
		var disqus_shortname = \''.$ds.'\';
		var disqus_identifier = \''.$did.'\';
		var disqus_url = \''.$durl.'\';
		(function() {
			var dsq = document.createElement(\'script\'); dsq.type = \'text/javascript\'; dsq.async = true;
			dsq.src = \'http://\' + disqus_shortname + \'.disqus.com/embed.js\';
			(document.getElementsByTagName(\'head\')[0] || document.getElementsByTagName(\'body\')[0]).appendChild(dsq);
		})();
		//]]>
	</script>
	<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
	<a href="http://disqus.com" class="dsq-brlink">Comments powered by <span class="logo-disqus">Disqus</span></a>
	';
		$disqus_commentz = 1;
		return $dComments;
	   }
	}
}
// COMMENT COUNTER
// $ds = disqus_shortname tells Disqus which website account (called a forum on Disqus) this system belongs to
if(!function_exists('disqusCounter')) {
	function disqusCounter($ds) {
		static $disqus_loaded;
		if (isset($disqus_loaded)) return;
		if (!preg_match('/[^0-9A-Za-z-]/',$ds)){
	$CCount = '<script type="text/javascript">
	var disqus_shortname = \''.$ds.'\';
	(function () {
		var s = document.createElement(\'script\'); s.async = true;
		s.type = \'text/javascript\';
		s.src = \'http://disqus.com/forums/\' + disqus_shortname + \'/count.js\';
		(document.getElementsByTagName(\'HEAD\')[0] || document.getElementsByTagName(\'BODY\')[0]).appendChild(s);
	}());
	</script>
	';
		  addJSToBody('includes/jquery/commentlink.js', 'file');
		  addJSToBody($CCount, 'inline');
		  $disqus_loaded = 1;
	   }
	}
}
// RECENT COMMENTS
// $ds = disqus_shortname tells Disqus which website account (called a forum on Disqus) this system belongs to
// $ni = number of items 1-20
// $ha = hide avatars: 0 = show avatars, 1 = hide avatars
// $as = avatar size: 24, 32, 48, 92, or 128
// $el = excerpt length: character limit to truncate at
// $st = show the recent comments title (not recommended for blocks) TRUE/FALSE
if(!function_exists('disqusRC')) {
	function disqusRC($ds, $ni, $ha, $as, $el, $st) {
		$NewThreads = '';
		if (!preg_match('/[^0-9A-Za-z-]/',$ds)){
		if ($st){
		$dTitle = '<h2 class="dsq-widget-title">Recent Comments</h2>';
		}else{
		$dTitle = '';
		}
		$NewThreads = '<div id="recentcomments" class="dsq-widget">'.$dTitle.'<script type="text/javascript" src="http://'.$ds.'.disqus.com/recent_comments_widget.js?num_items='.$ni.'&amp;hide_avatars='.$ha.'&amp;avatar_size='.$as.'&amp;excerpt_length='.$el.'"></script></div><a href="http://disqus.com/">Powered by Disqus</a>
	';
	   }
		return $NewThreads;
	}
}
// POPULAR THREADS
// $ds = disqus_shortname tells Disqus which website account (called a forum on Disqus) this system belongs to
// $mc = number of items 1-20
if(!function_exists('disqusMD')) {
	function disqusMD($ds, $mc) {
		$PopThreads = '';
		if (!preg_match('/[^0-9A-Za-z-]/',$ds)){
		$PopThreads = '<div id="popularthreads" class="dsq-widget"><script type="text/javascript" src="http://'.$ds.'.disqus.com/popular_threads_widget.js?num_items='.$mc.'"></script></div><a href="http://disqus.com/">Powered by Disqus</a>
	';
	   }
		return $PopThreads;
	}
}
// TOP COMMENTERS
// $ds = disqus_shortname tells Disqus which website account (called a forum on Disqus) this system belongs to
// $ni = number of items 1-20
// $hm = hide moderators: 0 = show moderators in ranking, 1 = hide moderators in ranking
// $ha = hide avatars: 0 = show avatars, 1 = hide avatars
// $as = avatar size: 24, 32, 48, 92, or 128

if(!function_exists('disqusTC')) {
	function disqusTC($ds, $ni, $hm, $ha, $as) {
		$TopCommenters = '';
		if (!preg_match('/[^0-9A-Za-z-]/',$ds)){
		$TopCommenters = '<div id="topcommenters" class="dsq-widget"><script type="text/javascript" src="http://'.$ds.'.disqus.com/top_commenters_widget.js?num_items='.$ni.'&amp;hide_mods='.$hm.'&amp;hide_avatars='.$ha.'&amp;avatar_size='.$as.'"></script></div><a href="http://disqus.com/">Powered by Disqus</a>
	';
	   }
		return $TopCommenters;
	}
}
// COMBINATION WIDGET
// $ds = disqus_shortname tells Disqus which website account (called a forum on Disqus) this system belongs to
// $ni = number of items 1-20
// $hm = hide moderators: 0 = show moderators in ranking, 1 = hide moderators in ranking
// $co = color: blue, grey, green, red, orange
// $dt = default_tab = people, recent, popular
// $el = excerpt length: character limit to truncate at
if(!function_exists('disqusCombo')) {
	function disqusCombo($ds, $ni, $hm, $co, $dt, $el) {
		$ComboWidget = '';
		if (!preg_match('/[^0-9A-Za-z-]/',$ds)){
		$ComboWidget = '<script type="text/javascript" src="http://'.$ds.'.disqus.com/combination_widget.js?num_items='.$ni.'&amp;hide_mods='.$hm.'&amp;color='.$co.'&amp;default_tab='.$dt.'&amp;excerpt_length='.$el.'"></script><a href="http://disqus.com/">Powered by Disqus</a>
	';
	   }
		return $ComboWidget;
	}
}

?>
