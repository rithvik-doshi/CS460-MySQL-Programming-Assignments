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
                $dbname = "pa1-3";
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
                        $stmt = $conn->prepare("SELECT M.name, M.rating, M.production, M.budget FROM MotionPicture M WHERE M.name LIKE '$in%' "); // For exact query, replace with M.name = '$in'
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
                                "SELECT name, (award_year - EXTRACT(YEAR FROM dob)) AS age FROM People, Award WHERE People.pid = Award.pid AND (award_year - EXTRACT(YEAR FROM dob)) >= ALL (SELECT (A.award_year - EXTRACT(YEAR FROM P.dob)) AS years FROM People P, Award A WHERE P.pid = A.pid)
                                UNION
                                SELECT name, (award_year - EXTRACT(YEAR FROM dob)) AS age FROM People, Award WHERE People.pid = Award.pid AND (award_year - EXTRACT(YEAR FROM dob)) <= ALL (SELECT (A.award_year - EXTRACT(YEAR FROM P.dob)) AS years FROM People P, Award A WHERE P.pid = A.pid)");
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
                    } elseif (isset($_POST['submit10'])){
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
                        echo "<tr><th class='col-md-2'>Movie Name</th><th class='col-md-2'>People Count</th><th class='col-md-2'>Role Count</th><th class='col-md-2'>Award Count</th></tr></thead>";



                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // SQL
                            $stmt = $conn->prepare(
                                "SELECT Count(R.pid) FROM Movie M, Role R WHERE M.mpid=R.mpid;");
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
                        $user = $_POST["input3"];
                        $mpid = $_POST["input4"];
                        echo "Hello, $user liked $mpid";
                        echo "<script>console.log('Bruh moment');</script>";
                    }
            ?>
        </div>
    </body>
</html>
