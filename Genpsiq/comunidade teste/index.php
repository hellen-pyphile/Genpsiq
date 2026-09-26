<html>
<?php require_once "header.php"; ?>

<?php
if (isset($_POST['btn_add_post'])) {
    $post_text = $_POST['post_text'];

    if ($post_text != "") {
        // Usando uma consulta preparada
        $stmt = $con->prepare("INSERT INTO posts (post_text, post_date) VALUES (?, NOW())");
        $stmt->bind_param("s", $post_text);
        $stmt->execute();

        if ($stmt->error) {
            echo "Erro: " . $stmt->error;
        }
        
        $stmt->close();
    }
}
?>

<body>

<div class="grid-container">

<?php require_once "left-sidebar.php"; ?>

<div class="main">
    <p class="page_title">Home</p>

    <div class="tweet_box tweet_add">
        <div class="tweet_left">
            <img src="imagens/meninoney.png" alt="">  
        </div>

        <div class="tweet_body">
            <form method="post" enctype="multipart/form-data">
                <textarea name="post_text" id="" cols="100%" rows="3" placeholder="What's happening?"></textarea>

                <div class="tweet_icons-wrapper">
                    <div class="tweet_icons-add">
                        <i class="far fa-image"></i>
                        <i class="fa fa-chart-bar"></i>
                        <i class="far fa-smile"></i>
                        <i class="far fa-calendar-alt"></i>
                    </div>

                    <button class="button_tweet" type="submit" name="btn_add_post">Tweet</button>

                </div>
            </form>
        </div>
    </div>

    <?php require_once "comunidade.php"; ?>
</div>

<?php require_once "right-sidebar.php"; ?>

<?php
if (isset($_GET['del'])) {
    $Del_ID = $_GET['del'];
    $stmt = $con->prepare("DELETE FROM posts WHERE post_id = ?");
    $stmt->bind_param("i", $Del_ID);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: index.php");
    } else {
        echo "Erro ao deletar o post.";
    }

    $stmt->close();
}
?>

</body>
</html>
