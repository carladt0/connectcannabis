$(document).ready(function(){


    $('#post-feed').on('click', '.like-btn', function(e){
        e.preventDefault();

        var $like_btn = $(this);
        var $like_icon = $like_btn.find('.like-icon');
        var $like_btn_text = $like_btn.find('.like-btn-text');
        var $likes_count = $like_btn.closest('.post-wrapper').find('.likes-count');
        var post_id = $like_btn.closest('.post-wrapper').attr('data-postID');

        $.post('/likes/add.php', {"post_id":post_id}, function(like_data){
            console.log(like_data);
            like_data = JSON.parse(like_data);


            if ( like_data.error === false){ //loving worked!
                if(like_data.liked == 'liked'){
                    $like_icon.addClass('orange'); //makes the icon solid
                    $like_btn_text.text('liked');
                    $likes_count.text(like_data.like_count);

                }else if (like_data.liked == 'unliked'){
                    $like_icon.removeClass('orange'); //makes the icon NOT solid
                    $like_btn_text.text('like it');
                    $likes_count.text(like_data.like_count);
                }
            }
        });
    });

    $('.delete-post').click(function(){
        if( !confirm('Are you sure you want to delete this?') ){
            return false;
        }
    });

    $('#post-feed').on('click', '.delete-post', function(e){
        e.preventDefault();

        var post_id = $(this).closest('.post-wrapper').attr('data-postID');

        $(this).closest(".post-wrapper").remove();

        $.post('/posts/delete.php', {"post_id":post_id}, function(post_data){
                console.log(post_data);
                // $commentCount.text(comment_data.comment_count);
        });
    });




//SEARCH BAR NO REFRESH

    $('#search-form').submit(function(event){
        event.preventDefault(); //prevents page refresh upon search
    });

    $('#search-bar').keyup(function(){ //allows you to type and have javascript fire while typing
        var searchData = $('#search-bar').val(); //.val() means  'Get the current value of the first element in the set of matched elements', therefore get the value of the first element from the search bar
        $.post('/search.php', {"search":searchData}, function(data){
            console.log(data);
            $('#post-feed').html(''); //the html('') means we are putting nothing in to start so that when it loops it doesnt keep adding
            var posts = JSON.parse(data);

            var postsHTML = '';

            $.each(posts, function(key, post){

                postsHTML += '<div class="single-post-feed post-wrapper" data-postID="'+post.id+'">';
                    postsHTML += '<p class="post-date"> '+convertTimestamp(parseInt($.trim(post.posted_time)))+' </p>';
                    postsHTML += '<p class="post-feed-text">'+post.name+'</p>';
                    postsHTML += '<p>';


                        if( post.user_owns === 'true' ){  //only runs for that post if owner user is logged in at the time

                            postsHTML += '<span class="user-post-controls">';
                                postsHTML += '<a class="edit-post" href="/posts/edit.php?id='+post.id+'">EDIT</a>';
                            postsHTML += '</span>';

                            postsHTML += '<span class="user-post-controls">';
                               postsHTML += '<a class="text-danger delete-post" href="/posts/delete.php?id="'+post.id+'"">DELETE <span class="separator">&nbsp;|&nbsp;&nbsp;<span>';
                               postsHTML += '</a>';
                            postsHTML += '</span>';

                        }


                     postsHTML += '</p>';
                     postsHTML += '<div class="clearfix"></div>';

                    postsHTML += '<p class="post-username"><a href="http://connectcannabis.carlabardwell.com/users/profile.php?id='+post.user_id+'">-'+post.username+'</a></p>';
                    postsHTML += '<div class="commented-count">';
                        postsHTML += '<span class="comment-count-btn">';
                            postsHTML += '<img class="cannabis-leaf-for-comment img-fluid" src="/assets/img/Connect-leaf-08.png" alt="connect cannabis leaf icon for comment">';
                            postsHTML += '<span class="comment-count">12 | <span class="comment-btn-text">comment</span></span>';
                        postsHTML += '</span>';


                        var like_text = 'like it';
                        if ( post.like_id ) { //will either hold null or hold the id (checking that 'they liked it')
                            like_text = 'liked';
                        }


                        postsHTML += '<a class="like-btn" href="/likes/add.php?id='+post.id+'">';
                            postsHTML += '<i class="fas fa-fire like-icon"></i>';
                            postsHTML += '<span class="likes-count">'+post.like_count+'</span> | <span class="like-btn-text">'+like_text+'</span>';
                        postsHTML += '</a>';
                    postsHTML += '</div><!--.comment-count-->';
                    postsHTML += '<hr class="posts-divider">';
                postsHTML += '</div><!--.single-post-feed-->';

            }); // END EACH LOOP

            $('#post-feed').html(postsHTML);

        });
    }); // END SEARCH EVENT

    $('#post-feed').on("click", ".delete-post", function(e){
        e.preventDefault();

        var post_id = $(this).closest('.post-wrapper').attr('data-postID');

        $.post('/posts/delete.php', {"post_id":post_id}, function(post_data){
        console.log(post_data);

        });

        $(this).closest(".post-wrapper").remove();
    });



}); // END DOCUMENT READY

function previewFile() {

    var preview = document.getElementById('profile-picture-edit-image');
    var file = document.getElementById('file-with-preview').files[0];

    var reader = new FileReader();

    reader.onloadend = function(){
        preview.src = reader.result;
    }

    if(file) {
        reader.readAsDataURL(file);
    }else{
        preview.src = "";
    }

}

function convertTimestamp(timestamp) {
  var d = new Date(timestamp*1000);
  var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
  var month = months[d.getMonth()];
  var day = ('0' + d.getDate()).slice(-2);
  var year = d.getFullYear();
  var time = month + ' ' + day + ', ' + year;
  return time;
}
