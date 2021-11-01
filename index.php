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
            <h1 style="text-align:center"> CS460 PA1_3</h1><br>
            <h3 style="text-align:center"> Rithvik Doshi and Vishesh Jain</h3><br>
        </div>

        <div class = "container">
            <form id="ageLimitForm" method="post" action="">
                <div class="input-group mb-3">
                    <button class="btn btn-outline-secondary m-2" type="submit" name="submit1" id="button-addon1">Show all tables</button>
                    <button class="btn btn-outline-secondary m-2" type="submit" name="submit2" id="button-addon2">View all actors</button>
                    <button class="btn btn-outline-secondary m-2" type="submit" name="submit7" id="button-addon7">Query 7</button>
                    <button class="btn btn-outline-secondary m-2" type="submit" name="submit10" id="button-addon7">Query 10</button>
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
                //                    $ageLimit = $_POST["inputAge"];
                    echo "<table class='table table-md table-bordered'>";
                    echo "<thead class='thead-dark' style='text-align: center'>";
                    echo "<tr><th class='col-md-2'>Actors</th>";

                    

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // SQL
                        $stmt = $conn->prepare("SELECT DISTINCT name FROM People, Role WHERE role_name = 'Actor' AND Role.pid = People.pid ");
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
                    }

            ?>
        </div>
    </body>
</html>
