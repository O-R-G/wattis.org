// globals
// requires newsItem[] set elsewhere
newsCounter = 0;

function animateNewsTicker(thisnewsItem)
{	
	if(thisnewsItem == null)
	{ 
		thisNewsItem = "Sorry, no news *now.*";
	}

	// rewrite innerhtml
	thisinnerhtml = "<span id='news-item'>";
	thisinnerhtml += thisnewsItem;
	thisinnerhtml += "</span>";
	document.getElementById("news").innerHTML = thisinnerhtml;

	// increment pointer 
	if(newsCounter >= newsItem.length - 1) 
	{
		newsCounter = 0;
	} 
	else 
	{	
		newsCounter++;
	}

	// set timeout
	// scope issue *fix*
	var tt = setTimeout("animateNewsTicker(newsItem[newsCounter])", 3000);
}
