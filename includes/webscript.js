/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$("#formvalidate").click(function(e)
{
    var formname = $(this).attr("data-form");
    $('#'+formname).validate();
    if($('#'+formname).valid())
    {
        $('#'+formname).submit();
        return false;
    }
    else
    {
        return false
    }
});

$("#FormData").submit(function(e)
{
   e.preventDefault();
   $elm=$(".btn-submit");
   $elm.hide();
   $elm.after('<i class="fa fa-spinner fa-pulse fa-1x fa-fw submit-loading"></i>');
   var formData = new FormData(this);
    $.ajax({
        type: 'POST',
        url: 'includes/webfunction.php',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(resp) 
        {
            resp=JSON.parse(resp);
            if(resp.success){
               $.notify({
                    message: resp.message 
                },{
                    allow_dismiss: true,
                    type: 'success',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1000000
                });
                $('#FormData')[0].reset();
            }else{
                $.notify({
                    message: resp.message 
                },{
                    allow_dismiss: true,
                    type: 'info',
                    placement: {
                        from: "bottom",
                        align: "right"
                    },
                    offset: 20,
                    spacing: 10,
                    z_index: 1000000
                });
            }
            $(".submit-loading").remove();
            $elm.show();
        },
        error: function(data) {
        }
    });
});

$(document).on('click','#PayBill',function () {
    if($('#accept').is(":checked"))
    {
        $('#PayNow').submit();
    }
    else
    {
        $.notify({
            message: 'Please Accept I agree to make the payment' 
        },{
            allow_dismiss: true,
            type: 'info',
            placement: {
                from: "bottom",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1000000
        });
    }
});
