
<!DOCTYPE html>
<html>
<head>
	<title>Calendar</title>
	<link rel="stylesheet" type="text/css" href="css/sb-admin-2.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
</head>
<body>
	<div class="container col-sm-4 col-md-7 col-lg-4 mt-5 bg-dark">
		<h1>Calendar</h1>
		<div class="card">
		 	<h3 class="card-header" id="monthAndYear">Month And Year</h3>
		 	<table class="table table-bordered table-responsive-sm" id="C\calendar">
		 		<thead>
		 			<tr>
		 				<th>Sun</th>
		 				<th>Mon</th>
		 				<th>Tue</th>
		 				<th>Wed</th>
		 				<th>Thu</th>
		 				<th>Fri</th>
		 				<th>Sat</th>
		 			</tr>
		 		</thead>

		 		<tbody id="calendar-body">
		 			
		 		</tbody>

		 	</table>

		 	<div class="form-inline">
		 		<button class="btn btn-outline-primary col-sm-6" onclick="previous">Previous</button>
		 		<button class="btn btn-outline-primary col-sm-6" onclick="next">Next</button>
		 	</div>

		</div>
		
	</div>
<script type="text/javascript" src="scripts.js"></script>
</body>
</html>