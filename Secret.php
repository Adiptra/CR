<?php 
$host = "localhost";
$user = "root";
$pass = "";
$db = "secret";

$koneksi = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("Tidak bisa terkoneksi");
}

$msg = "";
$inisial ="";
$sukses = "";
$error = "";


if(isset($_POST['simpan'])){
    $msg = $_POST['msg'];
    $inisial = $_POST['inisial'];

    if($msg && $inisial){
        $sql1 = "INSERT INTO secret_msg(msg,inisial) values ('$msg','$inisial')";
        $q1 = mysqli_query($koneksi,$sql1);
        if($q1){
            $sukses = "Berhasil Menambahkan Pesan";
        }else{
            $error = "Gagal Menambahkan Pesan";
        }
    }else{
        $error = "Jangan Lupa Diisi ya :D";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Massage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .mx-auto{ width:800px }
        .card{ margin-top:10px }
    </style>
</head>
<body>
    <div class="mx-auto">
        <!---untuk membuat data--->
        <div class="card">
            <div class="card-header">
                Masukkan Massage
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="inisial" class="col-sm-2 col-form-label">Inisial</label>
                        <div class="col-sm-10">
                            <input type="text" name="inisial" class="form-control" id="inisial" value="<?php echo $inisial ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="msg" class="col-sm-2 col-form-label">Masukkan Pesan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="msg" id="msg" value="<?php echo $msg ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Next" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!---untuk melihat data---> 
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Massage
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Inisial</th>
                            <th scope="col">Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql2 = "SELECT * FROM secret_msg order by id desc";
                            $q2 = mysqli_query($koneksi,$sql2);
                            $urut = 1;
                            while($r2 = mysqli_fetch_array($q2)){
                                $id = $r2['id'];
                                $msg = $r2['msg'];
                                $inisial = $r2['inisial'];
                                ?>

                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $inisial ?></td>
                                    <td scope="row"><?php echo $msg ?></td>
                                    <td scope="row"></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>