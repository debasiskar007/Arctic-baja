
var sel;

$(function(){

    if($('#UserManager_country').length ==1 ){
        getState($('#UserManager_country'),'UserManager_state',$('#sel_state').val());
    }

    if($('#AccountInfo_country').length ==1 ){
        getState1($('#AccountInfo_country'),'AccountInfo_state',$('#sel_state').val());
    }

    if($('#UserManager_role').length ==1 ){
        isAffliate($('#UserManager_role'));
    }




    // Dock each summary as it arrives just below the docked header, pushing the
    // previous summary up the page.



    //$('.datepicker').find('.table-condensed').find('th.switch').css('background-color','#0879D1');

});

function formerrorshow(form2,errors){
    errorL = eval('('+errors+')');
    for(n in errorL){
        $(form2).find('span#'+n+'_em_').text(errorL[n]);
        $(form2).find('span#'+n+'_em_').show();
    }
}

function getState(obj,sel_state_id,state_id){


    if(typeof(state_id) == 'undefined'){
        state_id = 0;
    }

    var con = $(obj).val();
    $('#'+sel_state_id).html("<option value=\"\">Select A State</option>");

    $.post(base_url+'/user/admin_user/getState',
    {con:con,state_id:state_id},
    function(res){
        $('#'+sel_state_id).html(res);
    });
    
    
}
function getState1(obj,sel_state_id,state_id){


    if(typeof(state_id) == 'undefined'){
        state_id = 0;
    }

    var con = $(obj).val();
    $('#'+sel_state_id).html("<option value=\"\">Select A State</option>");

    $.post(base_url+'/user/admin_account/getState',
    {con:con,state_id:state_id},
    function(res){
        $('#'+sel_state_id).html(res);
    });
    
    
}

function toggleloader(obj){
    var sel = obj;
    bootbox.dialog("Please Wait...");
}

$(function(){

    $( "td.extrarow" ).each(function( index ) {

        $(this).attr('colspan',7);
        $( "tfoot >tr >td").eq(7).remove();
    });

    $( "#user-grid" ).find( "tbody").find('.empty').hide();
    $('#refresh').click(function(e)
    {
        //alert(9);
        var id='user-grid';
        var inputSelector='.filters input, .filters select';
        $(inputSelector).each( function(i,o) {
            $(o).val('');
        });
        var data=$.param($(inputSelector));
        $.fn.yiiGridView.update(id, {data: data});


        return false;
    });
});

$(function(){

    $( "#order" ).find( "tbody").find('.empty').hide();
    $('#refresh').click(function(e)
    {
        
        var id='order';
        var inputSelector='#'+id+' .filters input, '+'#'+id+' .filters select';
        $(inputSelector).each( function(i,o) {
            $(o).val('');
        });
        var data=$.param($(inputSelector));
        $.fn.yiiGridView.update(id, {data: data});
        return false;
    });
});


function isAffliate(obj){
    $('#UserManager_cpa').attr('readonly',true);
    $('#UserManager_cpl').attr('readonly',true);
    $('#UserManager_cpc').attr('readonly',true);

    var rolelist = $(obj).val();
    var role1=[];
    role1[0] = "1";
    role1[1] = "9";

    var is_affiliate = $.inArray( "9", rolelist );

    if(is_affiliate > -1){
        $('#UserManager_cpa').attr('readonly',false);
        $('#UserManager_cpl').attr('readonly',false);
        $('#UserManager_cpc').attr('readonly',false);
    }

}

//This is function to change password in admin user listing
function cngpass(obj){
    var uid = $(obj).attr('id');

    $("#cngpassModal").find('input#userid').val(uid);

    $("#cngpassModal").modal('show');

}

//show description

function showdes(s)
{
    
    var id = $(s).attr('id');
    $.post(base_url+'/sportsmanager/admin/sports/showcontent',{'id':id},function(res){
       
        //$("#myModal").modal(\'show\');
            $("#swdesc").html(res); 

        
    });

}

//This is function change password form validation
function formvalidate(){
    var pass = $("#cngpassModal").find('input#UserManager_password').val();
    var pass2 = $("#cngpassModal").find('input#UserManager_password2').val();

    if($.trim(pass) == ''){
        alert('Password cannot be blank.');
    }else if($.trim(pass).length < 6){
        alert('Password is too short (minimum is 6 characters)..');
    }else if($.trim(pass2) == ''){
        alert('Confirm Password cannot be blank.');
    }else if($.trim(pass2) != $.trim(pass)){
        alert('Passwords don\'t match');
    }else{
        $('#cngpassform').submit();
    }    
}




//This is function to show notes in admin user listing
function shownote(obj){
    var uid = $(obj).attr('id');

    $("#allloadingModal").modal('show');

    $.post(base_url+'/user/admin/user/renderNote',{'id':uid},function(res){

        $("#shownotesModal").find('.modal-body').html(res);

        $("#allloadingModal").modal('hide');

        $("#shownotesModal").modal('show');
    });

}
//This is function to show notes in admin user listing
function shownote1(uid){

    $("#allloadingModal").modal('show');

    $.post(base_url+'/user/admin/user/renderNote',{'id':uid},function(res){

        $("#shownotesModal").find('.modal-body').html(res);

        $("#allloadingModal").modal('hide');

        $("#shownotesModal").modal('show');
    });

}
//this function for add note in admin user listing
function addnote(uid){

    $("#addnotesModal").find('#UserNotes_notes').val('');
    $("#addnotesModal").find('.error').text('');
    $("#addnotesModal").find('.error').hide();

    $("#addnotesModal").find('input#userid').val(uid);

    $("#shownotesModal").modal('hide');

    $("#addnotesModal").modal('show');

}

//This is function add note form validation
function formvalidate1(){
    var note = $("#addnotesModal").find('textarea#UserNotes_notes').val();

    if($.trim(note) == ''){
        alert('Note cannot be blank.');
    }else{
        $('#addnotesform').submit();
    }    
}

//This is function to show notes in admin user listing
function grab_aff_code(obj){

    var uid = $(obj).attr('id');

    $("#allloadingModal").modal('show');
 
    $.post(base_url+'/user/admin/user/getRole',{'id':uid},function(res){
        
        if(res == 0){

            $("#allloadingModal").modal('hide');

            $("#grabcodemodal1").modal('show');

        }else{

            var base = $("#grabcodemodal").find('input.hid').val();
            
            $("#grabcodemodal").find('input.aff_link').val(base+'/user/default/set-affiliate-code/id/'+res);
            $("#grabcodemodal").find('input.aff_link1').val(base+'/user/default/set-affiliate-code1/id/'+res);

            $("#allloadingModal").modal('hide');

            $("#grabcodemodal").modal('show');

        }



    });



}

function updategrid()
{
    var id='user-grid';
    var inputSelector='.filters input, .filters select';
    $(inputSelector).each( function(i,o) {
        //$(o).val('');
       // alert($(this).attr('name'));

    });
    var data=$.param($(inputSelector));
    $.fn.yiiGridView.update(id, {data: data});
    setTimeout('managetdrow()',4000);

    return false;

}

function managetdrow()
{
    $( "td.extrarow" ).each(function( index ) {

        $(this).attr('colspan',7);
        $( "tfoot >tr >td").eq(7).remove();
    });

}

function showid(obj)
{
    alert($(this).attr('id'));
    
}

function delnote(obj){
    noteid = $(obj).attr('id');
    $.post(base_url+'/user/admin/user/delNote',{noteid:noteid},function(res){
        shownote1(res);
    });
}
