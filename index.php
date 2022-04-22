<?php 
$PROFILE = null;
session_start();
require_once("dbconnect.php");
if(isset($_SESSION['profile'])){
    $PROFILE = $_SESSION['profile'];
}
?>

<script type="text/javascript">
	var PROFILE = <?php echo json_encode($PROFILE); ?>;
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/header.css">
    <title>Write-Blog</title>
</head>
<body>
    <?php include("header.php"); ?>
    <div class="container">	
            <div class="control-header">
                <div class="content-header">
                    <div class="topic-header">
                        <h1>Write Blog, I’m Learning to Sit
                        easy </h1>
                    </div>
                    <div>
                        <p>It's easy and free to post your thinking on any topic and connect with millions of readers easy and free.</p>
                    </div>	
                    <button class="btn-c">Start Writing</button>
                </div>
            </div>

            <div class="control">
                <div class="control-popular">
                    <div class="icon_graph">
                        <img src="img/graph.jpg" width="30px" height="30px">
                        <span>TRENDING ON MEDIUM</span>
                    </div>
                    <div class="box-popular">
                            
                    </div>
                </div>
                <div class="control-blog">
                    <div class="blog">
                        <div class="control-card" id="scroll_load">
                        </div>
                        <div class="contact">
                            <div class="contact-h">
                                Discover more of what matters to you
                            </div>
                            <div class="contact-l">	
                                <div><a href="">Help</a></div>
                                <div><a href="">Status</a></div>
                                <div><a href="">Writes</a></div>
                                <div><a href="">Knowable</a></div>
                                <div><a href="">Caveers</a></div>
                                <div><a href="">Privacy</a></div>
                                <div><a href="">Terms</a></div>
                                <div><a href="">About</a></div>
                                <div><a href="">Blog</a></div>			
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="modal-blog">
        <div class="modal-create">
        </div>
    </div>
    <div class="modal">
        <div class="modal-edit">
                
        </div>
    </div>

    <div class="loadmore"><span>Load More</span></div>
    <div id="loading" class="show-load hidden overlay"></div>
<script src="js/blog.js"></script>
<script src="js/header.js"></script>
</body>
</html>



