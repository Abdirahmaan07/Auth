<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 
        <?php if(isset($page_title)){ echo "$page_title";}?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <style>
   #kala_sarid > .container {
         min-height: 100vh;
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: column;
        }
        #kala_sarid > .container form {
            width: 500px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgb(0, 0, 0,0.2), 0 6px 20px 0 rgb(0, 0, 0,0.19);
        }
        .link-right {
            display: flex;
            justify-content: flex-start;
        } 
    </style>
</head>
<body>