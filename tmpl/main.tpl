<!DOCTYPE html PUBLIC "//-W3C//DTD XHTML 1.1//EN" "http://www.w3.org./TR/xhtml1.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>%title%</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="%meta_desc%" />
	<meta name="keywords" content="%meta_key%" />
	<link rel="stylesheet" href="%address%css/main.css" type="text/css" />
</head>
<body>

     <div id="content">
	   <div id="header">
	   <img src="images/header.jpg" alt="header" />
	   </div>
	 </div>
	 <hr />
	 <div id="main_content">
	      <div id="left">
		     <h2>Menu</h2>
			 <ul>%menu%</ul>
			 %auth_user%			 
		  </div>
		  <div id="right">
		      <form name="search" action="%address%" method="get">
			     <p class="s">
				     Search: <input type="text" name="words" />
				 </p>
				 <p>
				    <input type="hidden" name="view" value="search" />
				    <input type="submit" name="search" value="Find out" />
				 </p>
			  </form>
			  <h2>Реклама</h2>
			  %banners%
			  %poll%
		  </div>
		  <div id="center">
		      %top%
			  %middle%
			  %bottom%
		  </div>
		  <div class="clear"></div>
		  <hr />
		  <div id="footer">
		      <p>Все права защищены &copy; 2019</p>
		  </div>
	 </div>
</body>
</html>