

<html>
    <head>
        <title>Soft Link</title>

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>

        <link href="https://fonts.googleapis.com/css?family=Caveat|Gidugu|Kaushan+Script|Yantramanav" rel="stylesheet">

        <link href="css/softln.css" rel="stylesheet" type="text/css"/>
 
 
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="gap-100"></div>
                <div class="col-sm-1"></div>
                <div class="col-sm-10 col-xs-12">
                    <div class="">
                        <p class="logo">Search Relevance <br><small class="tagline">An Implementation of Vector Space Model</small></p>

                        <div class="gap-30"></div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <form class="center-block" method="post">
                                <div class="input-group">
                                    <input type='text' name="qry" class="form-control" placeholder="Write your query..." rows="1" required/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" name="submit" type="submit">Click to Search</button>
                                    </span>
                                </div><!-- /input-group -->
                            </form>

	
	
<?php

if(isset($_POST['submit'])){
$qry=$_POST['qry'];
exec("Rscript Arg.R '$qry' ",$result);

echo "<br><h3 class='text-center'>Ranked Documents</h3>";
echo "<table class='table'>";

foreach($result as $r)
{
	$document=explode("\"",explode(",",$r)[0])[1];
	$score=explode("\"",explode(",",$r)[1])[0];
	$score=round($score,4);
	echo "<tr>";
	echo "<td><a href='documents/$document' targer='_new'>$document</a></td>";
	echo "<td>$score</td>";
	echo "</tr>";

}
}

?>
</table>
				
 
                        </div>
                        <div class="col-sm-2"></div>


                        <div class="gap-200"></div>



                    </div>
                </div>
                <div class="col-sm-1"></div>


            </div>
        </div>

        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="js/npm.js" type="text/javascript"></script>

    </body>
</html>



