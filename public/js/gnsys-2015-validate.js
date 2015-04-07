  $(document).on('click','.nav-pills li',function(){
      $('.nav-pills li').removeClass('active');
      $(this).addClass('active');
  });
 
  $(document).on('keydown','.numbers',function(event){
      if(event.shiftKey){
               $(this).tooltip('show');
          event.preventDefault();
      }
      if(event.keyCode==46 || event.keyCode==8){
              $(this).tooltip('hide');
      }else{
          if(event.keyCode<95){
              if(event.keyCode>=48 && event.keyCode<=57){
                     $(this).tooltip('hide');
              }else{
              $(this).tooltip('show');
                    event.preventDefault();
              }
          }else{
              
              if(event.keyCode<96||event.keyCode>105){
                  if(event.keyCode!=190){
                        $(this).tooltip('show');
                 event.preventDefault();}
             else{
                  $(this).tooltip('hide');
             }
              }else{
                     $(this).tooltip('hide');
              }
          }
      }
  });
  function  formIsvalid(objectToFind) {
    var valform = 1;
    objectToFind.each(function() {
        if ($(this).parent().parent().parent().css('display') != 'none') {
            var isSelect = 0;
            var i = '<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>';
            if ($("select#" + $(this).attr('id')).length == 1) {//validacion si es un select o input
                i = '';
                isSelect = 1;
            }
            if ($(this).val() == "" || ($(this).val() == 0 && isSelect == 1)) {
                valform = 0;
                $(this).parent().append(i);
                $(this).parent().addClass('has-error');
            }
        }
    });
    if (valform === 1) {
        return true;
    }
    else {        
        $('.alert-danger').html('<i class="glyphicon glyphicon-alert"></i> <strong>Aviso.</strong> Complete los campos vacios.').fadeIn('slow');
        return false;
    }
}
 $(document).on('click','.mypageheader a',function(){ 
          var label = '<b style="color:#555;font-size:11px;">Cargando formulario...</b>';        
        $('.indicator').html(
                ''+label+'<div class="progress progress-striped active">'+ 
                    '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">'+ 
                        '<span class="sr-only">Registrando acción...</span>'+ 
                    '</div>'+ 
                '</div>'
            );
    });

  $(document).on('click','button[id*=save]',function(){ 
      if(formIsvalid($('.form-control[required]'))){
          var label = '<b style="color:#555;font-size:11px;">Guardando información...</b>';
          if($(this).attr('id')=='saveacceso'){
              label = '<b style="color:#666;font-size:11px;">Verificando la cuenta...</b>';
          }
        $('.indicator').html(
                ''+label+'<div class="progress progress-striped active">'+ 
                    '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">'+ 
                        '<span class="sr-only">Registrando acción...</span>'+ 
                    '</div>'+ 
                '</div>'
            );
      }
    });
 $(document).on('click','button[class*=edit]',function(){    
        $('#NewOrEditModal').html('<div class="modal-dialog">'+
        '<div class="modal-content">'+
            '<div class="modal-header">'+               
                '<h5 class="modal-title " id="myModalLabel">SIDMA :: Cargando...</h5>'+ 
            '</div>'+ 
            '<div class="modal-body">'+ 
                '<div class="progress progress-striped active">'+ 
                    '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">'+ 
                        '<span class="sr-only">Cargando...</span>'+ 
                    '</div>'+ 
                '</div>'+ 
            '</div>'+ 
        '</div>'+
       '</div>');
        $('#NewOrEditModal').modal('show');
    });
    $(document).on('click','button[class*=change]',function(){    
        $('#NewOrEditModal').html('<div class="modal-dialog">'+
        '<div class="modal-content">'+
            '<div class="modal-header">'+               
                '<h5 class="modal-title " id="myModalLabel">SIDMA :: Cargando...</h5>'+ 
            '</div>'+ 
            '<div class="modal-body">'+ 
                '<div class="progress progress-striped active">'+ 
                    '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">'+ 
                        '<span class="sr-only">Cargando...</span>'+ 
                    '</div>'+ 
                '</div>'+ 
            '</div>'+ 
        '</div>'+
       '</div>');
        $('#NewOrEditModal').modal('show');
    });
     $(document).on('click','button[class*=create]',function(){    
        $('#NewOrEditModal').html('<div class="modal-dialog">'+
        '<div class="modal-content">'+
            '<div class="modal-header">'+               
                '<h5 class="modal-title " id="myModalLabel">SIDMA :: Cargando...</h5>'+ 
            '</div>'+ 
            '<div class="modal-body">'+ 
                '<div class="progress progress-striped active">'+ 
                    '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">'+ 
                        '<span class="sr-only">Cargando...</span>'+ 
                    '</div>'+ 
                '</div>'+ 
            '</div>'+ 
        '</div>'+
       '</div>');
        $('#NewOrEditModal').modal('show');
    });
    $(document).on('click','button[class*=delete]',function(){
        $('#DelClassroomModal').html('<div class="modal-dialog">'+
        '<div class="modal-content">'+
            '<div class="modal-header">'+               
                '<h5 class="modal-title " id="myModalLabel">SIDMA :: Cargando...</h5>'+ 
            '</div>'+ 
            '<div class="modal-body">'+ 
                '<div class="progress progress-striped active">'+ 
                    '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">'+ 
                        '<span class="sr-only">Cargando...</span>'+ 
                    '</div>'+ 
                '</div>'+ 
            '</div>'+ 
        '</div>'+
       '</div>');
    $('#DelClassroomModal').modal('show');
    });
    $(document).on('click','button[id*=New]',function(){
        $('#NewOrEditModal').html('<div class="modal-dialog">'+
        '<div class="modal-content">'+
            '<div class="modal-header">'+               
                '<h5 class="modal-title " id="myModalLabel">SIDMA :: Cargando...</h5>'+ 
            '</div>'+ 
            '<div class="modal-body">'+ 
                '<div class="progress progress-striped active">'+ 
                    '<div class="progress-bar" role="progressbar" aria-valuenow="100" ariavolummin="0" ariavolummax="100" style="width:100%;">'+ 
                        '<span class="sr-only">Cargando...</span>'+ 
                    '</div>'+ 
                '</div>'+ 
            '</div>'+ 
        '</div>'+
       '</div>');
        $('#NewOrEditModal').modal('show');
    });
 $(document).on('click', '#save', function() {
        if (formIsvalid($(".form-control[required]"))) {
            $("#formnewedit").submit();
        }

    });
$(document).on('focus',".form-control[required]", function() {
    $(this).parent().removeClass('has-error');
    $(this).parent().find('span[class*=glyphicon]').remove();
    $('.alert').fadeOut('slow');
});
