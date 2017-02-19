/* Author:
 Ryan Graham
*/

twitter1=new Image(50,50);
twitter1.src="./img/twitter1.png";
twitter2=new Image(50,50);
twitter2.src="./img/twitter2.png";
fb1=new Image(50,50);
fb1.src="./img/fb1.png";
fb2=new Image(50,50);
fb2.src="./img/fb2.png";
email1=new Image(50,50);
email1.src="./img/email1.png";
email2=new Image(50,50);
email2.src="./img/email2.png";

$(document).ready(function(){
$("a").each(function()
 {
  $(this).attr("target","_blank");
  });
});

