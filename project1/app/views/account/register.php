<?php include 'app/views/shares/header.php'; ?> 

<?php  
if (isset($errors)) {     
    echo "<ul>";     
    foreach ($errors as $err) {         
        echo "<li class='text-danger'>$err</li>";     
    }     
    echo "</ul>"; 
}
?>

<div class="card-body p-5 text-center">     
    <!-- Thêm enctype="multipart/form-data" để upload file -->
    <form class="user" action="/project1/account/save" method="post" enctype="multipart/form-data">         
        <div class="form-group row">             
            <div class="col-sm-6 mb-3 mb-sm-0">                 
                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="username">             
            </div>             
            <div class="col-sm-6">                 
                <input type="text" class="form-control form-control-user" id="fullname" name="fullname" placeholder="fullname">             
            </div>         
        </div>         

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="email">
            </div>
            <div class="col-sm-6">
                <input type="text" class="form-control form-control-user" id="phone" name="phone" placeholder="phone">
            </div>
        </div>

        <div class="form-group row">             
            <div class="col-sm-6 mb-3 mb-sm-0">                 
                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="password">             
            </div>             
            <div class="col-sm-6">                 
                <input type="password" class="form-control form-control-user" id="confirmpassword" name="confirmpassword" placeholder="confirmpassword">             
            </div>         
        </div>         

        <div class="form-group">
            <label for="avatar" class="text-left d-block mb-2">Upload avatar</label>
            <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*">
        </div>

        <div class="form-group text-center">             
            <button class="btn btn-primary btn-icon-split p-3" type="submit">
                Register
            </button>         
        </div>     
    </form>  
</div> 

<?php include 'app/views/shares/footer.php'; ?>
