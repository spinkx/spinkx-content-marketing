
jQuery(document).ready(function($) {

    jQuery('#categories').multiselect({
        columns: 1,
        placeholder: 'Select Categories',
        search: true,
        selectAll: true
    });
    $('.cmn-arw-cmn-clas-dv').click(function(){
        $('#site-gerography-select').select();
    })
    $("select[name='primary_category']").change(function(){
        $val  = $(this).val();
        jQuery('#categories').multiselect('refresh');
        jQuery('#categories').multiselect('reload');
        $arr = spnx_sec_cats[$val];
        $length = ($arr.length) -1;
        selectbox = document.getElementById('categories');

        var options = [];

        $.each($arr, function(index, item) {
            options.push({name:item, value: index});

        });
        for(i=selectbox.options.length; i>=0; i--) {
            selectbox.remove(i);
        }
        for(i=0; i < options.length; i++) {
            var opt = document.createElement('option');
            opt.value = options[i].value;
            opt.innerHTML = options[i].name;
            selectbox.appendChild(opt);

        }
        jQuery('#categories').multiselect('loadOptions', options);
        jQuery('#categories').next('.ms-options-wrap').find('> button:first-child').text("Select Categories");

    });
    $("#geography-spnx-reg").click(function () {
        $("#site-gerography-select").trigger('click');
    });
    $("button[type=submit]").click(function(event){
        event.preventDefault();
        var flag = 0;
        if (!$('input[name=agree]:checked').val() ) {
            $(".error-cmn-clas-spnx-terms-condition").css('display','block');
            flag = 1;
        }
        else {
            $(".error-cmn-clas-spnx-terms-condition").css('display','none');
        }
        if($('.categories').val() === null) {
            $('.categories').parent().find('div.error-cmn-clas-spnx').css('display', 'block');
            flag = 1;
        }
        else {
            $('.categories').parent().find('div.error-cmn-clas-spnx').css('display', 'none');
        }
        if($('input[name=plugin-type]:checked').length<=0) {
            $('input[name=plugin-type]').parents('div.spnx-box-reg-cmn-cls').find('div.error-cmn-clas-spnx').css('display', 'block');
            flag = 1;
        }
        else {
            $('input[name=plugin-type]').parents('div.spnx-box-reg-cmn-cls').find('div.error-cmn-clas-spnx').css('display', 'none');
        }
        if((!$("#image_attachment_id").val()) ||($("#image-preview").attr('src')=='')) {
            $(".reg_upload_file_type ").next().css('display','inline-block');
            flag=1;
        } else {
            $(".reg_upload_file_type ").next().css('display','none');

        }
        $("#bussiness-name-spnx, #street-ad-bs-spnx, #city-bs-spnx, #zip_code_number, #state-ad-bs-spnx, #phone-ad-bs-spnx").trigger('blur');
        if($('.error-cmn-clas-spnx').is(':visible') || flag) {
            return false;
        }

        $(this).parents('form').submit();
    });
    $("#bussiness-name-spnx, #street-ad-bs-spnx, #city-bs-spnx, #zip_code_number, #state-ad-bs-spnx, #phone-ad-bs-spnx").blur(function () {
        if($(this).val()) {
            $(this).next().next().css('display', 'none');
        }
        else {
            $(this).next().next().css('display', 'block');
        }

    });

    $("#paypal-bs-spnx").blur(function () {
        if($(this).val()) {
            //$(this).next().css('display', 'none');
            var email_id=$(this).val();
            if(!Validateemail(email_id)) {
                $(this).next().css('display', 'block');
            }
            else {
                $(this).next().css('display', 'none');
            }
        }
        else {
        }
    });
    $("#zip_code_number").blur(function () {
        var zip= $("#zip_code_number").val();
        var reg = /^[0-9]+$/;
        if ((zip.length)< 6 || (zip.length)>9 ){
            $(this).next().next().css('display', 'block');
        }
        else {
            $(this).next().next().css('display', 'none');
        }
    });
    $("#phone-ad-bs-spnx").blur(function () {
        var zip= $("#phone-ad-bs-spnx").val();
        var reg = /^[0-9]+$/;
        if ((zip.length)< 10 || (zip.length)>12 ){
            $(this).next().next().css('display', 'block');
        }
        else {
            $(this).next().next().css('display', 'none');
        }

    });


    function Validateemail(email) {
        var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
        return pattern.test(email );
    }
    $('.select-add-cat').show();
    jQuery('.spnx_wdgt_wrapper').hide();
});
