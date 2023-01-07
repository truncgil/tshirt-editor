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
                <input type="file" id="file_input" class="form-control">
            <div id="container"></div>
                <script>
                    $(function(){
                        // first we need to create a stage
                        var stage = new Konva.Stage({
                            container: 'container',   // id of container <div>
                            width: 1024,
                            height: 1024
                        });

                        // then create layer
                        var layer = new Konva.Layer();

                       

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
                                width: 1024,
                                height: 1024,
                              
                                });

                                // add the shape to the layer
                                layer.add(sablon);
                            };
                            imageObj.src = url;
                        });
                        var tr = new Konva.Transformer();
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
                                    globalCompositeOperation : 'lighten',
                                    rotation: 0
                                });
                                //stage.add(layer);

                                layer.add(theImg);
                                
                                layer.add(tr); 
                                tr.nodes([theImg]);
                                
                                

                                imageLayer.draw();
                                
                            }


                        });
                    });
                    
                </script>
                <style>
                    .konvajs-content {
                        margin:0 auto;
                        border:solid 1px #c1c1c1
                        
                    }
                </style>

            </div>

            

        </div>

    </div>
</div>