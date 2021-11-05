<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <body>

        <div class="container">
            <h1 style="text-align:center">CS460 PA1_3: localhostMovieDb</h1><br>
            <h3 style="text-align:center">Rithvik Doshi and Vishesh Jain</h3><br>
        </div>

        <div class = "container">
            <form id="ageLimitForm" method="post" action="">
                <div class="input-group mb-3">
                    <!-- Make new div each time you want to create a new line for query button -->
                    <div class="input-group-prepend m-2">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="submit" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Select Query:
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <button class="dropdown-item" name="submit1" type="submit">Query 1</button>
                            <button class="dropdown-item" name="submit2" type="submit">Query 2</button>
                            <button class="dropdown-item" name="submit3" type="submit">Query 3</button>
                            <button class="dropdown-item" name="submit4" type="submit">Query 4</button>
                            <button class="dropdown-item" name="submit5" type="submit">Query 5</button>
                            <button class="dropdown-item" name="submit6" type="submit">Query 6</button>
                            <button class="dropdown-item" name="submit7" type="submit">Query 7</button>
                            <button class="dropdown-item" name="submit8" type="submit">Query 8</button>
                            <button class="dropdown-item" name="submit9" type="submit">Query 9</button>
                            <button class="dropdown-item" name="submit10" type="submit">Query 10</button>
                            <button class="dropdown-item" name="submit11" type="submit">Query 11</button>
                            <button class="dropdown-item" name="submit12" type="submit">Query 12</button>
                            <button class="dropdown-item" name="submit13" type="submit">Query 13</button>
                            <button class="dropdown-item" name="submit14" type="submit">Query 14</button>
                            <button class="dropdown-item" name="submit15" type="submit">Query 15</button>

                        </div>
                    </div>
                    <input type="text" class="form-control" placeholder="Enter parameter 1 if needed" name="input1" id="input1">
                    <input type="text" class="form-control" placeholder="Enter parameter 2 if needed" name="input2" id="input2">
                </div>
                <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary m-2" type="submit" name="submit16">Show Likes Table</button>
                </div>
            </form>
        </div>

        <div class="container">
            <?php
                class TableRows extends RecursiveIteratorIterator {
                    function __construct($it) {
                        parent::__construct($it, self::LEAVES_ONLY);
                    }

                    function current() {
                        // return "<td style='width: 30px; border: 1px solid black;'>" . parent::current(). "</td>";
                        return "<td style='text-align:center'>" . parent::current(). "</td>";
                    }

                    function beginChildren() {
                        echo "<tr>";
                    }

                    function endChildren() {
                        echo "</tr>" . "\n";
                    }
                }

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "pa1-2";
                if(isset($_POST['submit1']))
                {
//                    $ageLimit = $_POST["inputAge"];
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Table Names</th></tr></thead>";

                    

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SHOW TABLES");
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }
                elseif(isset($_POST['submit2'])){
                    $in = $_POST["input1"];
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>Rating</th><th class='col-md-2'>Production</th><th class='col-md-2'>Budget</th></tr></thead>";


                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT M.name, M.rating, M.production, M.budget FROM MotionPicture M WHERE M.name = '$in' "); // For exact query, replace with M.name = '$in'
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }elseif(isset($_POST['submit3'])){
                    $in = $_POST["input1"];
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>Rating</th><th class='col-md-2'>Production</th><th class='col-md-2'>Budget</th></tr></thead>";


                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT M.name, M.rating, M.production, M.budget FROM MotionPicture M, Movie Mo, Likes L WHERE M.mpid = Mo.mpid AND L.uemail = '$in' AND Mo.mpid = L.mpid;"); // For exact query, replace with M.name = '$in'
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }elseif(isset($_POST['submit4'])){
                    $in = $_POST["input1"];
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Name</th></tr></thead>";


                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT DISTINCT M.name FROM MotionPicture M, Location L WHERE M.mpid = L.mpid AND L.country = '$in';"); // For exact query, replace with M.name = '$in'
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }elseif(isset($_POST['submit5'])){
                    $in = $_POST["input1"];
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Director Name</th><th class='col-md-2'>TV series name</th></tr></thead>";


                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT P.name, M.name AS Mat FROM People P, Role R, Location L, MotionPicture M, Series S WHERE L.zip = $in AND P.pid = R.pid AND R.role_name = 'Director' AND L.mpid = R.mpid AND S.mpid = L.mpid AND M.mpid = L.mpid;"); // For exact query, replace with M.name = '$in'
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }elseif(isset($_POST['submit6'])){
                    $in = $_POST["input1"];
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Person Name</th><th class='col-md-2'>Motion Picture Name</th><th class='col-md-2'>Award year</th><th class='col-md-2'>Award Count</th></tr></thead>";


                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT P.name AS pname, M.name AS mat, A.award_year, COUNT(award_name)  FROM MotionPicture M, People P, Award A WHERE A.pid = P.pid AND A.mpid = M.mpid GROUP BY M.mpid, P.pid, A.award_year HAVING COUNT(award_name) > $in;"); // For exact query, replace with M.name = '$in'
                        $stmt->execute();

                        // set the resulting array to associative
                        $stmt->setFetchMode(PDO::FETCH_ASSOC);
                        foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                            echo $v;
                        }
                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    $conn = null;
                    echo "</table>";
                }

            
                elseif(isset($_POST['submit7'])){
                    //                    $ageLimit = $_POST["inputAge"];
                        echo "<table class='table table-md table-bordered'>";
                        echo "<thead class='thead-dark' style='text-align: center'>";
                        echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>Age</th></tr></thead>";



                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare(
                                "((SELECT name, (award_year - EXTRACT(YEAR FROM dob)) AS age1
                                FROM People, Award
                                WHERE Award.award_name = 'Best Actor' AND People.pid = Award.pid
                                ORDER BY age1 DESC
                                LIMIT 1)
                                UNION
                                (SELECT name, (award_year - EXTRACT(YEAR FROM dob)) AS age1
                                FROM People, Award
                                WHERE Award.award_name = 'Best Actor' AND People.pid = Award.pid
                                ORDER BY age1 ASC
                                LIMIT 1));");
                            $stmt->execute();

                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                        echo "</table>";
                    } elseif(isset($_POST['submit8'])){
                        $in = $_POST["input1"];
                        $in2 = $_POST["input2"];
                        echo "<table class='table table-md table-bordered'>";
                        echo "<thead class='thead-dark' style='text-align: center'>";
                        echo "<tr><th class='col-md-2'>Director Name</th><th class='col-md-2'>Motion Picture Name</th><th class='col-md-2'>Box Office Collection</th><th class='col-md-2'>Budget</th></tr></thead>";


                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare("SELECT P.name AS pname, M.name AS mat, Mo.boxoffice_collection, M.budget  FROM MotionPicture M, People P, Role R, Movie Mo WHERE R.pid = P.pid AND R.mpid = M.mpid AND M.mpid = Mo.mpid AND Mo.boxoffice_collection >= $in AND M.budget <= $in2 AND R.role_name = 'Director' AND Mo.mpid = M.mpid;"); // For exact query, replace with M.name = '$in'
                            $stmt->execute();

                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                        echo "</table>";
                    }elseif(isset($_POST['submit9'])){
                        $in = $_POST["input1"];
                        echo "<table class='table table-md table-bordered'>";
                        echo "<thead class='thead-dark' style='text-align: center'>";
                        echo "<tr><th class='col-md-2'>Director Name</th><th class='col-md-2'>Motion Picture Name</th><th class='col-md-2'>Number of Roles</th></tr></thead>";
                        $in3 = floatval($in);


                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare("SELECT P.name AS pname, M.name AS mat, COUNT(R.role_name) FROM MotionPicture M, People P, Role R WHERE M.rating > $in3 AND R.pid = P.pid AND R.mpid = M.mpid GROUP BY R.pid, R.mpid HAVING COUNT(R.role_name) > 1;"); // For exact query, replace with M.name = '$in'
                            $stmt->execute();

                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                        echo "</table>";
                    }elseif (isset($_POST['submit10'])){
                        echo "<table class='table table-md table-bordered'>";
                        echo "<thead class='thead-dark' style='text-align: center'>";
                        echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>Rating</th></tr></thead>";



                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare(
                                "SELECT DISTINCT MotionPicture.name, MotionPicture.rating FROM Movie, MotionPicture, Genre, Location WHERE Movie.mpid = MotionPicture.mpid AND Movie.mpid = Genre.mpid AND Movie.mpid = Location.mpid AND Location.city = 'Boston' AND Genre.genre_name = 'Thriller' AND MotionPicture.mpid NOT IN (SELECT MotionPicture.mpid from Movie, MotionPicture, Genre, Location WHERE Movie.mpid = MotionPicture.mpid AND Movie.mpid = Genre.mpid AND Movie.mpid = Location.mpid AND Location.city != 'Boston' AND Genre.genre_name = 'Thriller') ORDER BY MotionPicture.rating DESC LIMIT 2;");
                            $stmt->execute();

                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                        echo "</table>";
                    }elseif(isset($_POST['submit11'])){
                        $in = $_POST["input1"];
                        $in2 = $_POST["input2"];
                        echo "<table class='table table-md table-bordered'>";
                        echo "<thead class='thead-dark' style='text-align: center'>";
                        echo "<tr><th class='col-md-2'>Movie Name</th><th class='col-md-2'>Number of Likes</th></tr></thead>";


                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare("SELECT Mo.name AS mat, COUNT(U.email) FROM Movie M, MotionPicture Mo, Likes L, User_table U WHERE Mo.mpid = M.mpid AND M.mpid = L.mpid AND L.uemail = U.email AND U.age < $in2 GROUP BY M.mpid HAVING COUNT(U.email) > $in;");
                            $stmt->execute();

                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                        echo "</table>";
                    } elseif (isset($_POST['submit12'])){
                        echo "<table class='table table-md table-bordered'>";
                        echo "<thead class='thead-dark' style='text-align: center'>";
                        echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>MotionPicture Name</th></tr></thead>";



                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare(
                                "SELECT DISTINCT People.name, MotionPicture.name AS Mname FROM People, MotionPicture, Role WHERE People.pid = Role.pid AND MotionPicture.mpid = Role.mpid AND  (MotionPicture.production = 'Marvel' OR MotionPicture.production = 'DC') AND Role.role_name = 'Actor';");
                            $stmt->execute();

                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                        echo "</table>";
                    } elseif (isset($_POST['submit13'])){
                        echo "<table class='table table-md table-bordered'>";
                        echo "<thead class='thead-dark' style='text-align: center'>";
                        echo "<tr><th class='col-md-2'>Name</th><th class='col-md-2'>Rating</th></tr></thead>";



                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare(
                                "SELECT MotionPicture.name, MotionPicture.rating FROM MotionPicture WHERE MotionPicture.rating > ALL (SELECT AVG(MotionPicture.rating) from MotionPicture, Genre WHERE Genre.genre_name = 'Comedy' AND MotionPicture.mpid = Genre.mpid) ORDER BY MotionPicture.rating DESC;");
                            $stmt->execute();

                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                        echo "</table>";
                    } elseif (isset($_POST['submit14'])){
                        echo "<table class='table table-md table-bordered'>";
                        echo "<thead class='thead-dark' style='text-align: center'>";
                        echo "<tr><th class='col-md-2'>Movie Name</th><th class='col-md-2'>People Count</th><th class='col-md-2'>Role Count</th></tr></thead>";



                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare(
                                "SELECT Mo.name, COUNT(DISTINCT P.pid) AS pcount, Count(R.role_name) AS rcount
                                FROM Movie M, MotionPicture Mo, Role R, People P
                                WHERE M.mpid=R.mpid AND R.pid = P.pid AND Mo.mpid = M.mpid
                                GROUP BY M.mpid
                                ORDER BY pcount DESC
                                LIMIT 5;");
                            $stmt->execute();

                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                        echo "</table>";
                    } elseif (isset($_POST['submit15'])){
                        echo "<table class='table table-md table-bordered'>";
                        echo "<thead class='thead-dark' style='text-align: center'>";
                        echo "<tr><th class='col-md-2'>Actor 1 Name</th><th class='col-md-2'>Actor 2 Name</th><th class='col-md-2'>Birthday</th></tr></thead>";



                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare(
                                "SELECT DISTINCT P1.name AS A, P2.name as B, P1.dob FROM Role R1, Role R2, People P1, People P2 WHERE P1.pid < P2.pid AND R1.role_name = 'Actor' AND R2.role_name = 'Actor' AND R1.pid = P1.pid AND R2.pid = P2.pid AND P1.dob = P2.dob;");
                            $stmt->execute();

                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                        echo "</table>";
                    } elseif (isset($_POST['submit16'])){
                        echo "<table class='table table-md table-bordered'>";
                        echo "<thead class='thead-dark' style='text-align: center'>";
                        echo "<tr><th class='col-md-2'>mpid</th><th class='col-md-2'>Name</th><th class='col-md-2'>Likes</th></tr></thead>";



                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                                                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare(
                                "SELECT MotionPicture.mpid, MotionPicture.name, COUNT(Likes.uemail) FROM Likes, MotionPicture WHERE Likes.mpid = MotionPicture.mpid GROUP BY Likes.mpid;");
                            $stmt->execute();

                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                        echo "</table>";
                        ?>
                        <div class='input-group mb-3'>
                            <form id="ageLimitForm" method="post" action="">
                                <div class='input-group-prepend m-2'>
                                    <button class='btn btn-outline-secondary' name='submit17' type='submit'>Submit new Likes</button>
                                </div>
                                <input type='text' class='form-control' placeholder='Enter valid user email' name='input3' id='input3'>
                                <input type='text' class='form-control' placeholder='Enter mpid to like' name='input4' id='input4'>
                            </form>
                        </div>
                        <?php
                    } elseif (isset($_POST['submit17'])){
                        $user1 = $_POST["input3"];
                        $mpid1 = $_POST["input4"];
                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare(
                                "INSERT INTO LIKES VALUES ($mpid1, '$user1');");
                            $stmt->execute();
                            echo "Hello, $user liked $mpid";
                            echo "<script>console.log('Bruh moment');</script>";
                            // set the resulting array to associative
                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                            foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                                echo $v;
                            }
                            
                        }
                        catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        $conn = null;
                    }
            ?>
        </div>
    </body>
</html>
