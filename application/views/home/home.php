<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
<h1>WELCOME</h1>
<p class="lead">A local government is a form of public administration which, in a majority of contexts, exists as the lowest tier of administration within a given state. The term is used to contrast with offices at state level, which are referred to as the central government, national government, or (where appropriate) federal government and also to supranational government which deals with governing institutions between states. </p>

    <div class="container">        
        <div class="row">
            <div class="col-md-12">
                <div id="Carousel" class="carousel slide" data-ride="carousel">
                 <!--Indicators-->

                    <ol class="carousel-indicators">
                        <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#Carousel" data-slide-to="1"></li>
                        <li data-target="#Carousel" data-slide-to="2"></li>
                        <li data-target="#Carousel" data-slide-to="3"></li>
                    </ol>
                    
                    <!-- wrapper for slides -->
                    <div class="carousel-inner text-center">
                        
                        <div class="item active">
                            <div class="row">
                              <div class="col-md-6"><a href="#" class="thumbnail"><img src="<?php echo base_url('assets/logos/mangaung_m.png') ?>" alt="Image" style="max-width:100%;"></a></div>

                             
                          </div><!--.row-->
                      </div><!--.item-->
                      
                      <div class="item">
                        <div class="row">
                        <div class="col-md-6"><a href="#" class="thumbnail"><img src="<?php echo base_url('assets/logos/Bushbuckridge_CoA.png')?>" alt="Image" style="max-width:100%;"></a></div>
                            
                        </div><!--.row-->
                    </div><!--.item-->
                    
                    <div class="item">
                        <div class="row">
                            <div class="col-md-6"><a href="#" class="thumbnail"><img src="<?php echo base_url('assets/logos/jobe-municipal.png')?>" alt="Image" style="max-width:100%;"></a></div>
                             
                        </div><!--.row-->
                    </div><!--.item-->

                    <div class="item">
                            <div class="row">
                              <div class="col-md-6"><a href="#" class="thumbnail"><img src="<?php echo base_url('assets/logos/kopanong.jpg')?>" alt="Image" style="max-width:100%;"></a></div>                            
                             
                          </div><!--.row-->
                      </div><!--.item-->
                    


              </div><!--.carousel-inner-->
              <a data-slide="prev" href="#Carousel" class="leftCarosel carousel-control"><span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span></a>
              <a data-slide="next" href="#Carousel" class="rightCarosel carousel-control"><span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span></a>

                </div><!--.carousel-inner-->
               

            </div><!--.Carousel-->
            
        </div>
    </div>
</div><!--.container-->
</div>

<script type="text/javascript">
 $(document).ready(function() {
    $('#Carousel').carousel({
        interval: 2000
    })
});

</script>
