$(function() {
       
    
    //for other pages where no redirection is needed
    $('.datepicker').datepicker({
        dateFormat: "yy-mm-dd"
    });

    // ##### DATA TABLE COLUMN FILTER ###### //
    if($('#datatable').length > 0){
        $('#datatable').dataTable().columnFilter();
    }
       
       
    });