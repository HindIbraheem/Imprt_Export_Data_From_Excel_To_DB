<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - dataTables percentage bar renderer plugin v1.1</title>
  <title>demo percentbar</title><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css'>
<link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.2.2/css/buttons.bootstrap.min.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<br><br>




<div class="container" >
<br/>
<h3>

    <a href="{{ url('Export') }}" > Export and Display result </a>
</h3>
<br>
<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>sq</th>
			<th>order_id</th>
			<th>user</th>
			<th>total</th>
            <th>currency </th>
			{{-- <th>check</th> --}}
		</tr>
	</thead>
	 <tbody>

        <?php

$db=DB::table('orders')
// ->select('users.id','users.name','profiles.photo')
->join('units','orders.unit_id','=','units.id')
->join('users','units.customer_id','=','users.id')
->select('units.compound_id as CompoundID', 'orders.*' , 'users.*' )
// ->where(['units.compound_id' => '1' , 'orders.deleted_at'=> 'NULL'])

->where('orders.deleted_at', '=', null)->where('units.compound_id', '=', '1')
->get();


// print_r($db);
?>
@foreach ($db as $key => $value )
		<tr>
			<td>{{$key+1}}</td>
			<td> {{$value->order_number}}</td>
			<td>{{$value->first_name}} {{$value->secound_name}} {{$value->last_name}}</td>
			<td>{{$value->total_amount}}</td>
      <td>{{$value->currency_type}}</td>

		</tr>

        @endforeach

	</tbody>





</table>

</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
<script src='https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js'></script>
<script src='https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js'></script>
<script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js'></script>
<script src='https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js'></script>
<script src='https://cdn.datatables.net/plug-ins/1.10.15/dataRender/percentageBars.js'></script>
<script >
	$(document).ready(function() {
  // DataTable initialisation
  $('#example').DataTable({
    "dom": '<"dt-buttons"Bf><"clear">lirtp',
    "paging": true,
    "autoWidth": true,

    "buttons": [
				'colvis',
				'copyHtml5',
        'csvHtml5',
				'excelHtml5',
        'pdfHtml5',
				'print'
			]
  });
});
</script>

</body>
</html>




