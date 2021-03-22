<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oiscenjevalec</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3 text-center">
                <h1>Oiscenjevalec</h1>
                <img src="ninja.png" alt="OIS Ninja">
            </div>
        </div>
        <?php 
        if(!isset($_POST['naloga']) || !isset($_POST['oddaja'])) {
        ?>
        <div class="row mt-5">
            <div class="col-md-6 offset-md-3">
                <!-- Main form -->
                <form method="post">
                    <div class="form-group text-center">
                        <label for="naloga">Izberi domaco nalogo</label>
                        <select name="naloga" id="">
                            <option value="1">DN. 1</option>
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <label for="oddaja">Vnesi oddajo ucenca</label>
                        <textarea class="form-control" name="oddaja" id="oddaja" rows="6" placeholder="# A # git@github.com:Lenart12/Oiscenjevalec.git #&#10# B # ..."></textarea>
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-primary">Oceni</button>
                    </div>
                </form>
            </div>
        </div>
        <?php } else {?>
        <div class="row mt-5">
            <div class="col-md-5 offset-md-1" id="navodila"></div>
            <div class="col-md-5" id="resitev"></div>
        </div>
        <div class="row mt-2">
            <div class="col-md-10 offset-md-1 text-center" id="ocena"></div>
        </div>
        <script src="ocenjevalec.js"></script>
        <?php } ?>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>