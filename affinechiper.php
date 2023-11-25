<?php
function affineEncrypt($text, $a, $b) {
    $result = "";
    $text = strtolower($text);
    $alphabet = "abcdefghijklmnopqrstuvwxyz";
    $n = strlen($alphabet);

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (ctype_alpha($char)) {
            $index = strpos($alphabet, $char);
            $newIndex = ($a * $index + $b) % $n;
            $newChar = $alphabet[$newIndex];
            $result .= $newChar;
        } else {
            $result .= $char;
        }
    }

    return $result;
}

function affineDecrypt($text, $a, $b) {
    $result = "";
    $text = strtolower($text);
    $alphabet = "abcdefghijklmnopqrstuvwxyz";
    $n = strlen($alphabet);

    // Mencari invers modulo a
    $inverseA = 0;
    for ($i = 0; $i < $n; $i++) {
        if (($a * $i) % $n == 1) {
            $inverseA = $i;
            break;
        }
    }

    for ($i = 0; $i < strlen($text); $i++) {
        $char = $text[$i];
        if (ctype_alpha($char)) {
            $index = strpos($alphabet, $char);
            $newIndex = ($inverseA * ($index - $b)) % $n;
            $newChar = $alphabet[$newIndex];
            $result .= $newChar;
        } else {
            $result .= $char;
        }
    }

    return $result;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Affine Cipher Encryption and Decryption</title>
    <style>
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: center;
        }

        table, th, td {
            border: 1px solid black;

            /* Style untuk membuat tampilan search box */
 .search-box {
            position: relative;
            display: inline-block;
        }

        .search-box input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            box-sizing: border-box;
        }
        .search-box input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 200px;
            box-sizing: border-box;
        }
        }

    </style>
</head>
<body>

<center>
    <!-- Form HTML untuk memasukkan kata, a, dan b -->
    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <h2>PROGRAM ENKRIPSI DAN DEKRIPSI MENGGUNAKAN ALGORITMA AFFINE CHIPER</h2>
        <table>
            <tr>
                <td><h3><label for="text">Masukkan Plaintext:</label></h3></td>
                
                <td><div class="search-box"><input type="text" name="text" id="text" placeholder="Masukkan kata" required></div></td>
            </tr>
            <tr>
                <td><h3><label for="a">Masukkan Nilai A:</label></h3></td>
                <td><div class="search-box"><input type="number" name="a" id="a" placeholder="Masukkan nilai" required></div></td>
            </tr>
            <tr>
                <td><h3><label for="b">Masukkan Nilai B:</label></h3></td>
                <td><div class="search-box"><input type="number" name="b" id="b" placeholder="Masukkan nilai" required></div></td>
            </tr>
        </table>
        <input type="submit" value="Proses Enkripsi & Dekripsi">
    </form>
</center>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
<style>
a, button,input[type=submit],input[type=reset] {
    font-family: sans-serif;
    font-size: 16px;
    background: #22a4cf;
    color: white;
    border: white 3px solid;
    border-radius: 5px;
    padding: 12px 20px;
    margin-top: 10px;
}
a {
    text-decoration: none;
}
a:hover, button:hover, input[type=submit]:hover, input[type=reset]:hover{
    opacity:0.9;
}
</style>
    <title>Affine Cipher</title>
    <style>
        .center {
            text-align: center;
            margin: auto;
            width: 50%;
            padding: 10px;
            border: 1px solid #ccc;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
// Memeriksa apakah ada input yang dikirimkan melalui form

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil nilai kata, a, dan b dari form
    $text = $_POST["text"];
    $a = (int) $_POST["a"];
    $b = (int) $_POST["b"];
    // Kata yang dienkrispi
    
echo "<div class='center'>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th colspan='2'><b>HASIL ALGORITMA AFFINE CIPHER</th></tr>";
echo "<tr><td><b>Kata Yang Dimasukkan:</td><td>" . $_POST["text"] . "</td></tr>";
echo "<tr><td><b>Nilai A:</td><td>" . $a . "</td></tr>";
echo "<tr><td><b>Nilai B:</td><td>" . $b. "</td></tr>";

// Enkripsi kata menggunakan Affine Cipher
$ciphertext = affineEncrypt($text, $a, $b);
echo "<tr><td><b>Enkripsi Text:</td><td>" . $ciphertext . "</td></tr>";

// Dekripsi kata menggunakan Affine Cipher
$deciphertext = affineDecrypt($ciphertext, $a, $b);
echo "<tr><td><b>Dekripsi Text:</td><td>" . $deciphertext . "</td></tr>";

echo "</table>";
echo '<a href="affinechiper.php" class="button">Refresh</a>';
echo "</div>";
    
} 
?>

<style>
    .button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
    }
</style>
</body>
</html>
