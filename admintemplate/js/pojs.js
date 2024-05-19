
(function ($) {
  // USE STRICT
  "use strict";
$(document).ready(function() {
	
	if ($("#unit2").attr('value')==''){
  		$("#row2").hide();
 	}
	if ($("#unit3").attr('value')==''){
  		$("#row3").hide();
 	}
	if ($("#unit4").attr('value')==''){
  		$("#row4").hide();
 	}
	if ($("#unit5").attr('value')==''){
  		$("#row5").hide();
 	}
	
	$("#add1").click(function(){
		$("#row2").show();
	});
	$("#add2").click(function(){
		$("#row3").show();
	});
	$("#add3").click(function(){
		$("#row4").show();
	});
	$("#add4").click(function(){
		$("#row5").show();
	});
	$("#add5").click(function(){
		$("#row6").show();
	});
	$("#add6").click(function(){
		$("#row7").show();
	});
	$("#add7").click(function(){
		$("#row8").show();
	});
	$("#add8").click(function(){
		$("#row9").show();
	});
	$("#add9").click(function(){
		$("#row10").show();
	});
	$("#del1").click(function(){
		$("#row1").hide();
		document.getElementById("work1").value="";
		document.getElementById("cat1").value="";
		document.getElementById("unit1").value="";
		document.getElementById("qty1").value="";
		document.getElementById("rate1").value="";
		document.getElementById("amt1").value="";
		document.getElementById("rem1").value="";
	});
	$("#del2").click(function(){
		$("#row2").hide();
		
		var amt2=$('#amt2').val();
		var total=$('#total').val();
		if(amt2==""){amt2=0;}
		$("#total").val(parseFloat(total)-parseFloat(amt2));
		document.getElementById("work2").value="";
		document.getElementById("cat2").value="";
		document.getElementById("unit2").value="";
		document.getElementById("qty2").value="";
		document.getElementById("rate2").value="";
		document.getElementById("amt2").value="";
		document.getElementById("rem2").value="";
		
	});
	$("#del3").click(function(){
		$("#row3").hide();
		var amt3=$('#amt3').val();
		var total=$('#total').val();
		if(amt3==""){amt3=0;}
		$("#total").val(parseFloat(total)-parseFloat(amt3));
		document.getElementById("work3").value="";
		document.getElementById("cat3").value="";
		document.getElementById("unit3").value="";
		document.getElementById("qty3").value="";
		document.getElementById("rate3").value="";
		document.getElementById("amt3").value="";
		document.getElementById("rem3").value="";
	});
	$("#del4").click(function(){
		$("#row4").hide();
		var amt4=$('#amt4').val();
		var total=$('#total').val();
		if(amt4==""){amt4=0;}
		$("#total").val(parseFloat(total)-parseFloat(amt2));
		document.getElementById("work4").value="";
		document.getElementById("cat4").value="";
		document.getElementById("unit4").value="";
		document.getElementById("qty4").value="";
		document.getElementById("rate4").value="";
		document.getElementById("amt4").value="";
		document.getElementById("rem4").value="";
	});
	$("#del5").click(function(){
		$("#row5").hide();
		var amt5=$('#amt5').val();
		var total=$('#total').val();
		if(amt5==""){amt5=0;}
		$("#total").val(parseFloat(total)-parseFloat(amt5));
		document.getElementById("work5").value="";
		document.getElementById("cat5").value="";
		document.getElementById("unit5").value="";
		document.getElementById("qty5").value="";
		document.getElementById("rate5").value="";
		document.getElementById("amt5").value="";
		document.getElementById("rem5").value="";
	});
	$("#del6").click(function(){
		$("#row6").hide();
		var amt6=$('#amt6').val();
		var total=$('#total').val();
		if(amt6==""){amt6=0;}
		$("#total").val(parseFloat(total)-parseFloat(amt6));
		document.getElementById("work6").value="";
		document.getElementById("cat6").value="";
		document.getElementById("unit6").value="";
		document.getElementById("qty6").value="";
		document.getElementById("rate6").value="";
		document.getElementById("amt6").value="";
		document.getElementById("rem6").value="";
	});
	$("#del7").click(function(){
		$("#row7").hide();
		var amt7=$('#amt7').val();
		var total=$('#total').val();
		if(amt7==""){amt7=0;}
		$("#total").val(parseFloat(total)-parseFloat(amt2));
		document.getElementById("work7").value="";
		document.getElementById("cat7").value="";
		document.getElementById("unit7").value="";
		document.getElementById("qty7").value="";
		document.getElementById("rate7").value="";
		document.getElementById("amt7").value="";
		document.getElementById("rem7").value="";
	});
	$("#del8").click(function(){
		$("#row8").hide();
		var amt8=$('#amt8').val();
		var total=$('#total').val();
		if(amt8==""){amt8=0;}
		$("#total").val(parseFloat(total)-parseFloat(amt8));
		document.getElementById("work8").value="";
		document.getElementById("cat8").value="";
		document.getElementById("unit8").value="";
		document.getElementById("qty8").value="";
		document.getElementById("rate8").value="";
		document.getElementById("amt8").value="";
		document.getElementById("rem8").value="";
	});
	$("#del9").click(function(){
		$("#row9").hide();
		var amt9=$('#amt9').val();
		var total=$('#total').val();
		if(amt9==""){amt9=0;}
		$("#total").val(parseFloat(total)-parseFloat(amt9));
		document.getElementById("work9").value="";
		document.getElementById("cat9").value="";
		document.getElementById("unit9").value="";
		document.getElementById("qty9").value="";
		document.getElementById("rate9").value="";
		document.getElementById("amt9").value="";
		document.getElementById("rem9").value="";
	});
	$("#del10").click(function(){
		$("#row10").hide();
		var amt10=$('#amt10').val();
		var total=$('#total').val();
		if(amt10==""){amt10=0;}
		$("#total").val(parseFloat(total)-parseFloat(amt10));
		document.getElementById("work10").value="";
		document.getElementById("cat10").value="";
		document.getElementById("unit10").value="";
		document.getElementById("qty10").value="";
		document.getElementById("rate10").value="";
		document.getElementById("amt10").value="";
		document.getElementById("rem10").value="";
	});
	$("#rate1").keyup(function(){
		var qty1=$('#qty1').val();
		var rate1=$('#rate1').val();
		if(rate1==""){
		rate1=0;
		}
		$("#amt1").val(parseFloat(qty1)*parseFloat(rate1));
		var amt1=$('#amt1').val();
		$("#total").val(amt1);
	});
	$("#rate2").keyup(function(){
		var qty2=$('#qty2').val();
		var rate2=$('#rate2').val();
		if(rate2==""){
		rate2=0;
		}
		$("#amt2").val(parseFloat(qty2)*parseFloat(rate2));
		var amt1=$('#amt1').val();
		var amt2=$('#amt2').val();
		$("#total").val(parseFloat(amt1)+parseFloat(amt2));
	});
	$("#rate3").keyup(function(){
		var qty3=$('#qty3').val();
		var rate3=$('#rate3').val();
		if(rate3==""){
		rate3=0;
		}
		$("#amt3").val(parseFloat(qty3)*parseFloat(rate3));
		var amt1=$('#amt1').val();
		var amt2=$('#amt2').val();
		var amt3=$('#amt3').val();
		$("#total").val(parseFloat(amt1)+parseFloat(amt2)+parseFloat(amt3));
	});
	$("#rate4").keyup(function(){
		var qty4=$('#qty4').val();
		var rate4=$('#rate4').val();
		if(rate4==""){
		rate4=0;
		}
		$("#amt4").val(parseFloat(qty4)*parseFloat(rate4));
		var amt1=$('#amt1').val();
		var amt2=$('#amt2').val();
		var amt3=$('#amt3').val();
		var amt4=$('#amt4').val();
		$("#total").val(parseFloat(amt1)+parseFloat(amt2)+parseFloat(amt3)+parseFloat(amt4));
	});
$("#rate5").keyup(function(){
		var qty5=$('#qty5').val();
		var rate5=$('#rate5').val();
		if(rate5==""){
		rate5=0;
		}
		$("#amt5").val(parseFloat(qty5)*parseFloat(rate5));
		var amt1=$('#amt1').val();
		var amt2=$('#amt2').val();
		var amt3=$('#amt3').val();
		var amt4=$('#amt4').val();
		var amt5=$('#amt5').val();
		$("#total").val(parseFloat(amt1)+parseFloat(amt2)+parseFloat(amt3)+parseFloat(amt4)+parseFloat(amt5));
	});
$("#rate6").keyup(function(){
		var qty6=$('#qty6').val();
		var rate6=$('#rate6').val();
		if(rate6==""){
		rate6=0;
		}
		$("#amt6").val(parseFloat(qty6)*parseFloat(rate6));
		var amt1=$('#amt1').val();
		var amt2=$('#amt2').val();
		var amt3=$('#amt3').val();
		var amt4=$('#amt4').val();
		var amt5=$('#amt5').val();
		var amt6=$('#amt6').val();
		$("#total").val(parseFloat(amt1)+parseFloat(amt2)+parseFloat(amt3)+parseFloat(amt4)+parseFloat(amt5)+parseFloat(amt6));
	});
	$("#rate7").keyup(function(){
		var qty7=$('#qty7').val();
		var rate7=$('#rate7').val();
		if(rate7==""){
		rate7=0;
		}
		$("#amt7").val(parseFloat(qty7)*parseFloat(rate7));
		var amt1=$('#amt1').val();
		var amt2=$('#amt2').val();
		var amt3=$('#amt3').val();
		var amt4=$('#amt4').val();
		var amt5=$('#amt5').val();
		var amt6=$('#amt6').val();
		var amt7=$('#amt7').val();
		$("#total").val(parseFloat(amt1)+parseFloat(amt2)+parseFloat(amt3)+parseFloat(amt4)+parseFloat(amt5)+parseFloat(amt6)+parseFloat(amt7));
	});
	$("#rate8").keyup(function(){
		var qty8=$('#qty8').val();
		var rate8=$('#rate8').val();
		if(rate8==""){
		rate8=0;
		}
		$("#amt8").val(parseFloat(qty8)*parseFloat(rate8));
		var amt1=$('#amt1').val();
		var amt2=$('#amt2').val();
		var amt3=$('#amt3').val();
		var amt4=$('#amt4').val();
		var amt5=$('#amt5').val();
		var amt6=$('#amt6').val();
		var amt7=$('#amt7').val();
		var amt8=$('#amt8').val();
		$("#total").val(parseFloat(amt1)+parseFloat(amt2)+parseFloat(amt3)+parseFloat(amt4)+parseFloat(amt5)+parseFloat(amt6)+parseFloat(amt7)+parseFloat(amt8));
	});
$("#rate9").keyup(function(){
		var qty9=$('#qty9').val();
		var rate9=$('#rate9').val();
		if(rate9==""){
		rate9=0;
		}
		$("#amt9").val(parseFloat(qty9)*parseFloat(rate9));
		var amt1=$('#amt1').val();
		var amt2=$('#amt2').val();
		var amt3=$('#amt3').val();
		var amt4=$('#amt4').val();
		var amt5=$('#amt5').val();
		var amt6=$('#amt6').val();
		var amt7=$('#amt7').val();
		var amt8=$('#amt8').val();
		var amt9=$('#amt9').val();
		
	$("#total").val(parseFloat(amt1)+parseFloat(amt2)+parseFloat(amt3)+parseFloat(amt4)+parseFloat(amt5)+parseFloat(amt6)+parseFloat(amt7)+parseFloat(amt8)+parseFloat(amt9));
	});
$("#rate10").keyup(function(){
		var qty10=$('#qty10').val();
		var rate10=$('#rate10').val();
		if(rate10==""){
		rate10=0;
		}
		$("#amt10").val(parseFloat(qty10)*parseFloat(rate10));
		var amt1=$('#amt1').val();
		var amt2=$('#amt2').val();
		var amt3=$('#amt3').val();
		var amt4=$('#amt4').val();
		var amt5=$('#amt5').val();
		var amt6=$('#amt6').val();
		var amt7=$('#amt7').val();
		var amt8=$('#amt8').val();
		var amt9=$('#amt9').val();
		var amt10=$('#amt10').val();
	$("#total").val(parseFloat(amt1)+parseFloat(amt2)+parseFloat(amt3)+parseFloat(amt4)+parseFloat(amt5)+parseFloat(amt6)+parseFloat(amt7)+parseFloat(amt8)+parseFloat(amt9)+parseFloat(amt10));
	});



	
});
})(jQuery);

  