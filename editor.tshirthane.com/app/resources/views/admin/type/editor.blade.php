<?php 
$width = env("WIDTH"); 
$height = env("HEIGHT"); 
?>
<div class="content">
    <div class="row">
         {{col("col-12","Şablon seçiniz")}}
         <div class="row">
        <?php $urun_sablonlari = db("urun_sablonlari")->get();
            foreach($urun_sablonlari AS $sablon) {
                    $j = j($sablon->json);
                    ?>
                    <div class="col-md-6 col-xl-3">
                            <a class="block block-link-pop text-center sablon-sec" data-file="{{p($sablon->files,1024)}}" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <img class="img-fluid" src="{{p($sablon->files,256)}}" alt="">
                                </div>
                                <div class="block-content block-content-full bg-body-light">
                                    <div class="font-w600 mb-5">{{$sablon->title}}</div>
                                    <div class="font-size-sm text-muted">{{@$j['salePrice']}}</div>
                                </div>
                            </a>
                    </div>
               
                    <?php 
            }
        ?>
        </div> 
          
         {{_col()}}
    </div>
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2($c->title)}}</h3>
            </div>
            <div class="block-content text-center">
                <div class="input-group">
                    
                    <input type="file" id="file_input" class="btn btn-outline-success mr-5 mb-5">
                    <div class="toolbar btn-group d-none">
                        <button type="button" class="btn btn-outline-danger mr-5 mb-5 delete">
                            <i class="fa fa-trash mr-5"></i>Görseli sil
                        </button>
                        <button type="button" class="btn btn-outline-success mr-5 mb-5 move-up">
                            <i class="si si-layers mr-5"></i>Öne Getir
                        </button>
                        <button type="button" class="btn btn-outline-success mr-5 mb-5 move-down">
                            <i class="si si-layers mr-5"></i>Alta Gönder
                        </button>
                        <select name="" id="" class="form-control blend-mode">
                            <option value="">Blend Mode</option>
                            <option value="lighten">Lighten</option>
                            <option value="darken">Darken</option>
                        </select>
                    </div>
                    
                    
                </div>
                
           
            </div>

            

        </div>

    </div>
    <div id="container"></div>
                <script>
                    $(function(){
                        // first we need to create a stage
                        var stage = new Konva.Stage({
                            container: 'container',   // id of container <div>
                            width: {{$width}} / 3,
                            height: {{$height}} / 3
                        });

                        // then create layer
                        var layer = new Konva.Layer();
                        var tr = new Konva.Transformer();
                        var seciliObje; 
                        var toolbar = $(".toolbar");

                        $(".delete").on("click", function() {
                            seciliObje.destroy();
                            tr.nodes([]);
                            toolbar.addClass("d-none");
                        });

                        $(".move-down").on("click", function() {
                            seciliObje.moveToBottom();                      
                            tr.moveToBottom();                      
                        });
                        $(".move-up").on("click", function() {
                            seciliObje.moveToTop();                      
                            tr.moveToTop();                      
                        });
                        $(".blend-mode").on("change", function() {
                            console.log($(this).val());
                            seciliObje.setAttrs({
                                globalCompositeOperation : $(this).val()
                            })             
                        });

                       

                        // add the layer to the stage
                        stage.add(layer);

                        // draw the image
                        layer.draw();
                        $(".sablon-sec").on("click", function() {
                            var url = $(this).attr("data-file");
                            var imageObj = new Image();
                            imageObj.onload = function () {
                                var sablon = new Konva.Image({
                                x: 0,
                                y: 0,
                                image: imageObj,
                                width: {{$width}} / 3,
                                height: {{$height}} / 3,
                              
                                });

                                // add the shape to the layer
                                layer.add(sablon);
                            };
                            imageObj.src = url;
                        });
                        
                        $("#file_input").change(function(e){

                            var imageLayer = new Konva.Layer();
                            var URL = window.webkitURL || window.URL;
                            var url = URL.createObjectURL(e.target.files[0]);
                            var img = new Image();
                            img.src = url;


                            img.onload = function() {

                                var img_width = img.width;
                                var img_height = img.height;

                                // calculate dimensions to get max 300px
                                var max = 300;
                                var ratio = (img_width > img_height ? (img_width / max) : (img_height / max))

                                // now load the Konva image
                                var theImg = new Konva.Image({
                                    image: img,
                                    x: 0,
                                    y: 0,
                                    width: img_width/ratio,
                                    height: img_height/ratio,
                                    draggable: true,
                                 //   globalCompositeOperation : 'lighten',
                                    rotation: 0
                                });
                                //stage.add(layer);

                                layer.add(theImg);
                                
                                layer.add(tr); 
                                tr.nodes([theImg]);
                                
                                
                                

                                imageLayer.draw();


                                //events

                                theImg.on('click', function() {
                                    tr.nodes([theImg]);
                                    toolbar.removeClass('d-none');
                                    seciliObje = theImg;
                                })
                                
                            }


                        });
                    });
                    
                </script>
                <style>
                    .konvajs-content {
                        margin:0 auto;
                        border:solid 1px #c1c1c1;
                        background:white;
                        content: '\F0637';
                        
                    }
                </style>

</div>