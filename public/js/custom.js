//Delete client
function deleteClient(userId , role) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "../delete_clients",
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            data: {
                'user_id':userId,
                'role': role,
            },
            success: function(result){
                if(result.success){
                    swal("Done!", "It was succesfully deleted!", "success");
                }else{
                    swal("Error deleting!", result.msg, "error");
                }
            }
        });
    });
}

//Approve Client Request
function approveClientRequest(userId , role,requestId) {
    swal({
        title: "Are you sure?",
        text: "This user will have the access of system!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#35dd13",
        confirmButtonText: "Yes, Approve it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "../approve_clients_requests",
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            data: {
                'user_id':userId,
                'role': role,
                'requestId':requestId,
            },
            success: function(result){
                if(result.success){
                    if(requestId != '0') {
                        window.location.replace("allocation/" + requestId);
                    }
                    swal("Done!", "It was succesfully approved!", "success");

                }else{
                    swal("Error approving!", result.msg, "error");
                }
            }
        });
    });
}

//Restore Client
function restoreClient(userId , role) {
    swal({
        title: "Are you sure?",
        text: "This user will have the access of system!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#35dd13",
        confirmButtonText: "Yes, Restore it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "../restore_clients",
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            data: {
                'user_id':userId,
                'role': role,
            },
            success: function(result){
                if(result.success){
                    swal("Done!", "It was succesfully restored!", "success");
                }else{
                    swal("Error approving!", result.msg, "error");
                }
            }
        });
    });
}


//Delete Allocated CM
function deleteAllocatedCM(id,PageID) {
    if(PageID==1)
    {
        pageUrl = "../../deleteAllocatedCM";
    }
    else
    {
        pageUrl = "../deleteAllocatedCM";
    }
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: pageUrl,
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            data: {
                'id':id,
            },
            success: function(result){
                if(result.success){
                    swal("Done!", "It was succesfully deleted!", "success");
                }else{
                    swal("Error deleting!", result.msg, "error");
                }
            }
        });
    });
}


