$(document).ready(function()
{
	function getPageName(url) {
	    var index = url.lastIndexOf("/") + 1;
	    var filenameWithExtension = url.substr(index);
	    var filename = filenameWithExtension.split(".")[0]; // <-- added this line
	    return filename;                                    // <-- added this line
	}

	function addActive()
	{
		var currurl = window.location.pathname;
		var li = 'li#li-'+getPageName(currurl);
		$(li).addClass("active");
	}
	addActive();
});