
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> GNK Groceries Sales and Inventory System </title>
 	

<?php include('./header.php'); ?>
<?php include('./db_connect.php'); ?>

<?php 
session_start();
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

$query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}
?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:40%;
		height: calc(100%);
		background:white;
		display: flex;
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:60%;
		height: calc(100%);
		background:#00000061;
		display: flex;
		align-items: center;
	}
	#login-right .card{
		margin: auto
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    background: white;
    padding: .5em 0.8em;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style>

<body>


  <main id="main" class=" bg-dark">
  		<div id="login-left">
  			<div class="logo">
  				<span class="fa fa-coins"></span>
  			</div>
  		</div>
  		<div id="login-right">
  			<div class="card col-md-8">
  				<div class="card-body">
  					<form id="login-form">
                        <div id="divMessage"></div>
  						<div class="form-group">
  							<label for="username" class="control-label">Username</label>
  							<input type="text" id="username" name="username" class="form-control">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label">Password</label>
  							<input type="password" id="password" name="password" class="form-control">
  						</div>
                        <button id="btnLogin" class="btn-sm btn-block btn-wave col-md-4 btn-primary mx-auto">Login</button>
                    </form>
                    <div id="divLockout" class="mt-4">
                        <div id="lockout-card" class="card">
                            <div class="card-body">
                                <h5 class="text-center">Lockout Form</h5>
                                <div id="divMessageLockout"></div>
                                <form id="lockout-form">
                                    <div class="form-group">
                                        <label for="pin" class="control-label">Admin Secret Key</label>
                                        <input type="password" id="pin" name="pin" class="form-control">
                                    </div>
                                    <button id="btnUnlock" class="btn-sm btn-block btn-wave col-md-4 btn-primary mx-auto">Unlock</button>
                                </form>
                            </div>
                        </div>
                    </div>
  				</div>

  			</div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>
<script>
    var countdown;
    var noob = 'noob';
    // Login Form
    $('#divLockout').hide();
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#btnLogin').attr('disabled', true).html('Logging in...');
		$('#divMessage').empty();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		        $('#btnLogin').removeAttr('disabled').html('Login');
			},
			success:function(response){
                const res = JSON.parse(response)
                console.log(res)
                switch (res.status) {
                    case 1:
                        location.href ='index.php?page=home';
                        break;
                    case 2:
                        $('#btnLogin').attr('disabled', true);
                        $('#divLockout').show();
                        startTimer(res);
                        break;
                    case 3:
                        $('#divMessage').html('<div class="alert alert-danger">' + res.message + '</div>')
                    	$('#btnLogin').removeAttr('disabled').html('Login');
                }
			}
		})
	})

    // Lockout Form
    $('#lockout-form').submit(function (e){
        e.preventDefault();
        $('#btnUnlock').attr('disabled', true).html('Unlocking...');
        $('#divMessageLockout').empty();
        $.ajax({
            url:'ajax.php?action=lockout',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
                $('#btnUnlock').removeAttr('disabled').html('Unlock');
            },
            success:function(response){
                const res = JSON.parse(response)
                console.log(res)
                switch (res.status) {
                    case 1: // success
                        stopTimer();
                        break;
                    default:
                        $('#divMessageLockout').html('<div class="alert alert-danger">' + res.message + '</div>')
                        $('#btnUnlock').removeAttr('disabled').html('Unlock');
                }
            }
        })
    })

    // Timer Stuff
    function startTimer(res) {
        let start = res.time_left
	    countdown = setInterval(function () {
            const minutes = Math.floor(start / 60);
            const seconds = start % 60
            $('#btnLogin').html(`Login (${start}s)`)
            $('#divMessage').html(`<div class="alert alert-danger">${res.message} (Time Left: ${minutes} minutes & ${seconds} seconds)</div>`)
            start-=1;
        }, 1000)

        setTimeout(function () {
            stopTimer();
        }, res.time_left * 1000)
    }

    function stopTimer(){
        countdown && clearInterval(countdown)
        $('#btnLogin').removeAttr('disabled').html('Login');
        $('#divMessage').empty();
        $('#btnUnlock').removeAttr('disabled').html('Unlock');
        $('#divLockout').hide();
    }
</script>	
</html>