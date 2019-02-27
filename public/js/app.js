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
       url:'/diagnosePatient',
       beforeSend:function(){
        $('.diagnose_me').html(`<img src="../img/loader.gif">&ensp;<b>Diagnosing...</b>`);
        $('.diagnosis_result').html(`<h4>Please wait while you are being diagnosed...</h4>`);
        $('.diagnose_me').attr('disabled', true);
       },
       success:function(response){
         if(response.success){
           if(response.success == true){
             setTimeout(()=>{
               $('.diagnosis_result').html(`<h4>You have been diagnosed of <strong class="text-danger">${response.disease_diagnosed}</strong>.</h4>`);
               $('.diagnosis_treatment').html(`<h5><strong class="text-danger">Treatment recommended:</strong><br>${response.suggested_treatment}.</h5>`);

               let full_result = '';
               full_result += '<h6>Result in detail</h6>';
               full_result += '<ul>';
               $.each(response.diagnosis_result, function(key, value){
                 full_result += `<li><b>Test for ${value.disease}</b> => <strong>${value.percentage}%</strong></li>`;
               });
               full_result += '</ul>';
               $('.diagnosis_result_overview').html(full_result);
               $('.diagnose_me').html(`<b>Diagnose me now</b>`);
               $('.diagnose_me').attr('disabled', false);
             }, 4000);
           }
         }else if(response.error){
           $('.diagnosis_result').html(`<h4>${response.error}</h4>`);
           $('.diagnose_me').html(`<b>Diagnose me now</b>`);
           $('.diagnose_me').attr('disabled', true);
         }else{
           swal('Oops!', `An error occured while diagnosing`, "error");
         }
       }
    });
  });
});
