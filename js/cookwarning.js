/////////////////////////////////////////////////////////////
//
// Author Point Blank (www.pointblank.ie)
//
// Version History 
// 1 (16-April-2013) Inital release on to GitHub.
//

//use this to include in file:
//wordpress (in header.php)  - <script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/cookiewarning.js"></script>
//regular site - <script type="text/javascript" src="/js/cookiewarning.js"></script>



function getCookie(c_name)
{
var i,x,y,ARRcookies=document.cookie.split(";");
for (i=0;i<ARRcookies.length;i++)
  {
  x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
  y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
  x=x.replace(/^\s+|\s+$/g,"");
  if (x==c_name)
    {
    return unescape(y);
    }
  }
}


function displayNotification()
{




// this sets the page background to semi-transparent black should work with all browsers
var message = "<div id='cookiewarning' style='background-color:#ffffff;'>";


    

message = message + "<div class='container alert' style='background-color:#ffffff;margin:0px auto;text-align:center;padding:6px;'>";

// this is the message displayed to the user.
message = message + "<strong>This site uses cookies.</strong> You can read how we use them in our <a href='/privacy-policy' title='Privacy Policy'>privacy policy</a> <INPUT class='btn' TYPE='button' VALUE='Accept' onClick='JavaScript:setCookie(\"jsCookieCheck\",null,365);' />";
	
  //message = message + "<strong>This site uses cookies.</strong> You can read how we use them in our <a href='#' onclick='alert(\"In order for this site to work correctly, and for us to improve the site we need to store a small file (called a cookie) on your computer. For more information on cookies visit aboutcookies.org. Almost every site in the world does this, however since the 25th of May 2011, by EU law we have to get your permission first.\");'   title='Privacy Policy'>privacy policy</a> <INPUT class='btn' TYPE='button' VALUE='Accept' onClick='JavaScript:setCookie(\"jsCookieCheck\",null,365);' />";
  

// and this closes everything off.
message = message + "</div></div>";


document.writeln(message);


}

function setCookie(c_name,value,exdays)
{
var exdate=new Date();
exdate.setDate(exdate.getDate() + exdays);
var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
document.cookie=c_name + "=" + c_value;

// set cookiewarning to hidden.
var cw = document.getElementById("cookiewarning");
cw.innerHTML = "";
}

function checkCookie()
{

var cookieName="jsCookieCheck";
var cookieChk=getCookie(cookieName);
if (cookieChk!=null && cookieChk!="")
  {
  // the jsCookieCheck cookie exists so we can assume the person has read the notification
  // within the last year
  
  setCookie(cookieName,cookieChk,365);	// set the cookie to expire in a year.
  }
else 
  {
  // No cookie exists, so display the lightbox effect notification.
  displayNotification();	
  }
}

checkCookie();