//Delete Client Request
function deleteClientRequest(id) {
    swal({
        title: "Are you sure?",
        text: "You will not be able to Recover this Request",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function (isConfirm) {
        if (!isConfirm) return;
        $.ajax({
            url: "../deleteClientRequest",
            type: 'POST',
            cache: false,
            dataType: 'JSON',
            data: {
                'id':id,
            },
            success: function(result){
                if(result.success){
                    swal("Done!", "It was succesfully deleted!", "success");
                }else{
                    swal("Error deleting!", result.msg, "error");
                }
            }
        });
    });
}
function clientDetails(obj)
{

    var name=$(obj).data('fname')+' ';
    name+=$(obj).data('lname');
    $("#fname").text(name);
    $("#fname").append();
    $("#email").text($(obj).data('email'));
    $("#gender").text($(obj).data('gender'));
    $("#phone").text($(obj).data('phone'));
    // var Address=$(obj).data('address')+' '+$(obj).data('city')+' '+$(obj).data('state')+' '+$(obj).data('country');
    //  alert($(obj).data('address'));

    $("#Address").text($(obj).data('address')+' '+$(obj).data('city')+' '+$(obj).data('state')+' '+$(obj).data('country')   );
    $("#City").text($(obj).data('city'));
    $("#State").text($(obj).data('state'));
    $("#zip").text($(obj).data('zip'));
    $("#country").text($(obj).data('country'));
    $("#company_name").text($(obj).data('company_name'));
    $("#company_phone").text($(obj).data('company_phone'));
    $("#company_address").text($(obj).data('company_address'));

    $("#company_zip").text($(obj).data('company_zip'));
    $("#no_of_employees").text($(obj).data('no_of_employees'));
    

    $('#clientDetails').modal('show');
}
function isEmpty(str) {
    return (!str || /^\s*$/.test(str));
}
function AdHocDetails(obj)
{
  $('#1').hide();
  $('#2').hide();
  $('#3').hide();
  $('#4').hide();
  $('#5').hide();
  $('#6').hide();
 
if(!isEmpty($(obj).data('monday'))){
$("#Monday").text($(obj).data('monday')+' Hours');
 $('#1').show();
 

}
if(!isEmpty($(obj).data('tuesday'))){
    $("#Tuesday").text($(obj).data('tuesday')+' Hours');
    $('#2').show();
    
}
if(!isEmpty($(obj).data('wednesday'))){
    $("#Wednesday").text($(obj).data('wednesday')+' Hours');
    $('#3').show();
}
if(!isEmpty($(obj).data('thursday'))){
     $("#Thursday").text($(obj).data('thursday')+' Hours');
    $('#4').show();
}
if(!isEmpty($(obj).data('friday'))){
     $("#Friday").text($(obj).data('friday')+' Hours');
    $('#5').show();
}if(!isEmpty($(obj).data('saturday'))){
     $("#Saturday").text($(obj).data('saturday')+' Hours');
    $('#6').show();
}
     
    $('#modal2').modal('show');
}


 //  $("#services").change(function () {
 //    if ($(this).val() == "#1") {
 //        $('#AdHoc').modal('show');
 //      }
 //    if ($(this).val() == "#2") {
 //        $('#FullTime').modal('show');
 //      }
 //    if ($(this).val() == "#3") {
 //        $('#Parttime').modal('show');
 //      }
 
 // });
//   $("#services").bind("change", function () {
//     $('#AdHoc').modal('show')(this.value ===1); 
// }).change();

// $("#services").on("change", function () {        
//    //aler("z");
//     if($(this).val() === '1'){
//          $modal = $('#AdHoc');
//         $modal.modal('show');
//     }
//     if($(this).val() === '3'){
//          $modal = $('#FullTime');
//         $modal.modal('show');
//     }
//       if($(this).val() === '2'){
//          $modal = $('#Parttime');
//         $modal.modal('show');
//     }
// });

$("#services").on("change", function () {        
   //aler("z");
   if($(this).val() === '1'){

      $("#AdHoc").show();
      $("#FullTime").hide();
      $("#PartTime").hide();
  }
  if($(this).val() === '3'){
    $("#FullTime").show(); 
    $("#AdHoc").hide();
    $("#PartTime").hide();     
}
if($(this).val() === '2'){
   $("#PartTime").show();
   $("#AdHoc").hide();
   $("#FullTime").hide();  
   
}});

$(function () {
        $("#ch1").click(function () {
            if ($(this).is(":checked")) {
                 $("#mon").css("visibility", "visible");
                 $('#mondayHours').prop('required',true);
                
            } else {
               $("#mon").css("visibility", "hidden");
               $('#mondayHours').removeAttr('required');
               
            }
        });
          $("#ch2").click(function () {
            if ($(this).is(":checked")) {
                 $("#tue").css("visibility", "visible");
                  $('#tuesdayHours').prop('required',true);
                
            } else {
               $("#tue").css("visibility", "hidden");
                 $('#tuesdayHours').removeAttr('required');
               
            }
        });
            $("#ch3").click(function () {
            if ($(this).is(":checked")) {
                 $("#wed").css("visibility", "visible");
                 $('#wednesdayHour').prop('required',true);
                
            } else {
               $("#wed").css("visibility", "hidden");
                  $('#wednesdayHour').removeAttr('required');
               
            }
        });
              $("#ch4").click(function () {
            if ($(this).is(":checked")) {
                 $("#thu").css("visibility", "visible");
                 $('#thursdayHours').prop('required',true);
                
            } else {
               $("#thu").css("visibility", "hidden");
                 $('#thursdayHours').removeAttr('required');
               
               
            }
        });

                  $("#ch5").click(function () {
            if ($(this).is(":checked")) {
                 $("#fri").css("visibility", "visible");
                  $('#fridayHours').prop('required',true);
                
            } else {
               $("#fri").css("visibility", "hidden");
               $('#fridayHours').removeAttr('required');
               
            }
        });

                    $("#ch6").click(function () {
            if ($(this).is(":checked")) {
                 $("#sat").css("visibility", "visible");
                  $('#saturdayHours').prop('required',true);
                
            } else {
               $("#sat").css("visibility", "hidden");
               $('#saturdayHours').removeAttr('required');
               
            }
        });
    });





function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}