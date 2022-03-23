<html>
    <head>
        <title>Table Demo</title>
          <script src="js/jquery.js"></script> 
          <script src="media/js/jquery.dataTables.min.js"></script> 
		  <link href="media/css/jquery.dataTables.min.css" rel="stylesheet">
    <script>
     $(document).ready(function(){
	   $("#myTable").dataTable();
	 });
   
   </script>
 </head>
    <body>
    <div class="container">
      
                   <table id="myTable" class="display">
				   <thead>
				   <tr>
				     <th>S.no</th>
					 <th>First Name</th>
					  <th>Last Name</th>
					  <th>Date</th>
				   </tr>
				   
				   </thead>
				   <tbody>
				     <tr>
					   <td>1</td>
					   <td>Ajay</td>
					   <td>Suneja</td>
					   <td>16 may,18</td>
					 
					 </tr>
				   <tr>
					   <td>2</td>
					   <td>Sandip</td>
					   <td>xyz</td>
					   <td>16 may,18</td>
					 
					 </tr>
				   </tbody>
				   </table>


                   </div>            
    </body>

</html>