$("a.commentlink").attr("data-disqus-identifier", function() {
	 return this.rel;
});
$("a.commentlink").removeAttr("rel");