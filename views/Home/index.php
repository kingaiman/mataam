<script src="js/jquery.slides.min.js"></script>
<script>
    $(function(){
      $("#slider").slidesjs({
	  width: 810,
        height: 348,
	  navigation: {
		  active: false,
			// [boolean] Generates next and previous buttons.
			// You can set to false and use your own buttons.
			// User defined buttons must have the following:
			// previous button: class="slidesjs-previous slidesjs-navigation"
			// next button: class="slidesjs-next slidesjs-navigation"
		  effect: "slide",
			// [string] Can be either "slide" or "fade".
		},
		pagination: {
      active: false,
        // [boolean] Create pagination items.
        // You cannot use your own pagination. Sorry.
      effect: "slide"
        // [string] Can be either "slide" or "fade".
    }
        
      });
    });
  </script>	 
  <div id="slider">						
		<img src="img/image1.jpg"/>									
		<img src="img/image2.jpeg"/>									
		<img src="img/image3.jpg"/>									
		<img src="img/image4.jpg"/>									
		<img src="img/image5.jpg"/>									
		<img src="img/image6.jpg"/>									
		<a class="slidesjs-previous slidesjs-navigation" href="#" title="Previous"><img src="img/flech_L_slide.png"/></a>
		<a class="slidesjs-next slidesjs-navigation" href="#" title="Next"><img src="img/flech_R_slide.png"/></a>			
	</div>	