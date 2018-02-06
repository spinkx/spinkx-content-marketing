
jQuery(document).ready(function($) {
    $("#zip_code_number").blur(function () {
        var zip= $("#zip_code_number").val();
        var reg = /^[0-9]+$/;
        if(zip=='') {
            return;
        }
        else if ((zip.length)< 3 || (zip.length)>6 ){
            alert("zipcode should be 6 digits");
        }
        else if (!reg.test(zip)){
            alert("zipcode should be numbers only");
        }

    });
    jQuery('#categories').multiselect({
        columns: 1,
        placeholder: 'Select Categories',
        search: true,
        selectAll: true
    });
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
});
