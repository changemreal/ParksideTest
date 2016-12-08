
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Loan Applycatiion</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <!-- Page Content -->
    <div class="container">

        <!-- /.row -->

        <!-- Service Tabs -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Loan Application</h2>
            </div>
            <div class="col-lg-12">

                <ul id="myTab" class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#service-one" data-toggle="tab"><i class="fa fa-tree"></i>Register a Loan</a>
                    </li>
                    <li class=""><a href="#service-two" data-toggle="tab"><i class="fa fa-car"></i>Check Status</a>
                    </li>
                </ul>

                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade active in" id="service-one">
                    	<p>
						<form role="form" id="mainForm">
							<fieldset>
						    	<label class="control-label" for="email">Property Value:</label>
						    	<input type="text" name="property_value" class="form-control" placeholder="Property Value">
						    </fieldset>
						    <p>&nbsp;</p>
							<fieldset>
						      <label class="control-label" for="date-picker-1">Loan Amount:</label>
						      <input id="date-picker-3" type="text" name="loan_amount" class="form-control" placeholder="Loan Amount">
						      <label class="control-label" for="date-picker-2">Social Security Number:</label>
						      <input id="date-picker-4" type="text" name="ssn" class="form-control" placeholder="Social Security Number 999-99-9999">
								<a class="btn loan_reg">Send</a>
						    </fieldset>
					  	</form>
					  	<p>
					  	<div id="result"></div>
                    </div>
                    <div class="tab-pane fade" id="service-two">
                        <h3>Input Loan number to check status</h3>
						<form role="form" id="loansearch">
							<fieldset>
						    	<label class="sr-only" for="email">Email:</label>
						    	<input type="text" name="loan_id" class="form-control" placeholder="loan ID ">
						    </fieldset>
						    <p>&nbsp;</p>
							<fieldset>
							<a class="btn loan_reg2">Send</a>
						    </fieldset>
					  	</form>
					  	<p>
					  	<div id="car_result"></div>
                    </div>
                </div>

            </div>
        </div>

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p></p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</body>
<script type="text/javascript">
$(function () {
	$(".date-picker").datepicker();
	$(".date-picker").on("change", function () {
		var id = $(this).attr("id");
		var val = $("label[for='" + id + "']").text();
		$("#msg").text(val + " changed");
	});
	$(".loan_reg").click(function () {
		$('#result').html('');
		$.ajax({
	 		url: "/mvc/index.php?pkg=parkside&contr=loan&event=register_loan",
	   		type: "POST",
	   		data:$('#mainForm').serialize(),
	   		dataType: "JSON",
	   		success: function(response){
				if(response.status=='Error'){
					alert(response.message);
				}else{
					$('#result').html('Loan Application is ' + response.status + '. Loan number is ' + response.loan_id);
				}
	   	   	}
		});
	});
	$(".loan_reg2").click(function () {
		$('#car_result').html('');
		$.ajax({
	 		url: "/mvc/index.php?pkg=parkside&contr=loan&event=check_loan",
	   		type: "POST",
	   		data:$('#loansearch').serialize(),
	   		dataType: "JSON",
	   		success: function(response){
				if(response.status=='Fail'){
					$('#car_result').html("We can't locate your loan info.");
				}else{
					$('#car_result').html('Loan ' + response.data.id + ' application is ' + response.data.status );
				}
	   	   	}
		});
	});
});


</script>

</html>

