
jQuery(document).ready(function(){
    var categorvalue = jQuery('#celebritycategory_main_categoryChild option:selected').val();
    if(categorvalue == 0)
    {
        jQuery('#celebritycategory_main_categoryParentId').css('display','none');
    }
    jQuery('#celebritycategory_main_categoryChild').on('change', function(){
        if((this.value) == 0)
        {
            jQuery('#celebritycategory_main_categoryParentId').val('').change();
            jQuery('#celebritycategory_main_categoryParentId').css('display','none');
        }
        else
        {
            jQuery('#celebritycategory_main_categoryParentId').css('display','block');
        }
    });
    
})    
    