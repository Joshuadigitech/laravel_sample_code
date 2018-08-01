var id=$("#task_id").val();
(function blink() {
$('#warning').fadeOut(7000).fadeIn(10, blink);
})();
 $("#play").click(function(){    
     $("#play").attr("disabled",true);
     $("#pause").attr("disabled",false);
     $("#stop").attr("disabled",false);
     $.ajax({
        url: "../../addStartTime",
        type: 'POST',
        cache: false,
        dataType: 'JSON',
        data: {
            'task_id':id,            
            'is_break':0,            
        },
        success: function(result)
        {
            if(result.success){            
            }else{
                alert("Error!! Some thing wrong");
            }
        }
    });

 });
 $("#pause").click(function(){
    if($("#pause").text()=='Break'){
       $("#pause").text("Continue to Task");
       $("#stop").attr("disabled",true);
       $.ajax({
        url: "../../Pause",
        type: 'POST',
        cache: false,
        dataType: 'JSON',
        data: {
            'task_id':id,           
            'is_break':1,           
        },
        success: function(result){
            if(result.success){
                 $("#warning").text("If you are back. Please Continue to task.");
            }else{
                alert("Error!! Some thing wrong");
            }
        }
    });
   } else {
       $("#pause").text("Break");
       $("#stop").attr("disabled",false);
       $.ajax({
        url: "../../Resume",
        type: 'POST',
        cache: false,
        dataType: 'JSON',
        data: {
            'task_id':id,        
            'is_break':1,
        },
        success: function(result){
            if(result.success){
                $("#warning").text(" ");           
            }else{
                alert("Error!! Some thing wrong");
            }
        }
    });
   }
});
$("#stop").click(function(){
    swal({
        title: "Are you sure?",
        text: "If You close the Task, Then You will not be able to start Task in today date.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Close it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $("#play").attr("disabled",true);
        $("#pause").attr("disabled",true);
        $("#stop").attr("disabled",true);
        $.ajax({
            url: "../../EndTime",
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            data: {
                'task_id':id,
            },
            success: function(result){
                if(result.success){
                    swal("Done!", "The task was succesfully ended");
                }else{
                    swal("Error Stopping!", result.msg, "error");
                }
            }
        });
    });
});


$( '#form-ajax' ).submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        url: "../../Comment",
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(result){
            if(result.success){
                if($("#lastRecode").val()==0) {
                    $("#lastRecode").val(result.lastRecode);
                   // alert($("#lastRecode").val());
                    $("#chatBody").html(result.msg);
                } 
                $("#description").val('');
                $("#scrollDiv").animate({ scrollTop: $('#scrollDiv').height()+999999}, 1000);
            }else{
                alert("Error!! Some thing wrong");
            }
        }
    });
});


var t = 3000;
$(function poll(){
    //this makes the setTimeout a self run function it runs the first time always
    //alert($("#lastRecode").val());
    setTimeout(function(){
        $.ajax({
            url: "../../commentsData",
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            data: {
            'task_id':id,
            'lastRecode':$("#lastRecode").val(),
            },
            success: function(result){
                if(result.success){
                    if($("#lastRecode").val()==0)
                    {
                        $("#chatBody").html(result.msg);
                    }
                    else                    
                    $("#chatBody").append(result.msg);
                    $("#lastRecode").val(result.lastRecode);
                   // alert('update in xyz');
                    $("#scrollDiv").animate({ scrollTop: $('#scrollDiv').height()+999999}, 1000);
                }else{
                //alert("Error!! Some thing wrong");
                }
            },
            //this is where you call the function again so when ajax complete it will cal itself after the time out you set.
            complete: poll
        });
        //end setTimeout and ajax
    },t);
    //end poll function
});

    //Document 
    $(document).ready(function () {
        $("#scrollDiv").animate({ scrollTop: $('#scrollDiv').height()+9999}, 1000);
        $('#register__Requests').dataTable();
        $('#approved__Requests').dataTable();
        $('#Deleted__User').dataTable();
        $(".click-able").click(function() {window.location = $(this).data("href");});
        $.ajax({
            url: "../../currentStatus",
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            data: {
                'task_id':id,                    
            },
            success: function(result){
                if(result.success)
                {
                    if(result.msg==='1'){
                            //break state
                        $("#warning").text("Break ");
                        $("#play").attr("disabled",true);
                        $("#pause").attr("disabled",false);
                        $("#pause").text("Continue to Task");
                        $("#stop").attr("disabled",true);
                        $("#warning").text("If You are back. Please click to 'Continue to Task'");
                    } else if(result.msg==='2') {
                        //task not started
                        $("#play").attr("disabled",true);
                        $("#pause").attr("disabled",false);
                        $("#pause").text("Break");
                        $("#stop").attr("disabled",false);
                    } else if(result.msg==='3') {
                        //task not started
                        $("#play").attr("disabled",true);
                        $("#pause").attr("disabled",true);
                        $("#info").text("You have done your today work");
                        $("#pause").text("Break");
                        $("#stop").attr("disabled",true);
                    } else {
                        //working state
                        $("#play").attr("disabled",false);
                        $("#pause").attr("disabled",true);
                        $("#pause").text("Break");
                        $("#stop").attr("disabled",true);
                    }
                } else {
                    alert("Error!! Some thing wrong");
                }
            }
        });
        //end documet.ready funtion    
    });
