<html>
<head>
<style>
    body {
  margin: 0;
  padding: 0;
}

.rectangle {
    width: 50%;
    height: 50%;
    float: left;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
    text-align: center;
}

.rectangle:hover .background {
        -webkit-filter: blur(3px);
        -moz-filter: blur(3px);
        -o-filter: blur(3px);
        -ms-filter: blur(3px);
        filter: blur(3px);
    cursor: pointer;
}

.rectangle p {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 18px;
    transition: all 0.3s ease;
    z-index:1;
}

.rectangle:hover p {
    font-size: 24px;
}

.background {
    background-size: cover;
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}

@media (orientation: portrait) {
    .rectangle {
        width: 100%;
        height: 25%;
    }
}
</style>
</head>
<body>

<div class="rectangle">
    <div class="background" style="background-image: url('Zahlenfolgen_bilden.jpg');"></div>
    <a href="Select_level.php"><p>Zahlenfolgen</p></a>
</div>

<div class="rectangle">
    <div class="background" style="background-image: url('image2.jpg');"></div>
    <p>Text 2</p>
</div>

<div class="rectangle">
    <div class="background" style="background-image: url('image2.jpg');"></div>
    <p>Text 2</p>
</div>

<div class="rectangle">
    <div class="background" style="background-image: url('image2.jpg');"></div>
    <p>Text 2</p>
</div>

</body>
</html>
