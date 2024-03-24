<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN - TIMORESTO</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid bg-primary">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3 text-center"> 
                <h3 class="mb-4">LOGIN</h3> 
                <form action="koneksi.php" method="post" onsubmit="return validateForm()"> 
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name@example.com"> 
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password"> 
                        <label for="floatingPassword">Password</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-3">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var username = document.getElementById("floatingInput").value;
        var password = document.getElementById("floatingPassword").value;
        
        if (username.trim() == "" || password.trim() == "") {
            alert("Username dan password tidak boleh kosong");
            return false;
        }
        return true;
    }
</script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
