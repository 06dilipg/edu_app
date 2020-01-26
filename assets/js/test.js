$(document).ready(function(){

    $('#modal-addEditDepartment').on('show.bs.modal',function(event){

        var div=$(event.relatedTarget);
        var modal=$(this);

//        $('#department').value(div.data('department'));

        modal.find('#department').attr('value',div.data('department'));
        modal.find('#description').attr('value',div.data('description'));

    });


});