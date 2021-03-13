<html>

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>DATABASE | BACKUP AND RESTORE</title>
    </head>

    <body>
        
        <div class="container">
            <div class="col mt-5">
                <form action="backupDatabase.php" method="POST">
                        <div class="card m-2" style="width: 15rem;">
                            <div class="card-body">
                            <h6 class="card-title">BACK UP DATABASE</h6>
                            <button><span class="mdi mdi-download"></span> BACK UP </button>
                            
                            </div>
                        </div>
                    </form>

                    <form action="restoreDatabase.php" method="POST">
                        <div class="card m-2" style="width: 15rem;">
                            <div class="card-body">
                            <h6 class="card-title">RESTORE DATABASE</h6>
                            <input type="file" name="file" required>
<br> </br>
                            <button><span class="mdi mdi-restore"></span> RESTORE</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
        
    </body>
<style>
	body{
        background: #80808045;
  }
</style>

</html>