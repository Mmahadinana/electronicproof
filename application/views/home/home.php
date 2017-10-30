<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

</div>

<div class="container">

  <div class="starter-template">
    <h1>WELCOME</h1>
    <p class="lead">A local government is a form of public administration which, in a majority of contexts, exists as the lowest tier of administration within a given state. The term is used to contrast with offices at state level, which are referred to as the central government, national government, or (where appropriate) federal government and also to supranational government which deals with governing institutions between states. 
        <div class="container">
           
            
            <div class="row">
                <!-- The carousel -->
                <div id="transition-timer-carousel" class="carousel slide transition-timer-carousel" data-ride="carousel">
                 <!-- Indicators -->
                 <ol class="carousel-indicators">
                    <li data-target="#transition-timer-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#transition-timer-carousel" data-slide-to="1"></li>
                    <li data-target="#transition-timer-carousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="assets/logos/jb.jpg" />
                        <div class="carousel-caption">
                            <h1 class="carousel-caption-header">Slide 1</h1>
                            <p class="carousel-caption-text hidden-sm hidden-xs">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim aliquet rutrum. Praesent vitae ante in nisi condimentum egestas. Aliquam.
                            </p>
                        </div>
                    </div>
                    
                    <div class="item">
                        <img src="assets/logos/MDS-WEB-05.png" />
                        <div class="carousel-caption">
                            <h1 class="carousel-caption-header">Slide 2</h1>
                            <p class="carousel-caption-text hidden-sm hidden-xs">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim aliquet rutrum. Praesent vitae ante in nisi condimentum egestas. Aliquam.
                            </p>
                        </div>
                    </div>
                    
                    <div class="item">
                        <img src="http://placehold.it/1200x400/888888/555555" />
                        <div class="carousel-caption">
                            <h1 class="carousel-caption-header">Slide 3</h1>
                            <p class="carousel-caption-text hidden-sm hidden-xs">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim aliquet rutrum. Praesent vitae ante in nisi condimentum egestas. Aliquam.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#transition-timer-carousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#transition-timer-carousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
                
                <!-- Timer "progress bar" -->
                <hr class="transition-timer-carousel-progress-bar animate" />
            </div>
        </div>
    </div>
</div>

</div><!-- /.container -->
<script type="text/javascript">
   $(document).ready(function() {    
    //Events that reset and restart the timer animation when the slides change
    $("#transition-timer-carousel").on("slide.bs.carousel", function(event) {
        //The animate class gets removed so that it jumps straight back to 0%
        $(".transition-timer-carousel-progress-bar", this)
        .removeClass("animate").css("width", "0%");
    }).on("slid.bs.carousel", function(event) {
        //The slide transition finished, so re-add the animate class so that
        //the timer bar takes time to fill up
        $(".transition-timer-carousel-progress-bar", this)
        .addClass("animate").css("width", "100%");
    });
    
    //Kick off the initial slide animation when the document is ready
    $(".transition-timer-carousel-progress-bar", "#transition-timer-carousel")
    .css("width", "100%");
});
</script>
