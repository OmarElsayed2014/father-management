$(document).ready(function () {
    
    $("#fixed").hide();
    $("#percentage").hide();
    
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
       
       $("#total input").val(total);
   });
   
   $("#percentage input").keyup(function () {
       if(checkEmptyPrice(this)) {
           return false;
       }
       
       var profitPercentage = parseInt($(this).val());
       var price = parseInt($("#price input").val());
       
       var total = price + (profitPercentage * price / 100);
       
       $("#total input").val(total);
   });

});

function checkEmptyPrice(elem) {
    if($("#price input").val().length === 0 ) {
        alert("لابد من ادخال قيمة الشراء اولا");
        
        return true;
    }
    else {
        if(elem)
            if($(elem).val().length === 0)
                return true;
    }
}



