// implement infinite scrolling via ajax
var page = 1;
var isWaiting = false;
window.onscroll = function(ev) 
{
	var scrollTop = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
	// make this so that it is *before* scrolled 
	// all the way to the bottom of the page
	var scrolledToBottom = (scrollTop + window.innerHeight) >= document.body.scrollHeight;
	if(!isWaiting && scrolledToBottom)
	{
	   	loadMore();
	   	console.log("bottom");
    }
};

function loadMore() {
	isWaiting = true;
	if(window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() 
	{
		if(xmlhttp.readyState < 4) 
		{
			// start loading animation
			// startLoad();
			console.log("waiting");
		}
		else if(xmlhttp.readyState == 4 && xmlhttp.status == 200) 
		{
			// stop loading animation
			// stopLoad();
			if(xmlhttp.responseText)
			{
				// console.log('xmlhttp.responseText = '+xmlhttp.responseText);
				var response = JSON.parse(xmlhttp.responseText);
				if(response.length != 0)
				{
					console.log(response);
					document.querySelector(".homeContainer").innerHTML += response['this_html'];
					fetched_ids_arr = response['current_fetched_ids_arr'];
				}
				else
					isFullyLoaded = true;
				isWaiting = false;
			}
			else
			{
				// no more posts to load
				// 'done' animation
				// animate(68);
			}
		}
	}
	var fetched_ids_arr_str = '[' + fetched_ids_arr.join(',') + ']';

	var requestUrl = "views/random-ajax.php";
	/*
    if(isRandom)
		requestUrl += "?random";
    */

	xmlhttp.open("POST", requestUrl, true);
	// xmlhttp.setRequestHeader( "Content-Type", "application/json" );
	xmlhttp.send(fetched_ids_arr_str);
}
