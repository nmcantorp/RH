
    function search(url){

	var region_id = $("#contry_select").val();
    var statusID = $("#status_select").val();
        window.location=url+"?region_id="+region_id+"&statusID="+statusID;
    }

    function clear_list(url){
    	window.location=url;
    }

    
    
    function fncatras()
    {
    	document.location = "../pages/landing_page.php";
    }

    function newCompanyFile()
    {
    	document.location = "companies_file_upload.php";
    }

    

    function downloadExcel()
    {
    	var countryId = $('#contry_select').val();
    	var quarterId = $('#quarter_select').val();
    	var year = $('#year_select').val();	
    	window.location='sales_file_list_error.xlsx.php?cid=' + countryId + '&qid=' + quarterId + '&year=' + year;
    }

    function change_actions(action, id)
	{
		
	  switch (action.value) 
	  {
	    case 'transfer':
	    	iso_company = $('#iso_'+id).val();
	    	lenguaje = $('#lenguaje_'+id).val();
	    	
	    	
	      window.location = "companies_file_upload.php?ac=transfer&id_bulk="+ id +"&iso="+iso_company+"&leng="+lenguaje;
	      
	    break;

	    case 'delete':
	      delete_item(id);
	      
	    break;

        case 'details':
          window.location = "companies_file_details.php?id="+ id;
          
        break;
	  }
	}

	function delete_item(id_bulk) {
	        if(confirm('<?=html_entity_decode(__("txtDeletethis"))?>')) window.location = "?ac=delete&id_bulk="+id_bulk; 
	    }
