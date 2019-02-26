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

  $('.diagnose_me').on('change', function(e)){
    e.preventDefault();
  }
});
