<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Quick php debug</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        textarea{
            width:100%;
            min-height:350px;
            background: #efefef;
        }
    </style>
    <script>
        function loadPage(){
            window.location.reload();
        }
    </script>
</head>
<?php
$output = NULL;
$code = isset($_POST['code'])?trim($_POST['code']):'';
?>
<body>
    <form action="" method="post">
    <textarea autofocus="true"  name="code" placeholder="Enter you code here"><?=$code;?></textarea>
    <button style="float:right;" type="submit" onfocus="this.form.submit()">Validate</button>
    </form>
    <pre>
<?php
if($code)
{
    eval($_POST['code']); 
}
?>
    </pre>
</body>
</html>