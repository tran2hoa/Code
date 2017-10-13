var myVideo = document.getElementById("filmporn"); 

function playPause() { 
    if (myVideo.paused) 
        myVideo.play();
    else 
        myVideo.pause(); 
} 
    var video = $("#filmporn").get(0);
video.click(function(){
  $(".play").remove();
    var tag_i=$(this).find("i");
  
    if ( video.paused ) {
    tag_i.removeClass('fa-pause').addClass("fa-play");
       
    } else {
    tag_i.removeClass('fa-play').addClass("fa-pause");
       
    }
    return false;
});
  @mobile
  $(".play").remove();
  @endmobile