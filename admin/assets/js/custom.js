
$("#biller_number").change(function(){
    var biller_id=$(this).val();
    var amount=$("amount").val();

    $.ajax({
        method: "POST",
        url: "data.php",
        data: {biller_id:biller_id},
        success:function(data){
            $(".sub_select").html(data)
        }
    });

    $.ajax({
        method: "POST",
        url: "data.php",
        data: {amount:amobunt},
        success:function(data){
            $(".sub_select").html(data)
        }
    });

});


$("#billAccountNo").change(function(){
    var id=$(this).val();
    var amount=$("amount").val();

    $.ajax({
        method: "POST",
        url: "data.php",
        data: {id:id},
        success:function(data){
            $(".idName").html(data)
        }
    });
});

