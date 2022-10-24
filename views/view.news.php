<?php
    require("layout/header.php");

    echo '
        <div class="card border-dark m-3 bg-light bg-gradient">
            <h2 class="card-title px-3 text-center">'.$news["title"].'</h2>
            <img src="'.$news["image"].'" class="card-img-top px-3" alt="...">
            <div class="p-3 newsMessage">
                <p>'.$news["summary"].'</p>
                <p>'.$news["message"].'</p>
            </div>
            <div class="position-absolute bottom-0 end-0 m-3">
                <time>
                    '.date("j M Y H:i", strtotime($news["post_date"])).'
                </time>
            </div>
        </div>
    ';

    if(isset($_SESSION["user"]["user_id"])){
        echo isset($message)?$message: "";
        echo '
            <form action="/news/'.$news["news_id"].'" method="post" class="p-3 my-3 ms-3">
                <div class="d-flex justify-content-around align-items-center">
                    <img src="'.$_SESSION["user"]["photo"].'" alt="" class="commentImg">
                    <input type="text" id="commentInput" class="form-control m-1" name="message" placeholder="Adicione um comentário..." minlength=1 maxlength=140 data-news-id="'.$news["news_id"].'" required>
                    <button type="button" name="comment" class="btn btn-secondary commentButton">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                        </svg>
                    </button>
                </div>
            </form>
        ';
    }
    else{
        echo '
            <form action="/login" method="post" class="p-3 my-3 ms-3">
                <div class="d-flex justify-content-around align-items-center">
                    <input type="text" class="form-control m-1" name="message" placeholder="Adicione um comentário..." minlength=1 maxlength=140 required>
                    <button type="submit" name="comment" class="btn btn-secondary commentButton">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                        </svg>
                    </button>
                </div>
            </form>
        ';
    }

    echo '<div class="comments">';

        foreach($comments as $comment){
            echo'
                <div class="d-flex align-items-center p-3 border rounded border-dark m-3 bg-light bg-gradient position-relative">
                    <img src="'.$comment["photo"].'" alt="" class="commentImg">
                    <div class="mx-3">
                        <p class="mb-0 fw-bold">'.$comment["username"].'</p>
                        <p class="mb-0 ">'.$comment["message"].'</p>
                    </div>
                    <div class="position-absolute bottom-0 end-0 m-3">
                        <time>
                            '.date("j M Y H:i", strtotime($comment["post_date"])).'
                        </time>
                    </div>
                </div>
            ';
        }
                    
    echo '</div>';

    require("layout/footer.php");
?>