$(document).ready(function () {
    
    $("#fixed").hide();
    $("#percentage").hide();
    $("#monthly").hide();
    $("#poundly").hide();
    $("#cart-holder-area").hide();
    
   $("input[name=calc-way]").change(function () {
       
       if(checkEmptyPrice(false)) {
            $(this).prop( "checked", false );
            return false;
        }
       
       var calc = $(this).val();
       
       if( calc === "fixed") {
            $("#fixed").show();
            $("#percentage").hide();
            $("#percentage input").val("");
            $("#total input").attr('disabled','disabled');
       }
       else if( calc === "percentage" ) {
            $("#percentage").show();
            $("#fixed").hide();
            $("#fixed input").val("");
            $("#total input").attr('disabled','disabled');
       }
       else {
            $("#fixed input").val("");
            $("#percentage input").val("");
            $("#fixed").hide();
            $("#percentage").hide();
            $("#total input").removeAttr('disabled');
       }
   });
   
   $("#fixed input").keyup(function () {
       if(checkEmptyPrice(this))
           return false;
       
       var profit = parseInt($(this).val());
       var price = parseInt($("#price input").val());
       
       var total = price + profit;
       
       $("#total input").val(Math.round(total));
   });
   
   $("#percentage input").keyup(function () {
       if(checkEmptyPrice(this)) {
           return false;
       }
       
       var profitPercentage = parseInt($(this).val());
       var price = parseInt($("#price input").val());
       
       var total = price + (profitPercentage * price / 100);
       
       $("#total input").val(Math.round(total));
   });
   
    $("#price input").keyup(function () {
       $("#total input").val("");
       $("#percentage input").val("");
       $("#fixed input").val("");
   });
   
   $("input[name=price-way]").change(function () {
       if($("#total input").val() === "") {
           alert("لابد من ادخال طريقة حساب الفائدة اولا");
           $(this).prop( "checked", false );
           return false;
       }
       
       var calc = $(this).val();
       
       if( calc === "fixed") {
            $("#poundly").show();
            $("#monthly").hide();
            $("#monthly input").val("");
       }
       else if( calc === "percentage" ) {
            $("#monthly").show();
            $("#poundly").hide();
            $("#poundly input").val("");
       }
       else {
            $("#monthly input").val("");
            $("#poundly input").val("");
            $("#monthly").hide();
            $("#poundly").hide();
       }
            
   });
   
   $("#monthly input").keyup(function() {
       if( !$("#cart-holder").hasClass("animated")) {
            $("#cart-holder").addClass("animated");
            $("#cart-holder-area").show();
            $("#cart-holder").parent().css("cursor", "all-scroll");
       }
       
   });
   
   $("#cart-holder").click(function() {
       if($(this).hasClass("animated")) {
           $(this).hide();
           $(this).siblings().hide();
           
           showTable();
       }
   });
   
   
   

});

function checkEmptyPrice(elem) {
    if($("#price input").val().length === 0 ) {
        alert("لابد من ادخال قيمة الشراء اولا");
        
        return true;
    }
    
    if(elem) {
        if($(elem).val() === "") {
            $("#total input").val("");
            return true;
        }
    }
}

function showTable() {
    var holder = $("#cart-holder").parent();
    
    $(holder).html("Bokra hkamel isa");
}



