      <script src="{{ asset ('assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset ('assets/js/popper.min.js') }}"></script>
      <script src="{{ asset ('assets/js/bootstrap.min.js') }}"></script>  
      <script type="text/javascript">
      	$(".collapseIcons").on("click",function() {

      		$(".main-panel .sidebar").toggleClass("sideNavShort");
      		if ($(".main-panel .sidebar").hasClass("sideNavShort"))

      		 {
      		 	$(".logoChangeAble").attr("src","{{asset('assets/img/logoSmall.png')}}").css("margin-top","50px");
      		 	$(".main-panel .sidebar .collapseIcons").css("right","11px");
      		 	// $(".logoChangeAble")
      		 	
      		 }
      		 else
      		 {
      		 	$(".logoChangeAble").attr("src","{{asset('assets/img/logo.png')}}").css("margin-top","0px");;
      		 	$(".main-panel .sidebar .collapseIcons").css("right","-25px");
      		 }
      		
      	});
            if (window.innerWidth < 1220) 
            {
                $(".main-panel .sidebar").addClass("sideNavShort");  
                $(".logoChangeAble").attr("src","{{asset('assets/img/logoSmall.png')}}").css("margin-top","50px");
            }
           
      </script>