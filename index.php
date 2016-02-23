<?php
/*
    PHP Markov Chain text generator 1.0.1
    Copyright (c) 2008, Hay Kranen <http://www.haykranen.nl/projects/markov/>

    License (MIT / X11 license)

    Permission is hereby granted, free of charge, to any person
    obtaining a copy of this software and associated documentation
    files (the "Software"), to deal in the Software without
    restriction, including without limitation the rights to use,
    copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following
    conditions:

    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
    OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
    HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
    WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
    OTHER DEALINGS IN THE SOFTWARE.
*/

require 'markov.php';

if (isset($_POST['submit'])) {
    // generate text with markov library
    $order  = $_REQUEST['order'];
    $length = $_REQUEST['length'];
    $ptext  = $_REQUEST['text'];

    $text = file_get_contents("text/statements.txt");

    if(isset($text)) {
        $markov_table = generate_markov_table($text, $order);
        $markov = generate_markov_text($length, $markov_table, $order);

        //if (get_magic_quotes_gpc()) $markov = stripslashes($markov);
    }
}
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <title>Artist Statement Generator</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />    
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
    <h1>Artist Statement Generator</h1>
    <h2>Input text</h2>
    <form method="post" action="" name="markov">
        <select name="text">
            <option value="statements" selected>Artist statements</option>
        </select>
        <label for="order">Order</label>
        <input type="text" name="order" required />
        <label for="length">Length</label>
        <input type="text" name="length" value="2500" />
        <br />
        <input type="submit" name="submit" value="GO" />
    </form>

    <?php if (isset($markov)) : ?>
        <h2>Output text</h2>
        <textarea rows="20" cols="80" readonly="readonly"><?php echo $markov; ?></textarea>
    <?php endif; ?>

    <p>Special thanks to <a href="http://www.haykranen.nl">Hay Kranen</a> for making the Markov chain code available for public reuse. The source code is <a href="http://www.haykranen.nl/projects/markov">here</a>;  the license is <a href="http://www.opensource.org/licenses/mit-license.php">here</a>.</p>    
</body>
</html>