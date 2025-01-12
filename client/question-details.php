<div class="container"> 

    <div class="row"> 
        <div class="col-md-8">
        <h1 class="heading">Question</h1>
            <?php 
                include("./common/db.php");
                $query = "select * from questions where id = $qid";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
                $cid = $row['category_id'];
                echo "<h4 class='margin-bottom-15 question-title'>Question: ".$row['title']."</h4>";
                echo "<p class='margin-bottom-15'>".$row['description']."</p>";
                include("answers.php");
            ?>

            <form action="./server/requests.php" method="post">
                <input type="hidden" name="question_id" value="<?php echo $qid ?>" />
                <textarea name="answer" placeholder="Your Answer..." class="form-control margin-bottom-15"></textarea>
                <button class="btn btn-primary">Write Your Answer</button>
            </form>
        </div>
        <div class="col-md-4">
            
            <?php 
                //echo $cid;
                $categoryQuery = "select name from category where id = $cid";
                $categoryResult = $conn->query($categoryQuery); 
                $categoryRow = $categoryResult->fetch_assoc();
                echo "<h1 class='heading'>".ucfirst($categoryRow['name'])."</h1>";

                $query = "select * from questions where category_id = $cid && id!=$qid";
                $result = $conn->query($query);
                foreach($result as $row){
                    $id = $row['id'];
                    $title =  $row['title'];
                    echo "<div class='row question-list'>
                        <h4><a href='?q-id=$id'>{$title}</a></h4>
                    </div>";
                }
            ?>
        </div>
    </div>
</div>



