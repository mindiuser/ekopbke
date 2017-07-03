<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url();?>public/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="<?php echo base_url();?>public/assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>404 Page no found</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <?php $this->load->view('template/header');?>
    <style type="text/css">
        body {
        background: url('http://www.wallpaperup.com/uploads/wallpapers/2012/10/21/20181/cad2441dd3252cf53f12154412286ba0.jpg');
        }
        *, *:after, *:before {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            -ms-box-sizing: border-box;
            box-sizing: border-box; }


        .error-page-wrap {
            width: 300px;
            height: 300px;
            margin: 150px auto; }
        .error-page-wrap:before {
            box-shadow: 0 0 200px 150px #fff;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            position: relative;
            z-index: -1;
            content: '';
            display: block; }

        .error-page {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            top: -300px;
            position: relative;
            text-align: center;
            background: #d36242;
            background: -moz-linear-gradient(top, #d36242 0%, darkred 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #d36242), color-stop(100%, darkred));
            background: -webkit-linear-gradient(top, #d36242 0%, darkred 100%);
            background: -o-linear-gradient(top, #d36242 0%, darkred 100%);
            background: -ms-linear-gradient(top, #d36242 0%, darkred 100%);
            background: linear-gradient(to bottom, #d36242 0%, darkred 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='$firstColor', endColorstr='$secondColor',GradientType=0 ); }
        .error-page:before {
            width: 63px;
            height: 63px;
            border-radius: 50%;
            box-shadow: 3px 25px 0 5px #C95439;
            content: '';
            z-index: -1;
            display: block;
            position: relative;
            top: -19px;
            left: 44px; }
        .error-page:after {
            width: 300px;
            height: 17px;
            margin: 0 auto;
            top: 25px;
            content: '';
            z-index: -1;
            display: block;
            position: relative;
            background: -moz-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0.65) 0%, rgba(35, 26, 26, 0) 59%, rgba(60, 44, 44, 0) 100%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(0, 0, 0, 0.65)), color-stop(59%, rgba(35, 26, 26, 0)), color-stop(100%, rgba(60, 44, 44, 0)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0.65) 0%, rgba(35, 26, 26, 0) 59%, rgba(60, 44, 44, 0) 100%);
            background: -o-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0.65) 0%, rgba(35, 26, 26, 0) 59%, rgba(60, 44, 44, 0) 100%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(0, 0, 0, 0.65) 0%, rgba(35, 26, 26, 0) 59%, rgba(60, 44, 44, 0) 100%);
            background: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.65) 0%, rgba(35, 26, 26, 0) 59%, rgba(60, 44, 44, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a6000000', endColorstr='#003c2c2c',GradientType=1 ); }
        .error-page h1 {
            color: rgba(255, 255, 255, 0.94);
            font-size: 50px;
            margin: 15px auto 0 auto;
            text-shadow: 0px 0 7px rgba(0, 0, 0, 0.5); }
        .error-page h1:before {
            width: 260px;
            height: 1px;
            position: relative;
            margin: 0 auto;
            top: 70px;
            content: '';
            display: block;
            background: -moz-radial-gradient(center, ellipse cover, rgba(111, 25, 25, 0.65) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(111, 25, 25, 0.65)), color-stop(70%, rgba(75, 38, 38, 0)), color-stop(100%, rgba(60, 44, 44, 0)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba(111, 25, 25, 0.65) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
            background: -o-radial-gradient(center, ellipse cover, rgba(111, 25, 25, 0.65) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(111, 25, 25, 0.65) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
            background: radial-gradient(ellipse at center, rgba(111, 25, 25, 0.65) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a66f1919', endColorstr='#003c2c2c',GradientType=1 ); }
        .error-page h1:after {
            width: 260px;
            height: 1px;
            content: '';
            display: block;
            opacity: 0.2;
            margin: 0 auto;
            top: 50px;
            position: relative;
            background: -moz-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(247, 173, 148, 0.65)), color-stop(99%, rgba(255, 255, 255, 0.01)), color-stop(100%, rgba(255, 255, 255, 0)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
            background: -o-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
            background: radial-gradient(ellipse at center, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a6f7ad94', endColorstr='#00ffffff',GradientType=1 ); }
        .error-page h2 {
            margin: 5px 0 30px 0;
            font-size: 15px;
            font-weight: bold;
            color: yellow;
        }
        .error-page h2:before {
            width: 130px;
            height: 1px;
            position: relative;
            margin: 0 auto;
            top: 31px;
            content: '';
            display: block;
            background: -moz-radial-gradient(center, ellipse cover, rgba(111, 25, 25, 0.65) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(111, 25, 25, 0.65)), color-stop(70%, rgba(75, 38, 38, 0)), color-stop(100%, rgba(60, 44, 44, 0)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba(111, 25, 25, 0.65) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
            background: -o-radial-gradient(center, ellipse cover, rgba(111, 25, 25, 0.65) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(111, 25, 25, 0.65) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
            background: radial-gradient(ellipse at center, rgba(111, 25, 25, 0.65) 0%, rgba(75, 38, 38, 0) 70%, rgba(60, 44, 44, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a66f1919', endColorstr='#003c2c2c',GradientType=1 ); }
        .error-page h2:after {
            width: 130px;
            height: 1px;
            content: '';
            display: block;
            opacity: 0.2;
            margin: 0 auto;
            top: 11px;
            position: relative;
            background: -moz-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(247, 173, 148, 0.65)), color-stop(99%, rgba(255, 255, 255, 0.01)), color-stop(100%, rgba(255, 255, 255, 0)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
            background: -o-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
            background: radial-gradient(ellipse at center, rgba(247, 173, 148, 0.65) 0%, rgba(255, 255, 255, 0.01) 99%, rgba(255, 255, 255, 0) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#a6f7ad94', endColorstr='#00ffffff',GradientType=1 ); }

        .error-back {
            text-decoration: none;
            color: #430400;
            font-size: 15px; }
        .error-back:hover {
            color: #EB957D;
            text-shadow: 0 0 3px black; }

    </style>
</head>

<body>
<div class="error-page-wrap">
    <article class="error-page gradient">
        <hgroup>
            <h1>KODE 404</h1>
            <h2>Oops! Halaman tidak ditemukan. Anda mengakses url yang salah</h2>
        </hgroup>
        <a href="<?php echo base_url();?>" title="Back to site" class="btn btn-primary btn-sm error-back">Kembali</a>
    </article>
</div>
</body>
</html>