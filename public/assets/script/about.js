$(document).ready(function(e) {


// $("p").hide();
$("a").prev().hide();


$("a").click(function(e) {
  


    if($ (this).prev().is(":hidden")) {
            $(this).text("Moins")
    } 
    else{
            $(this).text("Lire la suite")
    }

    $(this).prev().toggle("slow"); 
    });



});