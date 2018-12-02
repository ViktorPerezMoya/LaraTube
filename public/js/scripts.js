var URL_BASE = "http://laraveltube.com";
$(document).ready(function(){
    $("#btn_like").click(function(){
        var video_id = $("#video_id_play").val();
        var token = $("#_token").val();
        reaccion(true, video_id, token);
    });
    
    $("#btn_dislike").click(function (){
        var video_id = $("#video_id_play").val();
        var token = $("#_token").val();
        reaccion(false, video_id, token);
    });
});

function reaccion(like, video_id, token){
    var request = $.ajax({
        url: URL_BASE+"/like",
        method: "POST",
        data: { like: like, video_id: video_id, _token: token },
        dataType: "json"
      });

      request.done(function( data ) {
          console.log(data);
        $("#sp_likes").html(data.liked_count);
        $("#sp_dislikes").html(data.disliked_count);
      });

      request.fail(function( jqXHR, textStatus ) {
        console.log( "Request failed: " + textStatus );
      });
}

