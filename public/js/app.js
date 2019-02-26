$('document').ready(function(){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });


  $('.level').on('change', function(e){
    e.preventDefault();// prevents default action
    // declare the post variables
    let symptom_id = $(this).attr('data-id');
    let level_id = $(this).val();
    /// post the data with ajax
    $.ajax({
       type:'POST',
       url:'/keepSymptom',
       data:{symptom:symptom_id, level:level_id},
       success:function(response){
         if(response.success){
           $(`input[name=checkbox${symptom_id}]`).attr('checked', true);
         }else if(response.error){
           swal('Oops!', `${response.error}`, "info");
         }else{
           swal('Oops!', `An error occured`, "error");
         }
       }
    });

  });// end of onchange

  $('.diagnose_me').on('click', function(e){
    e.preventDefault();

    $.ajax({
       type:'POST',
       url:'/diagnose_patient',
       beforeSend:function(){
        $('.diagnose_me').html(`<img src="../img/loader.gif">&ensp;<b>Diagnosing...</b>`);
        $('.diagnosis_result').html(`<h4>Please wait while you are being diagnosed...</h4>`);
        $('.diagnose_me').attr('disabled', true);
       },
       success:function(response){
         if(response.success){
           $(`input[name=checkbox${symptom_id}]`).attr('checked', true);
         }else if(response.error){
           swal('Oops!', `${response.error}`, "info");
         }else{
           swal('Oops!', `An error occured`, "error");
         }
       }
    });
  });
});
