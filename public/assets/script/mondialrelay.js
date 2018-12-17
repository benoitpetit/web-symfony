




!function(){
	// Parametre du widget
  $(document).ready(function () { 
    $("#Zone_Widget").trigger("MR_RebindMap")   
    $("#Zone_Widget").MR_ParcelShopPicker({  
      Target: "#ParcelShopCode",
      Brand: "BDTEST  ",
      Responsive: true,
      Country: "FR" 
    });  
  });
}();